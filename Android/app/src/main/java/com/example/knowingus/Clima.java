package com.example.knowingus;

import androidx.appcompat.app.AppCompatActivity;

import android.os.AsyncTask;
import android.os.Bundle;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class Clima extends AppCompatActivity {
    TextView result;
    class Weather extends AsyncTask<String,Void,String> {

        @Override
        protected String doInBackground(String... adrress) {
            try {
                URL url = new URL(adrress[0]);
                HttpURLConnection connection=(HttpURLConnection)url.openConnection();
                connection.connect();
                InputStream is = connection.getInputStream();
                InputStreamReader isr= new InputStreamReader(is);
                int data = isr.read();
                String content = "";
                char ch;
                while (data!=-1){
                    ch = (char)data;
                    content = content +ch;
                    data = isr.read();
                }
                return content;
            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_clima);
        result= findViewById(R.id.result);
        String cont;
        //String cName = editText.getText().toString();
        Weather weather = new Weather();
        try {
            cont = weather.execute("https://openweathermap.org/data/2.5/weather?q=León,Nicaragua&appid=b6907d289e10d714a6e88b30761fae22").get();
            JSONObject jsonObject = new JSONObject(cont);
            String weatherData = jsonObject.getString("weather");
            String mainTemperature = jsonObject.getString("main");
            double visibility;
            JSONArray array = new JSONArray(weatherData);

            String main="";
            String description="";
            String Temperature="";
            for (int i=0;i<array.length();i++){
                JSONObject weatherPart = array.getJSONObject(i);
                main = weatherPart.getString("main");
                description = weatherPart.getString("description");
            }

            JSONObject mainPart = new JSONObject(mainTemperature);
            Temperature = mainPart.getString("temp");
            visibility = Double.parseDouble(jsonObject.getString("visibility"));
            int visibilityinkm = (int) visibility/1000;
            String resultext = "Main :"+main+
                    "\ndescription:"+description+
                    "\nTemperature :"+Temperature+"ºC"
                    +"\nVisility :"+visibilityinkm+"km";

            result.setText(resultext);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
