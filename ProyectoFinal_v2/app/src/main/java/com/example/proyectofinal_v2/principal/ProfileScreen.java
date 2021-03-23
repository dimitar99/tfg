package com.example.proyectofinal_v2.principal;

import androidx.annotation.Nullable;
import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.media.Image;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.provider.MediaStore;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;
import android.widget.Toast;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.fragment.FragmentMain;
import com.example.proyectofinal_v2.pojo.User;

import org.w3c.dom.Text;

import java.io.IOException;
import java.net.URI;

import de.hdodenhof.circleimageview.CircleImageView;

public class ProfileScreen extends AppCompatActivity {

    private User user;
    private Button btnReturn;
    private CircleImageView imageView;
    private TextView userName, nick, email, font, language;
    private static final int PICK_IMAGE = 1;
    private Uri imageUri;
    private RatingBar ratingBar;
    
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile_screen);

        // Get actual user
        user = (User) getIntent().getSerializableExtra("Account");

        // Instance of textviews
        userName = (TextView) findViewById(R.id.profileTxtUsername);
        nick = (TextView) findViewById(R.id.profileTxtNickname);
        email = (TextView) findViewById(R.id.profileTxtEmail);
        font = (TextView) findViewById(R.id.profileTxtFont);
        language = (TextView) findViewById(R.id.profileTxtLanguage);

        // Instance and set return button
        btnReturn = (Button) findViewById(R.id.btnReturnProfile);
        btnReturn.setOnClickListener(new View.OnClickListener() {
            @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP)
            @Override
            public void onClick(View v) {
                finishAndRemoveTask();
            }
        });

        loadData();

        // Instance and on click listener for opening gallery
        imageView = (CircleImageView) findViewById(R.id.profileImgUser);
        imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent gallery = new Intent();
                gallery.setType("image/*");
                gallery.setAction(Intent.ACTION_GET_CONTENT);
                startActivityForResult(Intent.createChooser(gallery, "Select Picture"), PICK_IMAGE);
            }
        });

        // Instance and set Rating Bar
        ratingBar = findViewById(R.id.profileRatingBar);
        ratingBar.setOnRatingBarChangeListener(new RatingBar.OnRatingBarChangeListener() {
            @Override
            public void onRatingChanged(RatingBar ratingBar, float v, boolean fromUser) {
                int rating = (int)v;
                String message = "";
                if(rating == 1 && rating > 0)  message = getResources().getString(R.string.rating1);
                if(rating == 2)  message = getResources().getString(R.string.rating2);
                if(rating == 3)  message = getResources().getString(R.string.rating3);
                if(rating == 4)  message = getResources().getString(R.string.rating4);
                if(rating == 5)  message = getResources().getString(R.string.rating5);

                Toast.makeText(ProfileScreen.this, message, Toast.LENGTH_SHORT).show();
            }
        });

    }

    // Method for set information of user
    private void loadData(){

        userName.setText(user.getName());
        if(user.getSurnames() != "") {
            userName.setText(userName.getText() + " " + user.getSurnames());
        }else{
            userName.setText(userName.getText());
        }
        if(user.getPhoto() != null) imageView.setImageURI(user.getPhoto());

        // Instance of shared preferences
        SharedPreferences sharedPreferences = PreferenceManager.getDefaultSharedPreferences(this);
        String l = sharedPreferences.getString("prefLanguage", "es");
        String f = sharedPreferences.getString("prefFont", "font");
        String n = sharedPreferences.getString("prefNick", "nick");

        nick.setText(n);
        email.setText(user.getEmail());
        font.setText(f);
        language.setText(l);

    }

    // Method who's called after getting a photo from users gallery
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if(requestCode == PICK_IMAGE && resultCode == RESULT_OK){
            imageUri = data.getData();
            try{
                Bitmap bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), imageUri);
                user.setPhoto(imageUri);
                loadData();
            }catch(IOException e){
                e.printStackTrace();
            }
        }
    }

}