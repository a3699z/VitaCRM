import React from "react";
import { Link } from "react-router-dom";
import styles from "./style.module.css";

import logo from "../../Assets/Logo.png";
import avatar from "../../Assets/Home/avatar.svg";
import menu from "../../Assets/Home/menu.svg";

const Navbar = () => {
  return (
    <nav className={styles.container}>
      <div className={styles.navbar}>
        <div className={styles.rightContainer}>
          <img src={logo} alt="logo" />

          <div className={styles.linkContainer}>
            <Link className={styles.link}>Was wir machen</Link>
            <Link className={styles.link}>Über uns</Link>
            <Link className={styles.link}>Kontakt</Link>
          </div>
        </div>

        <div className={styles.leftContainer}>
          <div className={styles.authContainer}>
            <Link className={styles.registerLink} to={"/register"}>
              Registrieren
            </Link>
            <Link className={styles.profileBtn} to={"/login"}>
              <img src={avatar} alt="" />
              Anmelden
            </Link>
          </div>
          <img src={menu} width={16} height={16} alt="" />
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
