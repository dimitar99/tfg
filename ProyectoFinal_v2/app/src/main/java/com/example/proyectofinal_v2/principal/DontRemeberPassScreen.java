package com.example.proyectofinal_v2.principal;

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

public class DontRemeberPassScreen extends AppCompatActivity {

    EditText edtMail;
    Button recoverPass, back;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dont_remeber_pass);

        // Instances
        edtMail = (EditText) findViewById(R.id.edtEmailDontRemeberPass);
        recoverPass = (Button) findViewById(R.id.btnRecoverPass);
        recoverPass.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {validateFields();}
        });

        back = (Button) findViewById(R.id.btnReturnDontRememberPass);
        back.setOnClickListener(new View.OnClickListener() {
            @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP)
            @Override
            public void onClick(View v) {
                finishAndRemoveTask();
            }
        });

    }

    //Method for validate fields
    public void validateFields(){
        if(emptyFields()){
            if(!isEmailValid(edtMail.getText().toString())){
                Toast.makeText(this, "Correo No Valido", Toast.LENGTH_SHORT).show();
            }else{
                Toast.makeText(this, "Comprueba tu correo", Toast.LENGTH_SHORT).show();
                Intent goLogin = new Intent(DontRemeberPassScreen.this, LoginScreen.class);
                startActivity(goLogin);
            }
        }else{
            Toast.makeText(DontRemeberPassScreen.this, "El campo correo no puede estar vacio", Toast.LENGTH_SHORT).show();
        }
    }

    // Method for check empty fields
    public boolean emptyFields(){
        if(!edtMail.getText().toString().isEmpty()){
            return true;
        }
        return false;
    }

    public boolean isEmailValid(String email) {
        return !(email == null || TextUtils.isEmpty(email)) && android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }
}