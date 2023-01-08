import React from 'react';
import './App.css';
import Login from "../../pages/Login/Login";
import useToken from "./useToken";
import AppRoutes from "../../routes";

function App() {
    const { token, setToken } = useToken();

    if(!token){
        return <Login setToken={setToken} />
    }

    return(
        <div className="wrapper">
            <h1>Application</h1>
            <AppRoutes />
        </div>
    );
}

export default App;
