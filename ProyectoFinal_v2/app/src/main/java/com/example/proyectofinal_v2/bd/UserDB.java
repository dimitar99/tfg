package com.example.proyectofinal_v2.bd;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

import com.example.proyectofinal_v2.pojo.User;

public class UserDB extends SQLiteOpenHelper {

    private static int version = 3;
    private static String nombreDB = "UserDB";
    private static SQLiteDatabase.CursorFactory factory = null;

    private String sqlCreateTableUsers = "CREATE TABLE users(" +
            " _id INTEGER PRIMARY KEY," +
            " administrator INTEGER NOT NULL," +
            " name TEXT NOT NULL, " +
            " surnames TEXT NOT NULL, " +
            " email TEXT NOT NULL, " +
            " password TEXT NOT NULL," +
            " photo INT)";

    private String sqlIndexEmailUser = "CREATE UNIQUE INDEX nombrecajeros ON users(email ASC)";

    private String[] sqlInsertDefaultUser = {"INSERT INTO users(_id, administrator, name, surnames, email, password) " +
            "VALUES(1, 1, 'Pepe', 'Gomez Valdoso', 'pepe@gmail.com', '1234')"};

    public UserDB(Context contexto) {
        super(contexto, nombreDB, factory, version);
    }

    public UserDB(Context context, String name, SQLiteDatabase.CursorFactory factory, int version) {
        super(context, name, factory, version);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {

        // Sql sentence for create table
        db.execSQL(sqlCreateTableUsers);
        db.execSQL(sqlIndexEmailUser);

        Log.i("CreateUsersTable", "Created");

        // Insert data
        for(int i=0; i<sqlInsertDefaultUser.length; i++){
            db.execSQL(sqlInsertDefaultUser[i]);
        }

        Log.i("CreateUsersTable", "Data Loaded");
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        if(newVersion > oldVersion){
            //Eliminate existing tables
            db.execSQL("DROP TABLE IF EXISTS users");

            db.execSQL(sqlCreateTableUsers);
            db.execSQL(sqlIndexEmailUser);

            for(int i=0; i<sqlInsertDefaultUser.length; i++){
                db.execSQL(sqlInsertDefaultUser[i]);
            }
        }
    }

}
