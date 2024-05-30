import React from "react";
import { Link } from "react-router-dom";
import styles from "./style.module.css";

import logo from "../../Assets/Logo.png";
import heroImg from "../../Assets/Auth/heroImg.png";
import FormGroup from "../../Components/FormGroup";
import Checkbox from "../../Components/Checkbox";
import Navbar from "../../Components/Navbar";

const Register = () => {
  return (
    <>
      <Navbar />
      <div className={styles.container}>
        {/* left side start */}
        <div>
          <div className={styles.formContainer}>
            <div className={styles.headContainer}>
              <img src={logo} alt="logo" className={styles.logo} />
              <h3 className={styles.title}>Registieren</h3>
            </div>

            <form className={styles.form}>
              <FormGroup
                id={"username"}
                label={"Benutzername*"}
                name={"username"}
                onChange={() => {
                  console.log("here");
                }}
                placeholder={"username"}
              />
              <FormGroup
                id={"name"}
                label={"Name*"}
                name={"name"}
                onChange={() => {
                  console.log("name");
                }}
                placeholder={"Ihre name eingeben"}
              />
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
              <button type="submit" className={styles.submitBtn} >
                Los Gehts!
              </button>
              <p className={styles.registerText}>
                Haben Sie schon ein Konto?{" "}
                <Link href="/login" className={styles.link}>
                  Sich anmelden
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

export default Register;
