package com.example.referenciashistoricas;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;

public class Informacion extends AppCompatActivity {

    private ImageView ivItems;
    private Adactador adactador;
    int bb;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        ivItems=findViewById(R.id.ivImagen);
        

        // ivItems.setImageDrawable(getDrawable(datospublicos.nombreImagen));





    }
}
