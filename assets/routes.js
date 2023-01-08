import React from "react";
import {Routes, Route, BrowserRouter, Navigate} from "react-router-dom";
import Login from "./pages/Login/Login";
import RouteGuard from "./components/RouteGuard";

// history
import {history} from "./helpers/history";

// pages
import Dashboard from "./pages/Dashboard/Dashboard";
import Preferences from "./pages/Preferences/Preferences";

export default function AppRoutes() {
  return (
    <BrowserRouter history={history}>
      <Routes>
        <Route exact path="/login" element={Login}/>
        <RouteGuard exact path="/dashboard" element={Dashboard}/>
        <RouteGuard exact path="/preferences" element={Preferences}/>
        <Route path="*" element={<Navigate to="/dashboard" replace />}/>
      </Routes>
    </BrowserRouter>
  );
}
