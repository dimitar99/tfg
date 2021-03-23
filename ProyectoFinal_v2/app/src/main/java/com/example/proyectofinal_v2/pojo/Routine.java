package com.example.proyectofinal_v2.pojo;

public class Routine {

    public enum Type {
        CARDIO,
        ARMS,
        CHEST,
        BACK,
        LEGS,
        ABS
    }

    private Type type;
    private String name, url;

    public Routine() {

    }

    public Routine(Type type, String name, String url) {
        this.type = type;
        this.name = name;
        this.url = url;
    }

    public Type getType() {
        return type;
    }

    public void setTipe(Type tipe) {
        this.type = type;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setType(Type type) {
        this.type = type;
    }

    public String getUrl() {
        return url;
    }

    public void setUrl(String url) {
        this.url = url;
    }

    @Override
    public String toString() {
        return "Routine{" +
                "tipe=" + type +
                ", name='" + name + '\'' +
                '}';
    }
}
