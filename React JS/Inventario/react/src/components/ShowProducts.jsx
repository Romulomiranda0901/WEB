import React,{useEffect,useState} from "react";
import axios from "axios";
import {Link} from "react-router-dom";

const endpiont = 'http://localhost:8000/api';
const ShowProducts = ()=>{
    const [products,setproducts] = useState([]);



    useEffect(()=>{
        gelAllProduct()
    })


    const gelAllProduct = async () =>{
       const response =await axios.get(`${endpiont}/products`) .then(response => {
           setproducts(response.data);
       })
           .catch(error => {
               // Manejar el error, incluido el código de estado 429
               console.error(error.message);

               if (error.response && error.response.status === 429) {
                   setTimeout(() => {
                       gelAllProduct();
                   }, 1000); // Espera 1 segundo antes de hacer la próxima solicitud
               }
           });

    }
    const deleteProduct = async(id) =>{
        const response =await axios.delete(`${endpiont}/products/${id}`).then(response => {
            setproducts(response.data);
        })
            .catch(error => {
                // Manejar el error, incluido el código de estado 429
                console.error(error.message);

                if (error.response && error.response.status === 429) {
                    setTimeout(() => {
                        gelAllProduct();
                    }, 1000); // Espera 1 segundo antes de hacer la próxima solicitud
                }
            });

    }
    return (
        <div>
            <div className='d-grid gap-2'>
                <Link to='/create' className='btn btn-success btn-lg mt-2 mb-2 text-white'>create</Link>
            </div>
            <table className='table table-striped'>
                <thead className='bg-primary text-white'>
                <tr>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                {products.map((product)=>(
                    <tr key={product.id}>
                        <td>{product.description}</td>
                        <td>{product.price}</td>
                        <td>{product.stock}</td>
                        <td>
                            <Link to={`/edit/${product.id}`} className='btn btn-warning mr-2'>Edit</Link>

                            <button onClick={ ()=>deleteProduct(product.id)} className='btn btn-danger ml-2'>Delete</button>
                        </td>
                    </tr>
                ))
                }
                </tbody>
            </table>
        </div>
    )
}
export default ShowProducts