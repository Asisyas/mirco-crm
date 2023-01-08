import React from "react";
import {Navigate, Route} from "react-router-dom";

const RouteGuard = ({component: Component, ...rest}) => {
  function hasToken() {
    return !!localStorage.getItem("token");
  }

  return (
    <Route {...rest}
      render={props => (
        hasToken() ?
          <Component {...props} /> :
          <Navigate to="/login" replace/>
      )}
    />
  );
}

export default RouteGuard;
