package com.example.chat_app;

import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import de.hdodenhof.circleimageview.CircleImageView;

public class HolderMensaje extends RecyclerView.ViewHolder {
    private TextView nombre;
    private TextView mensaje;
    private TextView hora;
    private CircleImageView fotoMensaje;
    private ImageView fotoMensajeEnv;
    public HolderMensaje(@NonNull View itemView) {
        super(itemView);
        nombre = (TextView) itemView.findViewById(R.id.nombremensaje);
        mensaje = (TextView) itemView.findViewById(R.id.mensaje);
        hora = (TextView) itemView.findViewById(R.id.horamensaje);
        fotoMensaje = (CircleImageView) itemView.findViewById(R.id.fotoperfilmensaje);
        fotoMensajeEnv = (ImageView) itemView.findViewById(R.id.fotomensajeenv);

    }

    public TextView getNombre() {
        return nombre;
    }

    public void setNombre(TextView nombre) {
        this.nombre = nombre;
    }

    public TextView getMensaje() {
        return mensaje;
    }

    public void setMensaje(TextView mensaje) {
        this.mensaje = mensaje;
    }

    public TextView getHora() {
        return hora;
    }

    public void setHora(TextView hora) {
        this.hora = hora;
    }

    public CircleImageView getFotoMensaje() {
        return fotoMensaje;
    }

    public void setFotoMensaje(CircleImageView fotoMensaje) {
        this.fotoMensaje = fotoMensaje;
    }

    public ImageView getFotoMensajeEnv() {
        return fotoMensajeEnv;
    }

    public void setFotoMensajeEnv(ImageView fotoMensajeEnv) {
        this.fotoMensajeEnv = fotoMensajeEnv;
    }
}
