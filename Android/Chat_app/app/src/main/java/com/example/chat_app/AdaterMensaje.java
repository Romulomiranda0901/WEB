package com.example.chat_app;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class AdaterMensaje extends RecyclerView.Adapter<HolderMensaje> {
    List<MensajeRecibir> listMensaje = new ArrayList<>();

    public AdaterMensaje(Context c) {
        this.c = c;
    }

    private Context c;
    public void addMensaje(MensajeRecibir m){
        listMensaje.add(m);
        notifyItemInserted(listMensaje.size());
    }
    @NonNull
    @Override
    public HolderMensaje onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(c).inflate(R.layout.card_view_mensaje,parent,false);
        return new HolderMensaje(v);
    }

    @Override
    public void onBindViewHolder(@NonNull HolderMensaje holder, int position) {
               holder.getNombre().setText(listMensaje.get(position).getNombre());
               holder.getMensaje().setText(listMensaje.get(position).getMensaje());

               if (listMensaje.get(position).getType_mensaje().equals("2")){
                    holder.getFotoMensajeEnv().setVisibility(View.VISIBLE);
                    holder.getMensaje().setVisibility(View.VISIBLE);
                   Glide.with(c).load(listMensaje.get(position).getUrlfoto()).into(holder.getFotoMensajeEnv());
               }else   if (listMensaje.get(position).getType_mensaje().equals("1")){
                   holder.getFotoMensajeEnv().setVisibility(View.GONE);
                   holder.getMensaje().setVisibility(View.VISIBLE);
               }

               if (listMensaje.get(position).getFotoperfil().isEmpty()){
                   holder.getFotoMensaje().setImageResource(R.mipmap.ic_launcher);
               }else {
                   Glide.with(c).load(listMensaje.get(position).getFotoperfil()).into(holder.getFotoMensaje());
               }

               long codigohora = listMensaje.get(position).getHora();
        Date d = new Date(codigohora);
        SimpleDateFormat sdf = new SimpleDateFormat("hh:mm:ss a");
        holder.getHora().setText(sdf.format(d));
    }

    @Override
    public int getItemCount() {
        return listMensaje.size();
    }
}
