import React from "react";
import { BrowserRouter } from "react-router-dom";
import HomeRouter from "./Routers/HomeRouter";

import "./Styles/global.css";

function App() {
  return (
    <BrowserRouter>
      <HomeRouter />
    </BrowserRouter>
  );
}

export default App;
