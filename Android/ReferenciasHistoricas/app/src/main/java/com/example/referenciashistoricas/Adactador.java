package com.example.referenciashistoricas;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.ArrayList;

public class Adactador extends BaseAdapter {
    private Context context;
    private ArrayList<Lugares> listItems;
    public Adactador(Context context, ArrayList<Lugares> listItems) {
        this.context = context;
        this.listItems = listItems;
    }

    @Override
    public int getCount() { return listItems.size(); }

    @Override
    public Object getItem(int position) {
        return listItems.get(position);
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        Lugares Item = (Lugares) getItem(position);
        convertView= LayoutInflater.from(context).inflate(R.layout.items_personalizado, null);
        ImageView ivImagen= convertView.findViewById(R.id.ivImagen);
        TextView ivTitulo= convertView.findViewById(R.id.tvTitulo);
        TextView ivContenido= convertView.findViewById(R.id.tvContenido);

        ivImagen.setImageResource(Item.getImagen());

        ivTitulo.setText(Item.getTitulo());
        ivContenido.setText(Item.getContenido());



        return convertView;
    }
}
