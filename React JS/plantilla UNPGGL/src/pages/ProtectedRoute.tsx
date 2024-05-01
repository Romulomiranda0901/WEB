import { ReactNode, useEffect } from "react";
import { useSelector } from "react-redux";
import { RootState } from "../store/store.ts";
import { useNavigate } from "react-router-dom";

type Props = {
    children: ReactNode | ReactNode[];
};

const ProtectedRoute = ({ children }: Props) => {
    const { isLogin } = useSelector((state: RootState) => state.auth);
    const navigate = useNavigate();

   // console.log(isLogin);
    useEffect(() => {
        if (isLogin === undefined || !isLogin) {
            navigate('/');
        }
    }, [isLogin, navigate]);

    return <>{isLogin ? children : null}</>;
};

export default ProtectedRoute;
