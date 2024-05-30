import React from "react";
import styles from "./style.module.css";

function Education() {
  return (
    <div className={styles.container}>
      <h5 className={styles.title}>Education</h5>
      <div className={styles.schoolContainer}>
        <h6 className={styles.schoolName}>
          Ludwig Maximilian University of Münich
        </h6>
        <p className={styles.schoolDepartment}>
          Physiotherapie und Rehabilitation Abteilung
        </p>
      </div>
      <div className={styles.schoolContainer}>
        <h6 className={styles.schoolName}>Free University of Berlin</h6>
        <p className={styles.schoolDepartment}>Physiotherapie Abteilung</p>
      </div>
    </div>
  );
}

export default Education;
