package com.example.proyectofinal_v2.principal;

import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.drawerlayout.widget.DrawerLayout;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.admin.UsersActivity;
import com.example.proyectofinal_v2.pojo.User;
import com.firebase.ui.auth.AuthUI;
import com.google.android.material.navigation.NavigationView;
import com.google.firebase.auth.FirebaseAuth;

import java.text.DecimalFormat;

public class IMCScreen extends AppCompatActivity {

    private EditText weight, size;
    private TextView imcResult, imcInformation;
    private Button btnCalculate;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_i_m_c_screen);

        // Instance of EditText
        weight = (EditText) findViewById(R.id.imcEdtWeight);
        size = (EditText) findViewById(R.id.imcEdtSize);

        // Instance of TextView
        imcResult = (TextView) findViewById(R.id.imcTxtImcResult);
        imcInformation = (TextView) findViewById(R.id.imcTxtResultInfo);

        // Instance of Button
        btnCalculate = (Button) findViewById(R.id.imcBtnCalculate);
        btnCalculate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                calculate();
            }
        });

    }

    // Method for calculate IMC
    private void calculate(){

        if(weight.getText().length() == 0 || size.getText().length() == 0){
            Toast.makeText(this, R.string.empty, Toast.LENGTH_SHORT).show();
        }else{
            double w = Float.parseFloat(weight.getText().toString());
            double s = Float.parseFloat(size.getText().toString());
            double imc = (w/(Math.pow(s/100, s/100)));
            DecimalFormat decimalFormat = new DecimalFormat("0.00");

            imcResult.setText("IMC: " + String.valueOf(decimalFormat.format(imc)));
            if(imc <= 18.5) imcInformation.setText(R.string.lowWeight);
            if(imc > 18.5 && imc <= 24.9) imcInformation.setText(R.string.normalWeight);
            if(imc > 24.9 && imc <= 26.9) imcInformation.setText(R.string.overWeight1);
            if(imc > 26.9 && imc <= 29.9) imcInformation.setText(R.string.overWeight2);
            if(imc > 29.9 && imc <= 34.9) imcInformation.setText(R.string.obesity1);
            if(imc > 34.9 && imc <= 39.9) imcInformation.setText(R.string.obesity2);
            if(imc > 39.9 && imc <= 49.9) imcInformation.setText(R.string.obesity3);
            if(imc > 49.9) imcInformation.setText(R.string.obesity4);
        }

    }
}