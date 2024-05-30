import React from "react";
import styles from "./style.module.css";

const Certificates = () => {
  return (
    <div className={styles.container}>
      <h5 className={styles.title}>Certificates</h5>

      <div className={styles.certificaConatiner}>
        <div className={styles.certifica}>
          <h6 className={styles.certifier}>
            Ludwig Maximilian University of Münich
          </h6>
          <p className={styles.certificaName}>Spezialisierungsnachweis</p>
        </div>
        <div className={styles.certifica}>
          <h6 className={styles.certifier}>Free University of Berlin</h6>
          <p className={styles.certificaName}>Teilnahmebestätigung</p>
        </div>
      </div>
    </div>
  );
};

export default Certificates;
