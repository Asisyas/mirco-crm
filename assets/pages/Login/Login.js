import React from "react";
import './Login.css';
import PropTypes from 'prop-types';
import { Button } from '@epam/promo';

async function loginUser() {
    const config = await fetch('/security/configuration').then(data => data.json());

    location.href = config.urlAuth.replace('keycloak', 'localhost');
}

export default function Login() {
    const login = async e => {
        await loginUser();
    }

    return (
        <div className="login-wrapper">
            <h1>Please Log In</h1>
              <div>
                  <Button color='blue' caption='Login' onClick={ login } />
              </div>
        </div>
    );
}

Login.propTypes = {
    setToken: PropTypes.func.isRequired
}
