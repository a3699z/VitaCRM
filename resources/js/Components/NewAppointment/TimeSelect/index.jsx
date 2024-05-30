import React from "react";
import styles from "./style.module.css";

const TimeSelect = ({hours}) => {
  return (
    <div className={styles.timeSelectContainer}>
      <h5 className={styles.dateTitle}>Verfügbare Stunden</h5>
      <div className={styles.timeSelect}>
        <div className={[styles.timeBox, styles.timeBoxSelected].join(" ")}>
          9:00
        </div>
        <div className={[styles.timeBox].join(" ")}>9:00</div>
        <div className={[styles.timeBox, styles.timeBoxDisabled].join(" ")}>
          9:00
        </div>
        <div className={[styles.timeBox].join(" ")}>9:00</div>
        <div className={[styles.timeBox].join(" ")}>9:00</div>
        <div className={[styles.timeBox].join(" ")}>9:00</div>
      </div>
    </div>
  );
};

export default TimeSelect;
