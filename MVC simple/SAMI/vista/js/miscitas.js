$(document).ready(function () {
         
    let usaurio = $("#informacion").text();
    
    console.log(usaurio);
    $.getJSON('../controlador/miscitas_controller.php',
    function (data) {
        
        for (var i = 0; i < data.length; i++) {
            $('#table').html($('#table').html() + `
            <tr>
            <td>
            ${data[i].planta}
            </td>
            <td>
            ${data[i].fecha}
            </td>
            <td>
            ${data[i].motivo}
            </td>
            <td>
            ${data[i].nombre + data[i].apellido}
            </td>
            <td>
            ${data[i].direccion}
            </td>
         
            </tr>
            `)
        }

    })
});
