package com.example.proyectofinal_v2.admin;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.adapter.UsersCursorAdapter;
import com.example.proyectofinal_v2.bd.UserManagementActivity;
import com.example.proyectofinal_v2.dao.UserDBdao;

import static com.example.proyectofinal_v2.bd.Constants.C_CREATE;
import static com.example.proyectofinal_v2.bd.Constants.C_DELETE;
import static com.example.proyectofinal_v2.bd.Constants.C_EDIT;
import static com.example.proyectofinal_v2.bd.Constants.C_MODE;
import static com.example.proyectofinal_v2.bd.Constants.C_VISUALICE;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_ID;

public class UsersActivity extends AppCompatActivity implements AdapterView.OnItemClickListener {

    private ListView list;
    private UserDBdao userDBdao;
    private UsersCursorAdapter usersCursorAdapter;
    private Cursor cursor;
    private TextView txtNoData;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_users);

        // Set title of toolbar
        getSupportActionBar().setTitle(R.string.users);

        //Instance of UserDBdao
        userDBdao = new UserDBdao(this);
        //Instance of users list
        list = (ListView) findViewById(R.id.usersActivityList);

        // Open database
        try {
            userDBdao.open();

            cursor = userDBdao.getCursor();
            startManagingCursor(cursor);

            usersCursorAdapter = new UsersCursorAdapter(this, cursor);

            list.setAdapter(usersCursorAdapter);
            list.setOnItemClickListener(this);

            if (cursor.getCount() > 0) {
                txtNoData = (TextView) findViewById(R.id.usersActivityListTxt);
                txtNoData.setVisibility(View.INVISIBLE);
                txtNoData.invalidate();
            }
        } catch (Exception e) {
            Toast.makeText(getBaseContext(), R.string.couldntOpenDataBase, Toast.LENGTH_LONG).show();
            e.printStackTrace();
        }

    }

    // On Click Listener on list item click for open a UserManagMentActivity for the item
    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        Intent i = new Intent(UsersActivity.this, UserManagementActivity.class);
        i.putExtra(C_MODE, C_VISUALICE);
        i.putExtra(USERS_COLUMN_ID, id);
        startActivityForResult(i, C_VISUALICE);
    }

    // Set menu options
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_new_user, menu);
        return true;
    }

    // Menu on click for Edit/Delete user
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        Intent i;
        if (item.getItemId() == R.id.menuNewUsersOptNew) {
            i = new Intent(UsersActivity.this, UserManagementActivity.class);
            i.putExtra(C_MODE, C_CREATE);
            startActivityForResult(i, C_CREATE);
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    // On Activity Result for set mode
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (requestCode == C_VISUALICE)
            if (resultCode == RESULT_OK) reload_list();

        if (requestCode == C_CREATE)
            if (resultCode == RESULT_OK) reload_list();

        if (requestCode == C_EDIT)
            if (resultCode == RESULT_OK) reload_list();

        if (requestCode == C_DELETE) {
            if (resultCode == RESULT_OK) reload_list();
        } else
            super.onActivityResult(requestCode, resultCode, data);
    }

    @Override
    protected void onResume() {
        super.onResume();
        reload_list();
    }

    @Override
    protected void onRestart() {
        super.onRestart();
        reload_list();
    }

    // Method for reload list of users
    private void reload_list() {
        UserDBdao userDBdao = new UserDBdao(getBaseContext());
        userDBdao.open();
        UsersCursorAdapter usersCursorAdapter = new UsersCursorAdapter(this, userDBdao.getCursor());
        list.setAdapter(usersCursorAdapter);
    }

}