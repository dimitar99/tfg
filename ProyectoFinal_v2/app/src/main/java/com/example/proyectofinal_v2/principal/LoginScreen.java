package com.example.proyectofinal_v2.principal;

import android.content.ContentValues;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.res.Configuration;
import android.content.res.Resources;
import android.database.sqlite.SQLiteDatabase;
import android.os.Build;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.text.TextUtils;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.bd.UserDB;
import com.example.proyectofinal_v2.dao.UserDBdao;
import com.example.proyectofinal_v2.dialog.DialogConfirmEmail;
import com.example.proyectofinal_v2.pojo.User;
import com.google.android.gms.auth.api.signin.GoogleSignIn;
import com.google.android.gms.auth.api.signin.GoogleSignInAccount;
import com.google.android.gms.auth.api.signin.GoogleSignInClient;
import com.google.android.gms.auth.api.signin.GoogleSignInOptions;
import com.google.android.gms.common.SignInButton;
import com.google.android.gms.common.api.ApiException;
import com.google.android.gms.common.api.GoogleApiActivity;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.android.material.snackbar.Snackbar;
import com.google.firebase.auth.AuthCredential;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.auth.GoogleAuthProvider;

import java.util.Locale;

import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_EMAIL;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_NAME;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_PASSWORD;

public class LoginScreen extends AppCompatActivity {

    // Declarations
    private EditText edtMail, edtPass;
    private Button start, recoverPass;
    private TextView txtRegister;
    private LinearLayout linearLayout;
    private Animation topAnim;
    private UserDBdao userDBdao;

    // Google
    private GoogleSignInClient googleSignInClient;
    private SignInButton signInButton;
    public static final int RC_SIGN_IN = 123;

    // Firebase
    private FirebaseAuth mAuth;

    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN_MR1)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        ///////////////////
        // SET LANGUANGE //
        ///////////////////
        setAppLocale();

        setContentView(R.layout.activity_login);

        //////////////////////////////////////
        // INTERNAL DATABASE AUTHENTICATION //
        //////////////////////////////////////

        userDBdao = new UserDBdao(getBaseContext());

        // Initializations
        edtMail = (EditText) findViewById(R.id.edtEmailLogin);
        edtPass = (EditText) findViewById(R.id.edtPassLogin);
        start = (Button) findViewById(R.id.btnStart);
        recoverPass = (Button) findViewById(R.id.btnDontRememberPass);
        txtRegister = (TextView) findViewById(R.id.txtRegister);
        linearLayout = (LinearLayout) findViewById(R.id.linearLayoutLogin);
        topAnim = AnimationUtils.loadAnimation(this, R.anim.top_animation);

        // Animation
        linearLayout.setAnimation(topAnim);

        // OnClickListeners for Buttons
        start.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                validateFields();
            }
        });

        recoverPass.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent goDontRemeberPass = new Intent(LoginScreen.this, DontRemeberPassScreen.class);
                startActivity(goDontRemeberPass);
            }
        });

        txtRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent goRegister = new Intent(LoginScreen.this, RegisterScreen.class);
                startActivity(goRegister);
            }
        });

        //////////////////////////////////////
        // FIREBASE DATABASE AUTHENTICATION //
        //////////////////////////////////////

        GoogleSignInOptions gso = new GoogleSignInOptions.Builder(GoogleSignInOptions.DEFAULT_SIGN_IN)
                .requestIdToken(getString(R.string.default_web_client_id))
                .requestEmail()
                .build();

        googleSignInClient = GoogleSignIn.getClient(this, gso);
        mAuth = FirebaseAuth.getInstance();

        signInButton = (SignInButton) findViewById(R.id.google_signIn);
        signInButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                signIn();
            }
        });

    }
    // Method for configurate language
    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN_MR1)
    public void setAppLocale(){
        SharedPreferences sharedPreferences = PreferenceManager.getDefaultSharedPreferences(this);
        String language = sharedPreferences.getString("prefLanguage", "es");

        Resources res = getResources();
        DisplayMetrics dm = res.getDisplayMetrics();
        Configuration configuration = res.getConfiguration();
        configuration.setLocale(new Locale(language));
        res.updateConfiguration(configuration, dm);
    }

    // Opens Dialog for select a Google Account
    private void signIn() {
        Intent signInIntent = googleSignInClient.getSignInIntent();
        startActivityForResult(signInIntent, RC_SIGN_IN);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == RC_SIGN_IN) {
            Task<GoogleSignInAccount> task = GoogleSignIn.getSignedInAccountFromIntent(data);

            try{
                GoogleSignInAccount account = task.getResult(ApiException.class);
                firebaseAuthWithGoogle(account.getIdToken());
            }catch(ApiException e){

            }
        }
    }

    // Checks if you're logged and enters the app if it's true
    @Override
    protected void onStart() {
        super.onStart();
        FirebaseUser currentUser = mAuth.getCurrentUser();
        if(currentUser != null){
            FirebaseUser user = mAuth.getCurrentUser();
            Intent intent = new Intent(LoginScreen.this, MainMenuScreen.class);
            User u = new User();
            u.setName(user.getDisplayName());
            u.setEmail(user.getEmail());
            u.setAdministrator(false);
            intent.putExtra("Account", u);
            startActivity(intent);
        }
    }

    // Authentication method
    private void firebaseAuthWithGoogle(String idToken) {
        AuthCredential credential = GoogleAuthProvider.getCredential(idToken, null);
        mAuth.signInWithCredential(credential)
                .addOnCompleteListener(this, new OnCompleteListener<AuthResult>() {
                    @Override
                    public void onComplete(Task<AuthResult> task) {
                        if (task.isSuccessful()) {
                            FirebaseUser user = mAuth.getCurrentUser();
                            Intent intent = new Intent(LoginScreen.this, MainMenuScreen.class);
                            User u = new User();
                            u.setName(user.getDisplayName());
                            u.setEmail(user.getEmail());
                            u.setAdministrator(false);
                            intent.putExtra("Account", u);
                            startActivity(intent);
                        } else {
                            Toast.makeText(LoginScreen.this, "ERROR", Toast.LENGTH_SHORT).show();
                        }
                    }
                });
    }

    // Method that checks if the fields meet the requirements
    public void validateFields() {
        if (emptyFields()) {
            if (isEmailValid(edtMail.getText().toString())) {
                Intent goMenu = new Intent(LoginScreen.this, MainMenuScreen.class);
                ContentValues reg = new ContentValues();
                reg.put(USERS_COLUMN_EMAIL, edtMail.getText().toString());
                reg.put(USERS_COLUMN_PASSWORD, edtPass.getText().toString());
                if (userDBdao.exists(reg)) {
                    // If user info is correct, moves user to MainMenuScreen
                    if (userDBdao.login(reg) != null) {
                        User u = (User) userDBdao.login(reg);
                        goMenu.putExtra("Account", u);
                        startActivity(goMenu);
                    } else {
                        Toast.makeText(this, "Contraseña incorrecta", Toast.LENGTH_SHORT).show();
                    }
                } else {
                    Toast.makeText(this, "Usuario no encontrado", Toast.LENGTH_SHORT).show();
                }
            } else {
                Toast.makeText(LoginScreen.this, "Los datos introducidos no corresponde a ningun usuario", Toast.LENGTH_SHORT).show();
            }
        } else {
            Toast.makeText(LoginScreen.this, "No puede haber campos vacios", Toast.LENGTH_SHORT).show();
        }
    }

    // Method that checks if an email has been entered
    public boolean isEmailValid(String email) {
        return !(email == null || TextUtils.isEmpty(email)) && android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    // Method that checks that there aren't empty fields
    public boolean emptyFields() {
        if (!edtMail.getText().toString().isEmpty() && !edtPass.getText().toString().isEmpty()) {
            return true;
        }
        return false;
    }

}