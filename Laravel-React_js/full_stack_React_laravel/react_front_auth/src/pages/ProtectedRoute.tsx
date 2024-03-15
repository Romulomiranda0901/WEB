import {ReactNode, useEffect} from "react";
import {useSelector} from "react-redux";
import {RootState} from "../store/store.ts";
import {useNavigate} from "react-router-dom";

type Props ={
    children: ReactNode | ReactNode[];
}
const ProtectedRoute = ({children}: Props) => {
    const {isLogin} = useSelector((state: RootState) =>  state.auth)

    console.log(isLogin,'es un login');

    const navigate = useNavigate();

    useEffect(()=>{
        if (!isLogin){
            navigate('/')
        }
    })


    return <>{children}</>
};

export default ProtectedRoute;