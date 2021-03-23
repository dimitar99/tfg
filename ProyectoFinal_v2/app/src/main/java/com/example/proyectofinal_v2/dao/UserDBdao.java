package com.example.proyectofinal_v2.dao;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.widget.Toast;

import com.example.proyectofinal_v2.R;
import com.example.proyectofinal_v2.bd.UserDB;
import com.example.proyectofinal_v2.pojo.User;

public class UserDBdao {

    public static final String USERS_TABLE = "users";
    public static final String USERS_COLUMN_ID = "_id";
    public static final String USERS_COLUMN_ADMIN = "administrator";
    public static final String USERS_COLUMN_NAME = "name";
    public static final String USERS_COLUMN_SURNAMES = "surnames";
    public static final String USERS_COLUMN_EMAIL = "email";
    public static final String USERS_COLUMN_PASSWORD = "password";

    private Context context;
    private UserDB userDB;
    private SQLiteDatabase db;

    private String[] columns = new String[]{USERS_COLUMN_ID, USERS_COLUMN_ADMIN, USERS_COLUMN_NAME,
            USERS_COLUMN_SURNAMES, USERS_COLUMN_EMAIL, USERS_COLUMN_PASSWORD};

    public UserDBdao(Context context) {
        this.context = context;
    }

    public UserDBdao open() {
        userDB = new UserDB(context);
        db = userDB.getWritableDatabase();
        return this;
    }

    public void close() {
        userDB.close();
    }

    public Cursor getCursor() {
        Cursor c = db.query(true, USERS_TABLE, columns, null, null, null, null, null, null);
        return c;
    }

    public Cursor getRegister(long id) {
        String condition = USERS_COLUMN_ID + "=" + id;
        Cursor c = db.query(true, USERS_TABLE, columns, condition, null, null, null, null, null, null);

        if (c != null) {
            c.moveToFirst();
        }
        return c;
    }

    public long insert(ContentValues reg) {
        if (db == null)
            open();
        return db.insert(USERS_TABLE, null, reg);
    }

    public long update(ContentValues reg) {
        long result = 0;
        long id = 0;

        if (db == null) open();
        if (reg.containsKey(USERS_COLUMN_ID)) {
            id = reg.getAsLong(USERS_COLUMN_ID);
            reg.remove(USERS_COLUMN_ID);
        }
        result = db.update(USERS_TABLE, reg, "_id=" + id, null);
        return result;
    }

    public long delete(long id) {
        if (db == null) open();
        return db.delete(USERS_TABLE, "_id=" + id, null);
    }

    public boolean exists(ContentValues reg) {
        if (db == null) open();

        String sql = "SELECT * FROM users WHERE email='" + reg.get(USERS_COLUMN_EMAIL).toString() + "';";
        Cursor cursor = db.rawQuery(sql, null);

        if (cursor.getCount() > 0) {
            return true;
        }

        return false;
    }

    public User login(ContentValues reg) {
        if (db == null) open();

        String sql = "SELECT * FROM users WHERE email='" + reg.get(USERS_COLUMN_EMAIL).toString() + "'AND password='" + reg.get(USERS_COLUMN_PASSWORD).toString() + "';";
        Cursor cursor = db.rawQuery(sql, null);

        if (cursor.getCount() > 0) {
            cursor.moveToFirst();
            User u = new User();
            u.setName(cursor.getString(cursor.getColumnIndex(USERS_COLUMN_NAME)));
            u.setSurnames(cursor.getString(cursor.getColumnIndex(USERS_COLUMN_SURNAMES)));
            u.setEmail(cursor.getString(cursor.getColumnIndex(USERS_COLUMN_EMAIL)));
            u.setPassword(cursor.getString(cursor.getColumnIndex(USERS_COLUMN_PASSWORD)));
            if(cursor.getInt(cursor.getColumnIndex(USERS_COLUMN_ADMIN)) == 1){
                u.setAdministrator(true);
            }else {
                u.setAdministrator(false);
            }

            return u;
        }

        return null;

    }

}
