package com.example.referenciashistoricas;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.media.Image;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {
    private ListView ivItems;
    private Adactador adaptador;
    ArrayList<Lugares> listItems = new ArrayList<>();



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        ivItems = findViewById(R.id.lvItems);
        adaptador =new Adactador(this, getArrarList());
        ivItems.setAdapter(adaptador);




    }
    private ArrayList<Lugares> getArrarList(){

        listItems.add(new Lugares(R.drawable.iglecia2, "Visitar las Iglecias de León",
                "Si hay algo que llama la atención en León es la gran cantidad de iglesias " +
                        "que tiene en relativamente poco espacio. Cuenta con más de 16 en la ciudad y " +
                        "muchas de ellas son realmente interesantes, ya sea por su historia –la más" +
                        " antigua es la de Sutiava- o por su aquitectura que va del barroco al neoclásico."));

        listItems.add(new Lugares(R.drawable.leonviejo, "Quiere conocer mas sobre la Historia de León visita  León viejo ",
                "La antigua –y original- ciudad de León, fundada en 1524 por Francisco Hernández de Córdoba quedó " +
                        "destrozada por terremotos y por la erupción del volcán Momotombo. En ese momento se decidió traslada " +
                        "la ciudad a donde se encuentra hoy.\n" +
                        "\n" +
                        "Las ruinas de la antigua ciudad quedaron abandonadas durante muchos años, hasta que en 1967 las " +
                        "redescubrieron unos arqueólogos y decidieron “revivirla y mantenerla relativamente bien” para que " +
                        "la gente pueda visitarla."));
        listItems.add(new Lugares(R.drawable.iglesiacentral, "Una de las iglecias mas Antiguaas",
                "La Basílica-Catedral de la Asunción de la Bienaventurada Virgen María (conocida " +
                        "simplemente como “Catedral de León”) es la mayor catedral de Centroamérica, es Patrimonio " +
                        "de la Humanidad y fue construida entre 1747 y 1814 con estilo ecléctico. Gracias a su robustez," +
                        " ha soportado erupciones volcánicas, terremotos y guerras.\n" +
                        "Su interior es muy sobrio y en ella se encuentra la tumba de algunos poetas como Rubén Dario " +
                        "y Salomón de la Selva y de otros ilustres como Miguel Larreynaga o José de la Cruz Mena.\n"));

        listItems.add(new Lugares(R.drawable.museoleyenda, "Museo de Leyendas y Mitos",
                "Durante siglos las leyendas fueron transmitidas de generación en" +
                        " generación via oral y ahora este museo las recoge en una colección de " +
                        "objetos y muñecos -bastante bizarro, todo sea dicho-.\n" +
                        "Un guía te contará una a una las leyendas, entre las que llaman la " +
                        "atención la del padre sin cabeza, la llorona, la “toma tu teta”, la novia de Tola," +
                        " la taconuda o la leyenda del viejo y el monte.\n"));

        listItems.add(new Lugares(R.drawable.museorevo, "Museo de la Revolución",
                "Los adoquines de las calles leonesas vieron derramada demasiada" +
                        " sangre. Aquí fueron asesinados desde estudiantes en la década de los 50’ " +
                        "a manos de la Guardia Nacional por protestar por una masacre realizada en" +
                        " El Chaparral, hasta la de Anastasio Somoza García –el dictador más sanguinario " +
                        "de la historia del país-.\n" +
                        "El Museo de la Revolución, ubicado en el edificio del antiguo palacio de comunicaciones" +
                        " a un lateral de la plaza central, está gestionado por la Asociación de Excombatientes" +
                        " Históricos Insurreccionales Héroes de Veracruz, todos ex combatientes en la liberación " +
                        "Sandinista para derrocar a Somoza.\n"));




        listItems.add(new Lugares(R.drawable.volcanbording, "Te la gusta la aventura? Aqui en el volcan Telica la encuentras",
                "Por último, una de las experiencias que no te debes perder si visitas León es la adrenalínica aventura de" +
                        " deslizarte a toda velocidad por la falda del Cerro Negro (730msnm) en culopatín (como “snowboard” o “sandboarding”" +
                        " pero sentado y deslizándote por polvo negro volcánico)." +
                        "Pero esta actividad no sólo te la recomiendo porque es muy divertida y te pone el pulso a mil (yo la hice con la gente" +
                        " de Quetzal Trekkers), sino porque las vistas desde el cráter del volcán Cerro Negro, que es uno de los más jóvenes de la " +
                        "tierra y está activo, son increíbles."));





        return listItems;

    }
}
