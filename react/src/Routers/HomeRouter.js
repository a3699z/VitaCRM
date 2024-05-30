import React from "react";
import { Route, Routes } from "react-router-dom";
import Home from "../Pages/Home";
import Register from "../Pages/Register";
import Login from "../Pages/Login";
import Profile from "../Pages/Profile";
import NewAppointment from "../Pages/NewAppointment";

const HomeRouter = () => {
  return (
    <Routes>
      <Route path="/" Component={Home} />
      <Route path="/register" Component={Register} />
      <Route path="/login" Component={Login} />
      <Route path="/profile" Component={Profile} />
      <Route path="/newAppointment" Component={NewAppointment} />
      <Route path="/profile/visit/:visitId" Component={Profile} />
    </Routes>
  );
};

export default HomeRouter;
