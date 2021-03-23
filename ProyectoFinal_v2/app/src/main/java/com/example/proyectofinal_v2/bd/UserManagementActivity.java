package com.example.proyectofinal_v2.bd;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.app.AlertDialog;
import android.content.ContentValues;
import android.content.DialogInterface;
import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.dao.UserDBdao;

import static com.example.proyectofinal_v2.bd.Constants.C_CREATE;
import static com.example.proyectofinal_v2.bd.Constants.C_EDIT;
import static com.example.proyectofinal_v2.bd.Constants.C_MODE;
import static com.example.proyectofinal_v2.bd.Constants.C_VISUALICE;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_ADMIN;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_EMAIL;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_ID;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_NAME;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_PASSWORD;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_SURNAMES;

public class UserManagementActivity extends AppCompatActivity implements View.OnClickListener {

    private UserDBdao userDBdao;
    private Cursor cursor;
    private int mode;
    private long id;
    private EditText name, surnames, email, password;
    private CheckBox administrator;
    private Button cancel, submit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_management);

        // Get Extras for SettinsScreen
        Intent intent = getIntent();
        Bundle extra = intent.getExtras();

        if (extra == null) return;

        // Instance of EditTexts
        name = (EditText) findViewById(R.id.userManagementEdtUserName);
        surnames = (EditText) findViewById(R.id.userManagementEdtUserSurnames);
        email = (EditText) findViewById(R.id.userManagementEdtUserEmail);
        password = (EditText) findViewById(R.id.userManagementEdtUserPassword);
        administrator = (CheckBox) findViewById(R.id.userManagementCheckboxUserAdmin);

        // Instance of Buttons
        cancel = (Button) findViewById(R.id.userManagementBtnCancel);
        submit = (Button) findViewById(R.id.userManagementBtnSubmit);

        // Instance of database
        userDBdao = new UserDBdao(this);

        // Open database
        try {
            userDBdao.open();
        } catch (Exception e) {
            e.printStackTrace();
        }

        // Get id of database
        if (extra.containsKey(USERS_COLUMN_ID)) {
            id = extra.getLong(USERS_COLUMN_ID);
            consult(id);
        }

        // Set mode
        setMode(extra.getInt(C_MODE));

        // Set on click listener for buttons
        cancel.setOnClickListener(this);
        submit.setOnClickListener(this);

    }


    private void consult(long id) {
        cursor = userDBdao.getRegister(id);

        name.setText(cursor.getString(cursor.getColumnIndex(USERS_COLUMN_NAME)));
        if(cursor.getInt(cursor.getColumnIndex(USERS_COLUMN_ADMIN)) == 0){
            administrator.setChecked(false);
        }else{administrator.setChecked(true);};
        surnames.setText(cursor.getString(cursor.getColumnIndex(USERS_COLUMN_SURNAMES)));
        email.setText(cursor.getString(cursor.getColumnIndex(USERS_COLUMN_EMAIL)));
        password.setText(cursor.getString(cursor.getColumnIndex(USERS_COLUMN_PASSWORD)));
    }

    private void setMode(int m) {
        this.mode = m;

        if (mode == C_VISUALICE) {
            this.setTitle(name.getText().toString());
            this.setEditable(false);
        } else if (mode == C_CREATE) {
            this.setTitle(R.string.newUser);
            this.setEditable(true);
        } else if (mode == C_EDIT) {
            this.setTitle(R.string.editUser);
            this.setEditable(true);
        }
    }

    private void setEditable(boolean option) {
        name.setEnabled(option);
        administrator.setEnabled(option);
        surnames.setEnabled(option);
        email.setEnabled(option);
        password.setEnabled(option);
    }

    @Override
    public void onClick(View v) {
        if (v.getId() == R.id.userManagementBtnSubmit) save();
        if (v.getId() == R.id.userManagementBtnCancel) cancel();
    }

    // Method for save changes
    private void save() {
        ContentValues reg = new ContentValues();

        reg.put(USERS_COLUMN_NAME, name.getText().toString());
        if(administrator.isChecked()) reg.put(USERS_COLUMN_ADMIN, 1);
        else reg.put(USERS_COLUMN_ADMIN, 0);
        reg.put(USERS_COLUMN_SURNAMES, surnames.getText().toString());
        reg.put(USERS_COLUMN_EMAIL, email.getText().toString());
        reg.put(USERS_COLUMN_PASSWORD, password.getText().toString());

        if (mode == C_CREATE) {
            userDBdao.insert(reg);
            Toast.makeText(this, "Usuario Creado", Toast.LENGTH_SHORT).show();
        }

        if (mode == C_EDIT){
            reg.put(USERS_COLUMN_ID, id);
            userDBdao.update(reg);
        }

        setResult(RESULT_OK); finish();

    }

    private void cancel() {
        setResult(RESULT_CANCELED); finish();
    }

    private void delete(final long id) {
        AlertDialog.Builder dialogDelete = new AlertDialog.Builder(this);
        dialogDelete.setIcon(android.R.drawable.ic_dialog_alert);
        dialogDelete.setTitle(R.string.deleteUser);
        dialogDelete.setMessage(R.string.deleteUserQuestion);
        dialogDelete.setCancelable(false);
        dialogDelete.setPositiveButton(getResources().getString(android.R.string.ok), new
                DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int button) {
                        userDBdao.delete(id);
                        setResult(RESULT_OK);
                        finish();
                    }
                });
        dialogDelete.setNegativeButton(android.R.string.no, null);
        dialogDelete.show();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_edit_users, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == R.id.menuEditUsersOptEdit) setMode(C_EDIT);
        if (item.getItemId() == R.id.menuEditUsersOptDelete) delete(id);
        return super.onOptionsItemSelected(item);
    }
}