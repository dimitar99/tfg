package com.example.proyectofinal_v2.adapter;

import android.content.Context;
import android.database.Cursor;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CursorAdapter;
import android.widget.TextView;

import com.example.proyectofinal_v2.dao.UserDBdao;

import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_EMAIL;
import static com.example.proyectofinal_v2.dao.UserDBdao.USERS_COLUMN_NAME;

public class UsersCursorAdapter extends CursorAdapter {

    private UserDBdao userDBdao = null;

    public UsersCursorAdapter(Context context, Cursor c){
        super(context, c);

        userDBdao = new UserDBdao(context);
        userDBdao.open();
    }

    @Override
    public View newView(Context context, Cursor cursor, ViewGroup parent) {
        LayoutInflater inflater = LayoutInflater.from(context);
        View view = inflater.inflate(android.R.layout.simple_spinner_dropdown_item, parent, false);
        return view;
    }

    @Override
    public void bindView(View view, Context context, Cursor cursor) {
        TextView txtView = (TextView) view;

        int i = cursor.getColumnIndex(USERS_COLUMN_EMAIL);

        txtView.setText(cursor.getString(i));
    }
}
