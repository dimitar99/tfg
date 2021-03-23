package com.example.proyectofinal_v2.principal;

import android.content.Intent;
import android.content.SharedPreferences;
import android.content.res.Configuration;
import android.content.res.Resources;
import android.os.Build;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentActivity;
import androidx.viewpager.widget.ViewPager;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.adapter.ViewPagerAdapter;
import com.example.proyectofinal_v2.admin.UsersActivity;
import com.example.proyectofinal_v2.fragment.FragmentLocation;
import com.example.proyectofinal_v2.fragment.FragmentMain;
import com.example.proyectofinal_v2.fragment.FragmentTraining;
import com.example.proyectofinal_v2.pojo.User;
import com.firebase.ui.auth.AuthUI;
import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.google.android.material.navigation.NavigationView;
import com.google.android.material.tabs.TabLayout;
import com.google.firebase.auth.FirebaseAuth;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

public class MainMenuScreen extends AppCompatActivity{

    private User u;
    private DrawerLayout drawerLayout;
    private NavigationView navigationView;
    private ActionBarDrawerToggle actionBarDrawerToggle;
    private Toolbar toolbar;
    private TabLayout tabLayout;
    private ViewPager viewPager;
    private ViewPagerAdapter viewPagerAdapter;
    private BottomNavigationView bottomNavigationView;

    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN_MR1)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        // Load default fragment
        /*FragmentMain fragmentMain = new FragmentMain(this);
        getSupportFragmentManager().beginTransaction().replace(R.id.container_main, fragmentMain).commit();*/

        ///////////////////
        // SET LANGUANGE //
        ///////////////////
        setAppLocale();

        setContentView(R.layout.activity_main_menu);

        // Intent for get user
        u = (User) getIntent().getSerializableExtra("Account");

        // Set custom Toolbar
        toolbar = (Toolbar) findViewById(R.id.custom_toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowTitleEnabled(false);

        // Set Navigation View
        navigationView = (NavigationView) findViewById(R.id.navigationView);
        if(u != null && u.isAdministrator()) navigationView.getMenu().findItem(R.id.nav_administrator).setVisible(true);
        navigationView.bringToFront();
        navigationView.setNavigationItemSelectedListener(new NavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(MenuItem item) {
                Intent i = null;
                if(item.getItemId() == R.id.nav_profile){ i = new Intent(MainMenuScreen.this, ProfileScreen.class); i.putExtra("Account", u);}
                if(item.getItemId() == R.id.nav_prefences) i = new Intent(MainMenuScreen.this, SettingsScreen.class);
                if(item.getItemId() == R.id.nav_imc) i = new Intent(MainMenuScreen.this, IMCScreen.class);
                if(item.getItemId() == R.id.nav_users) i = new Intent(MainMenuScreen.this, UsersActivity.class);
                if(item.getItemId() == R.id.nav_logout){
                    AuthUI.getInstance().signOut(getBaseContext());
                    FirebaseAuth.getInstance().signOut();
                    i = new Intent(MainMenuScreen.this, LoginScreen.class);
                }
                i.putExtra("Account", u);
                startActivity(i);
                drawerLayout.closeDrawers();
                return true;
            }
        });

        // Drawer Layout
        drawerLayout = (DrawerLayout) findViewById(R.id.drawerLayout);
        actionBarDrawerToggle = new ActionBarDrawerToggle(this, drawerLayout, R.string.open, R.string.close);
        drawerLayout.addDrawerListener(actionBarDrawerToggle);
        actionBarDrawerToggle.syncState();
        View headerView = navigationView.getHeaderView(0);
        TextView userNameHeader = headerView.findViewById(R.id.usernameNavDrawer);
        if(!u.getSurnames().equals("")){
            userNameHeader.setText(u.getName()+" "+u.getSurnames());
        }else{
            userNameHeader.setText(u.getName());
        }

        // Bottom Navigation View
        /*bottomNavigationView = (BottomNavigationView) findViewById(R.id.bottomBarMain);
        bottomNavigationView.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(MenuItem item) {
                Fragment selectedFragment = null;

                if(item.getItemId() == R.id.navBarItemMainHome) selectedFragment = new FragmentMain(getBaseContext());
                if(item.getItemId() == R.id.navBarItemMainLocate) selectedFragment = new FragmentLocation();
                if(item.getItemId() == R.id.navBarItemMainRoutine) selectedFragment = new FragmentTraining();

                getSupportFragmentManager().beginTransaction().replace(R.id.container_main, selectedFragment).commit();
                return true;
            }
        });*/

        // Tab Layout
        tabLayout = (TabLayout) findViewById(R.id.tabLayout);
        tabLayout.addTab(tabLayout.newTab().setText("Tab 1"));
        tabLayout.addTab(tabLayout.newTab().setText("Tab 2"));
        tabLayout.addTab(tabLayout.newTab().setText("Tab 3"));
        tabLayout.setTabGravity(TabLayout.GRAVITY_FILL);

        // View Pager
        List<Fragment> list = new ArrayList<>();
        list.add(new FragmentMain(getBaseContext()));
        list.add(new FragmentLocation());
        list.add(new FragmentTraining());

        viewPagerAdapter = new ViewPagerAdapter(getSupportFragmentManager(), list);
        viewPager = (ViewPager) findViewById(R.id.viewPager);
        viewPager.setAdapter(viewPagerAdapter);
        viewPager.setOnPageChangeListener(new TabLayout.TabLayoutOnPageChangeListener(tabLayout));

        tabLayout.setOnTabSelectedListener(new TabLayout.OnTabSelectedListener() {
            @Override
            public void onTabSelected(TabLayout.Tab tab) {
                viewPager.setCurrentItem(tab.getPosition());
            }

            @Override
            public void onTabUnselected(TabLayout.Tab tab) {

            }

            @Override
            public void onTabReselected(TabLayout.Tab tab) {

            }
        });

    }
    // Method for configurate language
    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN_MR1)
    public void setAppLocale(){
        SharedPreferences sharedPreferences = PreferenceManager.getDefaultSharedPreferences(this);
        String language = sharedPreferences.getString("prefLanguage", "es");
        String nick = sharedPreferences.getString("prefLanguage", "es");
        Resources res = getResources();
        DisplayMetrics dm = res.getDisplayMetrics();
        Configuration configuration = res.getConfiguration();
        configuration.setLocale(new Locale(language));
        res.updateConfiguration(configuration, dm);
    }

    // Method for use the menu bottom from the toolbar
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (actionBarDrawerToggle.onOptionsItemSelected(item)) {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    // Uncheck the checked item when resum the app
    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN_MR1)
    @Override
    protected void onResume() {
        super.onResume();
        setAppLocale();
        try{
            navigationView.getCheckedItem().setChecked(false);
        }catch (Exception e){
            Log.d("Error no checked item", "No checked item in navigation drawer");
        }
    }
}