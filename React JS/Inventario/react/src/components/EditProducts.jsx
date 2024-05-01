import React, {useEffect, useState} from "react";
import axios from "axios";
import {useNavigate, useParams} from "react-router-dom";
const endpiont = 'http://localhost:8000/api/product';
const EditProduct = ()=>{


    const [description,setdescription] = useState('');
    const [price,setprice] = useState(0);
    const [stock,setstock] = useState(0);
    const navigate = useNavigate();
    const {id} = useParams();
    const update = async (e)=> {
        e.preventDefault();
        await axios.put(`${endpiont}/${id}`,{
            description:description,price:price,stock:stock
        })
        navigate('/')

    }
    useEffect(()=>{
        const getProductById = async ()=>{
        const response = await  axios.get(`${endpiont}/${id}`)
           setdescription(response.data.description)
           setprice(response.data.price)
           setstock(response.data.stock)
        }
        getProductById();
    },[])

    return (
        <div>
            <h3>Edit Product</h3>
            <form onSubmit={update}>
                <div className='mb-3'>
                    <label className='form-label'>
                        Description
                    </label>
                    <input value={description}
                           onChange={(e) => setdescription(e.target.value)}
                           type='text'
                           className='form-control'
                    />
                </div>
                <div className='mb-3'>
                    <label className='form-label'>
                        Price
                    </label>
                    <input value={price}
                           onChange={(e) => setprice(e.target.value)}
                           type='number'
                           className='form-control'
                    />
                </div>
                <div className='mb-3'>
                    <label className='form-label'>
                        Stock
                    </label>
                    <input value={stock}
                           onChange={(e) => setstock(e.target.value)}
                           type='number'
                           className='form-control'
                    />
                </div>
                <button type='submit' className='btn btn-primary'>Store</button>
            </form>
        </div>
    )
}
export default EditProduct