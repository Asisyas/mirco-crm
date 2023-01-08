import React from "react";
import './Login.css';
import PropTypes from 'prop-types';
import styled from "styled-components";

// Styled component named StyledButton
const StyledButton = styled.button`
  background-color: black;
  font-size: 32px;
  color: white;
`;

async function loginUser() {
    const config = await fetch('/security/configuration').then(data => data.json());

    location.href = config.urlAuth.replace('keycloak', 'localhost');
}

export default function Login() {
    const handleSubmit = async e => {
        e.preventDefault();
        await loginUser();
    }

    return (
        <div className="login-wrapper">
            <h1>Please Log In</h1>
            <form onSubmit={handleSubmit}>
                <div>
                    <StyledButton type="submit">Login</StyledButton>
                </div>
            </form>
        </div>
    );
}

Login.propTypes = {
    setToken: PropTypes.func.isRequired
}
