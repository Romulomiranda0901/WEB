import { saveAs } from 'file-saver';

export const downloadPdf =  (url,fileName) => {

   /* const fileURL = `${process.env.REACT_APP_API_URL}${url}`;
    fetch( fileURL, {
        method: 'GET',
        mode: 'cors',
        headers: {
            'Content-Type': 'application/pdf',
        }

    })
        .then((response) => response.blob())
        .then((blob) => {
            // Create blob link to download
            const url = window.URL.createObjectURL(
                new Blob([blob]),
            );
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute(
                'download',
                `FileName.pdf`,
            );

            // Append to html link element page
            document.body.appendChild(link);

            // Start download
            link.click();

            // Clean up and remove the link
            link.parentNode.removeChild(link);
        });*/

    const oReq = new XMLHttpRequest();
// El punto final de su servidor
 //   const URLToPDF = `${process.env.REACT_APP_API_URL}${url}`;
   // const URLToPDF = "http://localhost:8000/ArchivosGeneral/ualn_18-07-2022_15_35_42.pdf";

// Configurar XMLHttpRequest
    oReq.open("GET",  `${process.env.REACT_APP_API_URL}/api/${url}`, true);

// Importante para usar el tipo de respuesta de blob
    oReq.responseType = "blob";

// Cuando finaliza la solicitud del archivo
// Depende de usted, la configuración de eventos de error, etc.
    oReq.onload = function() {
        // Una vez descargado el archivo, abre una nueva ventana con el PDF
        // Recuerde permitir los POP-UPS en su navegador
        const file = new Blob([oReq.response], {
            type: 'application/pdf'
        });

        // ¡Genere la descarga de archivos directamente en el navegador!
        saveAs(file, fileName);
    };

    oReq.send();

}