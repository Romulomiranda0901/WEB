import * as React from 'react';
import Button from '@mui/material/Button';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';

export default function About() {
  const [open, setOpen] = React.useState(false);

  const handleClickOpen = () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

  return (
    <div>
      <Button variant="contained" color='success' onClick={handleClickOpen}>
        Leer mas
      </Button>
      <Dialog
        open={open}
        onClose={handleClose}
        aria-labelledby="alert-dialog-title"
        aria-describedby="alert-dialog-description"
        sm={{ mt: 1, Width: 180 }}
      >
        <DialogTitle id="alert-dialog-title" variant='success'>
          {"Misíon"}
        </DialogTitle>
        <DialogContent>
          <DialogContentText id="alert-dialog-description" variant='contained'>
            El Rally Nacional es una competencia desarrollada para buscar resolver desafíos que consistirán en 
            problemas reales que requieran de una solución creativa, no estando limitados únicamente al ámbito tecnológico, 
            pudiendo ser de varios sectores de actividades o temas sociales, ambientales, organizacionales, artísticos, 
            logísticos o de otro tipo y una interacción de tipo lúdico creativa entre dos equipos de diferentes países o 
            culturas.
          </DialogContentText>
          <DialogTitle id="alert-dialog-tittle" variant='success'>
            {"Visión"}
          </DialogTitle>
          <DialogContentText id="alert-dialog-description" variant='contained'>
            El Rally Nacional es una competencia desarrollada para buscar resolver desafíos que consistirán en 
            problemas reales que requieran de una solución creativa, no estando limitados únicamente al ámbito tecnológico, 
            pudiendo ser de varios sectores de actividades o temas sociales, ambientales, organizacionales, artísticos, 
            logísticos o de otro tipo y una interacción de tipo lúdico creativa entre dos equipos de diferentes países o 
            culturas.
          </DialogContentText>
        </DialogContent>
        <DialogActions>
          <Button onClick={handleClose} autoFocus>
            Cerrar
          </Button>
        </DialogActions>
      </Dialog>
    </div>
  );
}
