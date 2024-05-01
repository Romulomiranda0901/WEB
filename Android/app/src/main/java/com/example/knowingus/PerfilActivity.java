package com.example.knowingus;

import androidx.appcompat.app.AppCompatActivity;

import android.media.Image;
import android.net.Uri;
import android.os.Bundle;
import android.widget.ImageView;
import android.widget.TextView;

public class PerfilActivity extends AppCompatActivity {


    ImageView imagenPerfil;
    TextView textoPerfil, textoCorreo,textoNombre;
    Uri fotoPerfil;
    String nombre,correo;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_perfil);
         ClassPerfil.account.getDisplayName();

         textoNombre = findViewById(R.id.IdNombrePerfil);
         textoCorreo = findViewById(R.id.IdCorreoPerfil);

         imagenPerfil = (ImageView ) findViewById(R.id.idImagenPerfil);

         nombre = ClassPerfil.account.getGivenName()+" "+ ClassPerfil.account.getFamilyName();

         correo = ClassPerfil.account.getEmail();
         fotoPerfil = ClassPerfil.account.getPhotoUrl();

         //imagenPerfil.setImageBitmap(ClassPerfil.account.getPhotoUrl());
        fotoPerfil = ClassPerfil.account.getPhotoUrl();
        imagenPerfil.setImageURI(fotoPerfil);
         textoNombre.setText(nombre);
         textoCorreo.setText(correo);






    }


}
