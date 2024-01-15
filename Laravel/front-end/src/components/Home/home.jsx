import Header from "../Header";
import Footer from "../Footer";
import './css/index.css'
import {useRecoilState} from "recoil";
import {usuarioAtom} from "../../libs/RecoilState";
import {useEffect} from "react";

export default function Home()
{
    /*Hooks*/
    const [user, setUser] = useRecoilState(usuarioAtom);

    useEffect(() => {
        console.log(user);
    }, []);

    return (
        <div>
            <Header/>
            <div className="container">
                esto es una prueba
            </div>
            <Footer/>
        </div>

    )
}