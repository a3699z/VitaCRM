import React from "react";
import Rewiev from "../Review";
import styles from "./style.module.css";

const PatientReviews = () => {
  return (
    <div className={styles.container}>
      <h5 className={styles.title}>32 Bewertungen</h5>
      <div className={styles.reviewsContainer}>
        <Rewiev />
        <Rewiev />
      </div>
    </div>
  );
};

export default PatientReviews;
