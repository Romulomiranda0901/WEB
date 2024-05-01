package com.example.knowingus;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageButton;
import android.widget.Toast;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class Inicio_Activity extends AppCompatActivity {

    BottomNavigationView bottomNavigationView;
    ImageButton imgBotonGeolocalizacion,imgBotonQr,imgBotonClima;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_de_inicio);

    imgBotonClima = findViewById(R.id.imageButton2);
    imgBotonGeolocalizacion = findViewById(R.id.imageButton3);
    imgBotonQr = findViewById(R.id.imageButton4);


    bottomNavigationView = findViewById(R.id.navigationView);
    bottomNavigationView.setOnNavigationItemReselectedListener(new BottomNavigationView.OnNavigationItemReselectedListener() {
        @Override
        public void onNavigationItemReselected(@NonNull MenuItem menuItem) {


            imgBotonClima.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent intent = new Intent(Inicio_Activity.this, Clima.class);
                    startActivity(intent);

                }
            });

            imgBotonGeolocalizacion.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Toast.makeText(Inicio_Activity.this, "Proximamente", Toast.LENGTH_SHORT).show();

                }
            });

            imgBotonQr.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent intent = new Intent(Inicio_Activity.this, LectorQr.class);
                    startActivity(intent);

                }
            });

            if(menuItem.getItemId() == R.id.navigation_home){

            }
            if(menuItem.getItemId() == R.id.navigation_map){

                Intent intent = new Intent(Inicio_Activity.this, MapsActivity.class);
                startActivity(intent);
            }
            if(menuItem.getItemId() == R.id.navigation_notifications){

                Intent intent = new Intent(Inicio_Activity.this, Chat.class);
                startActivity(intent);
            }
            if(menuItem.getItemId() == R.id.navigation_perfil){

                 Intent intent = new Intent(Inicio_Activity.this, PerfilActivity.class);
                  startActivity(intent);
            }


        }
    });
    }
}
