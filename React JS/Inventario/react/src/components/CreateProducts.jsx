import React,{useState} from "react";
import axios from "axios";
import {useNavigate} from "react-router-dom";
const endpiont = 'http://localhost:8000/api/products';
const CreateProduct = ()=>{
    const [description,setdescription] = useState('');
    const [price,setprice] = useState(0);
    const [stock,setstock] = useState(0);
    const navigate = useNavigate();


    const store = async (e)=>{
        e.preventDefault();
       await axios.post(endpiont,{description:description,price:price,stock:stock})
        navigate('/')
    }

    return (
        <div>
            <h3>Create Product</h3>
            <form onSubmit={store}>
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
export default CreateProduct