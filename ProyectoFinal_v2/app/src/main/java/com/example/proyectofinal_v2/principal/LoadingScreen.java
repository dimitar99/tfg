package com.example.proyectofinal_v2.principal;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.WindowManager;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.LinearLayout;

import com.example.proyectofinal_v2.R;

public class LoadingScreen extends AppCompatActivity {

    // Declarations
    private Animation topAnim;
    private LinearLayout linearLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_loading_screen);

        // Hide Action Bar
        //getSupportActionBar().hide();

        // Set Fullscreen Mode
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);

        // Initializations
        topAnim = AnimationUtils.loadAnimation(this, R.anim.top_animation);
        topAnim = AnimationUtils.loadAnimation(this, R.anim.bottom_animation);
        linearLayout = (LinearLayout) findViewById(R.id.linearLayoutLoading);

        // Set animations
        linearLayout.setAnimation(topAnim);

        //Set handler for simulate Loading
        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                Intent login = new Intent(LoadingScreen.this, LoginScreen.class);
                startActivity(login);
                finish();
            }
        }, 3000);
    }
}