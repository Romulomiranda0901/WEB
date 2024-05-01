package com.example.referenciashistoricas;

public class Lugares {
    private int imagen;
    private String titulo;
    private String contenido;

    public Lugares(int imagen, String titulo, String contenido) {
        this.imagen = imagen;
        this.titulo = titulo;
        this.contenido = contenido;
    }

    public int getImagen() {
        return imagen;
    }

    public String getTitulo() {
        return titulo;
    }

    public String getContenido() {
        return contenido;
    }
}
