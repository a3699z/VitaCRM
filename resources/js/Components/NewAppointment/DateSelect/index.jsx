import React from "react";

import styles from "./style.module.css";
import axios from "axios";

import rightArrowIcon from "../../../Assets/NewAppointment/rightArrowIcon.svg";
import leftArrowIcon from "../../../Assets/NewAppointment/leftArrowIcon.svg";

const DateSelect = ({dates}) => {
    // scroll
    const scroll = (direction) => {
        const container = document.querySelector(`.${styles.dateBoxContainer}`);
        const scrollAmount = 200;
        const scrollDirection = direction === "left" ? -scrollAmount : scrollAmount;
        container.scrollBy({
            top: 0,
            left: scrollDirection,
            behavior: "smooth",
        });
        // remove inactive class
        const scrollBtn = document.querySelector(`.${styles.scrollBtn}`);
        scrollBtn.classList.remove(styles.inactive);

        // add inactive class if scroll is at the end
        container.addEventListener("scroll", () => {
            if (container.scrollLeft === 0) {
                document.querySelector(`.${styles.scrollBtn}.left`).classList.add(styles.inactive);
            }
            if (container.scrollLeft === container.scrollWidth - container.clientWidth) {
                document.querySelector(`.${styles.scrollBtn}.right`).classList.add(styles.inactive);
            }
            // remove inactive class if scroll is not at the end
            if (container.scrollLeft !== container.scrollWidth - container.clientWidth) {
                document.querySelector(`.${styles.scrollBtn}.right`).classList.remove(styles.inactive);
            }


        });


    };


  return (
    <div className={styles.dateSelectContainer}>
      <h5 className={styles.dateTitle}>Datum wählen</h5>
      <div className={styles.dateSelect}>
        <button className={[styles.scrollBtn, styles.inactive].join(" ")} onClick={() => scroll("left")}>
          <img src={leftArrowIcon} alt="" />
        </button>
        <div className={styles.dateBoxContainer}>
            {dates.map((date, index) => {
                return (
                    <div className={styles.dateBox} key={index} onClick={() => getHours(date.date)}>
                        <h6 className={styles.dateBoxTitle}>{date.day}</h6>
                        <p className={styles.dateBoxDayInfo}>{date.weekday}</p>
                    </div>
                );
            })}
        </div>
        <button className={styles.scrollBtn} onClick={() => scroll("right")}>
          <img src={rightArrowIcon} alt="" />
        </button>
      </div>
    </div>
  );
};

export default DateSelect;
