package com.example.proyectofinal_v2.pojo;

import android.graphics.Bitmap;
import android.net.Uri;

import java.io.Serializable;

public class User implements Serializable {

    private String name, surnames, email, password;
    private boolean administrator;
    private Uri photo;

    public User(){
        this.name = "";
        this.surnames = "";
        this.email = "";
        this.password = "";
        this.administrator = false;
        this.photo = null;
    }

    public User(String name, String surnames, String email, String password, boolean administrator) {
        this.name = name;
        this.surnames = surnames;
        this.email = email;
        this.password = password;
        this.administrator = administrator;
        this.photo = null;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getSurnames() {
        return surnames;
    }

    public void setSurnames(String surnames) {
        this.surnames = surnames;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public boolean isAdministrator() {
        return administrator;
    }

    public void setAdministrator(boolean administrator) {
        this.administrator = administrator;
    }

    public Uri getPhoto() {
        return photo;
    }

    public void setPhoto(Uri photo) {
        this.photo = photo;
    }

    @Override
    public String toString() {
        return "User{" +
                "name='" + name + '\'' +
                ", surnames='" + surnames + '\'' +
                ", email='" + email + '\'' +
                ", password='" + password + '\'' +
                ", administrator=" + administrator +
                '}';
    }

}
