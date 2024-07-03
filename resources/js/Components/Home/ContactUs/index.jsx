import React from "react";
import styles from "./style.module.css";
import { Link } from "@inertiajs/react";

import leftTop from "@/Assets/Home/contactUs/leftTop.png";
import rightBottom from "@/Assets/Home/contactUs/rightBottom.png";

const ContactUs = () => {
  return (
    <div className={styles.container}>
      <div className={styles.content}>
        <h5 className={styles.title}>
          {/* Einfach einen <span className={styles.titleColored}>Termin</span>{" "} */}
          Vereinbaren Sie hier Ihren Termin
        </h5>
        {/* <p className={styles.paragraph}>
          Buchen Sie ganz einfach einen Termin bei einem Spezialisten Ihrer Wahl
          und vereinbaren Sie einen Termin für eine Konsultation mit dem besten
          Spezialisten.
        </p> */}
        <Link href="/register" className={styles.btn}>
          Kontaktieren Sie uns
          {/* Registrieren */}
        </Link>
      </div>
      {/* <img src={leftTop} alt="" className={styles.leftTop} />
      <img src={rightBottom} alt="" className={styles.rightBottom} /> */}
    </div>
  );
};

export default ContactUs;