import React from "react";
import { Link } from "react-router-dom";
import styles from "./style.module.css";

import logo from "../../Assets/Logo.png";
import heroImg from "../../Assets/Auth/heroImg.png";
import FormGroup from "../../Components/FormGroup";
import Checkbox from "../../Components/Checkbox";
import Navbar from "../../Components/Navbar";


const Login = () => {
  return (
    <>
      <Navbar />
      <div className={styles.container}>
        {/* left side start */}
        <div>
          <div className={styles.formContainer}>
            <div className={styles.headContainer}>
              <img src={logo} alt="logo" className={styles.logo} />
              <div className={styles.titleContainer}>
                <h3 className={styles.title}>Anmelden bei Ihrem Konto</h3>

                <p className={styles.subTitle}>
                  Willkommen zurück! Bitte geben Sie Ihre details ein.
                </p>
              </div>
            </div>

            <form className={styles.form} >
              <FormGroup
                id={"email"}
                label={"E-mail*"}
                name={"email"}
                onChange={() => {
                  console.log("email");
                }}
                placeholder={"Ihre E-Mail eingeben"}
              />
              <FormGroup
                id={"password"}
                label={"Passwort*"}
                name={"password"}
                onChange={() => {
                  console.log("password");
                }}
                placeholder={"••••••••"}
                type={"password"}
                info={"Muss mindestens 8 Zeichen haben."}
              />
              <Checkbox /> {/* ! Güncellenecek Elemet- şuanda statik */}
              <button type="submit" className={styles.submitBtn}>
                Anmelden
              </button>
              <p className={styles.registerText}>
                Sie haben noch kein Konto?{" "}
                <Link to="/register" className={styles.link}>
                  Registieren
                </Link>
              </p>
            </form>
          </div>
          <div className={styles.footerContainer}>
            <p className={styles.footerText}>
              © 2016 - 2024 VIP GmbH. All Rights Reserved.
            </p>
          </div>
        </div>
        {/* left side end */}

        {/* right side start */}
        <div className={styles.heroImgContainer}>
          <img src={heroImg} alt="" className={styles.heroImg} />
        </div>
        {/* right side end */}
      </div>
    </>
  );
};

export default Login;
