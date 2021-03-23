package com.example.proyectofinal_v2.principal;

import android.content.ContentValues;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.bd.UserDB;
import com.example.proyectofinal_v2.dao.UserDBdao;
import com.example.proyectofinal_v2.pojo.User;

import java.util.regex.Pattern;

import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_ADMIN;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_EMAIL;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_NAME;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_PASSWORD;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_SURNAMES;

public class RegisterScreen extends AppCompatActivity {

    private UserDBdao userDBdao;
    private EditText edtName, edtSurnames, edtMail, edtPass, edtPass2;
    private Button btnRegister, back;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        userDBdao = new UserDBdao(getBaseContext());

        edtName = (EditText) findViewById(R.id.edtNameRegister);
        edtSurnames = (EditText) findViewById(R.id.edtSurnamesRegister);
        edtMail = (EditText) findViewById(R.id.edtMailRegister);
        edtPass = (EditText) findViewById(R.id.edtPassRegister);
        edtPass2 = (EditText) findViewById(R.id.edtPassRegister2);

        btnRegister = (Button) findViewById(R.id.btnRegister);
        btnRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                validateFields();
            }
        });

        back = (Button) findViewById(R.id.btnRegisterReturn);
        back.setOnClickListener(new View.OnClickListener() {
            @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP)
            @Override
            public void onClick(View v) {
                finishAndRemoveTask();
            }
        });
    }

    // Method for validate fields
    private void validateFields() {
        if (emptyFields()) {
            if (!isEmailValid(edtMail.getText().toString())) {
                edtMail.setError("Correo No Valido");
            } else {
                if (!isPasswordValid(edtPass.getText().toString())) {
                    edtPass.setError("Contraseña No Valida");
                } else {
                    if (!isSecondPasswordEqual(edtPass.getText().toString(), edtPass2.getText().toString())) {
                        edtPass2.setError("Las Contraseñas No Coinciden");
                    } else {
                        // If everything is ok inserts the user in the database and opens the MainMenuScreen
                        Intent goMenu = new Intent(RegisterScreen.this, MainMenuScreen.class);
                        User user = new User(edtName.getText().toString(), edtSurnames.getText().toString(), edtMail.getText().toString(), edtPass2.getText().toString(), false);
                        if (!userDBdao.exists(insert(user))) {
                            userDBdao.insert(insert(user));
                            goMenu.putExtra("Acount", user);
                            startActivity(goMenu);
                        } else {
                            Toast.makeText(this, R.string.emailAlredyUsed, Toast.LENGTH_SHORT).show();
                        }

                    }
                }
            }
        } else {
            Toast.makeText(RegisterScreen.this, "No puede haber campos vacios", Toast.LENGTH_SHORT).show();
        }
    }

    // Method for check if any field is empty
    private boolean emptyFields() {
        if (!edtName.getText().toString().isEmpty()
                && !edtSurnames.getText().toString().isEmpty()
                && !edtMail.getText().toString().isEmpty()
                && !edtPass.getText().toString().isEmpty()
                && !edtPass2.getText().toString().isEmpty()) {
            return true;
        }
        return false;
    }

    // Method for check if introduced text is an email
    private boolean isEmailValid(String email) {
        return !(email == null || TextUtils.isEmpty(email)) && android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    // Method for check if password meet the requirements
    private static boolean isPasswordValid(String pass) {
        Pattern PASSWORD_PATTERN = Pattern.compile("[a-zA-Z0-9]{8,24}");
        return !TextUtils.isEmpty(pass) && PASSWORD_PATTERN.matcher(pass).matches();
    }

    // Method for check if the password is same in both editText
    private static boolean isSecondPasswordEqual(String pass, String pass2) {
        if (pass.equals(pass2)) {
            return true;
        }
        return false;
    }

    // Method for insert the user in the database if all is ok
    private ContentValues insert(User user) {
        ContentValues reg = new ContentValues();

        reg.put(USERS_COLUMN_NAME, edtName.getText().toString());
        reg.put(USERS_COLUMN_ADMIN, 0);
        reg.put(USERS_COLUMN_SURNAMES, edtSurnames.getText().toString());
        reg.put(USERS_COLUMN_EMAIL, edtMail.getText().toString());
        reg.put(USERS_COLUMN_PASSWORD, edtPass.getText().toString());

        return reg;
    }

}