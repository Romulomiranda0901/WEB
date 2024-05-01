import { useState } from "react/cjs/react.development"
import TableRows from "./TableRows"

function AddDeleteTableRows(props){


    const { setValue, values } = props;
    const [rowsData, setRowsData] = useState([]);


    let check ='';

    const addTableRows = ()=>{

        const rowsInput=  {
            coordinador: '',
            nombres:'',
            apellidos:'',
            cedula:'',
            genero_id:'',
            grupo_etnicos_id:'',
        }

        setRowsData([...rowsData, rowsInput])
        setValue([...rowsData,rowsInput])



    }


    const deleteTableRows = (index)=>{
        const rows = [...rowsData];
        rows.splice(index, 1);
        setRowsData(rows);
        setValue(rowsData)
   }

    const handleChange = (index, evnt)=>{

        const { name, value  } = evnt.target;
        if(evnt.target.name == 'coordinador' && evnt.target.checked == true)
        {
            props.setCoordinador(rowsData[index]['cedula'])
        }
        let rowsInput = [...rowsData];
        rowsInput[index][name] = value;
        setRowsData(rowsInput);
        setValue(rowsInput)




    }



    return(
        <div className="container">
            <div className="row">
                <div className="col-sm-12">
                <table className="table">
                    <thead>
                      <tr>
                          <th>Coordinador </th>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Cedula</th>
                          <th>Genero</th>
                          <th>Etnia</th>
                          <th><button className="btn btn-outline-success" onClick={addTableRows} >+</button></th>
                      </tr>
                    </thead>
                   <tbody>
                   <TableRows rowsData={rowsData} deleteTableRows={deleteTableRows} handleChange={handleChange} sexo = {props.genero} etnias={props.etnias}  />
                   </tbody> 
                </table>
                </div>
                <div className="col-sm-3">
                </div>
            </div>
        </div>
    )
}
export default AddDeleteTableRows