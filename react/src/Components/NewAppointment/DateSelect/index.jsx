import React from "react";

import styles from "./style.module.css";

import rightArrowIcon from "../../../Assets/NewAppointment/rightArrowIcon.svg";
import leftArrowIcon from "../../../Assets/NewAppointment/leftArrowIcon.svg";

const DateSelect = () => {
  return (
    <div className={styles.dateSelectContainer}>
      <h5 className={styles.dateTitle}>Datum wählen</h5>
      <div className={styles.dateSelect}>
        <button className={[styles.scrollBtn, styles.inactive].join(" ")}>
          <img src={leftArrowIcon} alt="" />
        </button>
        <div className={styles.dateBoxContainer}>
          <div className={[styles.dateBox, styles.selectedDateBox].join(" ")}>
            <h6 className={styles.dateBoxTitle}>
              {/* {date.getDate()}
               */}
              5 Mai
            </h6>

            <p className={styles.dateBoxDayInfo}>
              {/* {deDays[date.getDay()]} */}
              Heute
            </p>
          </div>
          <div className={styles.dateBox}>
            <h6 className={styles.dateBoxTitle}>6 Mai</h6>
            <p className={styles.dateBoxDayInfo}>Morgen</p>
          </div>
          <div className={styles.dateBox}>
            <h6 className={styles.dateBoxTitle}>7 Mai</h6>
            <p className={styles.dateBoxDayInfo}>Mi</p>
          </div>
          <div className={styles.dateBox}>
            <h6 className={styles.dateBoxTitle}>8 Mai</h6>
            <p className={styles.dateBoxDayInfo}>Do</p>
          </div>
        </div>
        <button className={styles.scrollBtn}>
          <img src={rightArrowIcon} alt="" />
        </button>
      </div>
    </div>
  );
};

export default DateSelect;
