import React from "react";
import styles from "./style.module.css";

const Certificates = ({certificate_source, certificate}) => {
  return (
    <div className={styles.container}>
      <h5 className={styles.title}>Certificates</h5>

      <div className={styles.certificaConatiner}>
        <div className={styles.certifica}>
          <h6 className={styles.certifier}>
            {/* Ludwig Maximilian University of Münich */}
            {certificate_source}
          </h6>
          <p className={styles.certificaName}>
            {/* Spezialisierungsnachweis */}
            {certificate}
        </p>
        </div>
        {/* <div className={styles.certifica}>
          <h6 className={styles.certifier}>Free University of Berlin</h6>
          <p className={styles.certificaName}>Teilnahmebestätigung</p>
        </div> */}
      </div>
    </div>
  );
};

export default Certificates;
