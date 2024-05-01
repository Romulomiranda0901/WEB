package com.example.knowingus;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.app.Service;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.firebase.database.ChildEventListener;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ServerValue;
import com.google.firebase.storage.FirebaseStorage;
import com.google.firebase.storage.StorageReference;
import com.google.firebase.storage.UploadTask;

import de.hdodenhof.circleimageview.CircleImageView;

import static android.widget.Toast.LENGTH_SHORT;


public class Chat extends AppCompatActivity {
    private CircleImageView fotoperfil;
    private TextView nombre;
    private RecyclerView rvmensajes;
    private EditText txtmensaje;
    private Button btnenviar;
    private  AdaterMensaje adater;
    private ImageButton btnenviarfoto;
    private FirebaseDatabase storage;
    private DatabaseReference storageReference;
    private FirebaseDatabase database;
    private DatabaseReference databaseReference;
    private static final int PHOTO_SEND = 1;
    private static final int PHOTO_PERFIL = 2;
    private String foto;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chat);
        fotoperfil= (CircleImageView) findViewById(R.id.fotoperfil);
        nombre= (TextView)findViewById(R.id.nombre);
        rvmensajes=(RecyclerView)findViewById(R.id.rvmensaje);
        txtmensaje=(EditText)findViewById(R.id.txtmensaje);
        btnenviar=(Button)findViewById(R.id.btnenviar);
        btnenviarfoto=(ImageButton)findViewById(R.id.btnenviarfoto);

        database = FirebaseDatabase.getInstance();
        databaseReference = database.getReference("chat");//sala del chat
        storage=FirebaseDatabase.getInstance();
        adater = new AdaterMensaje(this);
        LinearLayoutManager l = new LinearLayoutManager(this);
        rvmensajes.setLayoutManager(l);
        rvmensajes.setAdapter(adater);
        foto = "";
        btnenviar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (txtmensaje.getText().toString().equals(""))
                {
                    Toast toast1 = Toast.makeText(getApplicationContext(), "Ingrese un texto", Toast.LENGTH_SHORT);


                    toast1.show();
                } else
                {
                    databaseReference.push().setValue(new MensajeEnviar(txtmensaje.getText().toString(),nombre.getText().toString(),"","1", ServerValue.TIMESTAMP));
                    txtmensaje.setText("");
                }



            }});
        btnenviarfoto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent i = new Intent(Intent.ACTION_PICK);
                //i.setType("image/jpeg");
                i.setType("image/*");
                startActivityForResult(i,PHOTO_SEND);

            }
        });
        fotoperfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(Intent.ACTION_PICK);
                //i.setType("image/jpeg");
                i.setType("image/*");
                startActivityForResult(i,PHOTO_PERFIL);
            }
        });
        adater.registerAdapterDataObserver(new RecyclerView.AdapterDataObserver() {
            @Override
            public void onItemRangeInserted(int positionStart, int itemCount) {
                super.onItemRangeInserted(positionStart, itemCount);
                setScrollbar();
            }
        });
        databaseReference.addChildEventListener(new ChildEventListener() {
            @Override
            public void onChildAdded(DataSnapshot dataSnapshot, String s) {
                MensajeRecibir m = dataSnapshot.getValue(MensajeRecibir.class);
                adater.addMensaje(m);
            }

            @Override
            public void onChildChanged(DataSnapshot dataSnapshot, String s) {

            }

            @Override
            public void onChildRemoved(DataSnapshot dataSnapshot) {

            }

            @Override
            public void onChildMoved(DataSnapshot dataSnapshot, String s) {

            }

            @Override
            public void onCancelled(DatabaseError databaseError) {

            }
        });
    }
    private void setScrollbar(){
        rvmensajes.scrollToPosition(adater.getItemCount()-1);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
       // if ( requestCode == PHOTO_SEND ){
         //   Uri u = data.getData();
           // storageReference = storage.getReference("Chat_imagen");
           // final DatabaseReference fotoreferencia = storageReference.child(u.getLastPathSegment());
           // fotoreferencia.putFile(u).addOnSuccessListener(this, new OnSuccessListener<UploadTask.TaskSnapshot>() {
             //   @Override
               // public void onSuccess(UploadTask.TaskSnapshot taskSnapshot) {
                 //   Log.e("insertando imagen1","imagen");
                   // Uri u = taskSnapshot.getDownloadUrl();
                   // Log.e("insertando imagen2","imagen");

                   // MensajeEnviar m = new MensajeEnviar("Imagen enviada ",u.toString(),nombre.getText().toString(),foto,"2", ServerValue.TIMESTAMP);
                   // Log.e("insertando imagen3","imagen");

                   // databaseReference.push().setValue(m);
                   // Log.e("insertando imagen4","imagen");


      //          }
    //        });

       // }else if (requestCode == PHOTO_PERFIL ){
         //   Uri u = data.getData();
           // foto=u.toString();
           // storageReference = storage.getReference("FotoPerfil");
           // final DatabaseReference fotoreferencia = storageReference.child(u.getLastPathSegment());
           // fotoreferencia.putFile(u).addOnSuccessListener(this, new OnSuccessListener<UploadTask.TaskSnapshot>() {
             //   @Override
             //   public void onSuccess(UploadTask.TaskSnapshot taskSnapshot) {
               //     Uri u = taskSnapshot.getDownloadUrl();
                 //   MensajeEnviar m = new MensajeEnviar("Se cambio la foto de perfil",u.toString(),nombre.getText().toString(),foto,"2", ServerValue.TIMESTAMP);
                   // databaseReference.push().setValue(m);
                   // Glide.with(Chat.this).load(u.toString()).into(fotoperfil);

            //    }
           // });

        }
    }
//}
