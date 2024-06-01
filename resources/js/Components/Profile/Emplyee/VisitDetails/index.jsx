import React from "react";
import { Link } from "react-router-dom";

import styles from "./style.module.css";

import profilePhoto from "@/Assets/Profile/visit/profile.png";
import calendarIcon from "@/Assets/Profile/visit/calendarIcon.svg";
import rightArrowIcon from "@/Assets/Profile/visit/rightArrowIcon.svg";

const VisitDetails = () => {
  return (
    <div className={styles.container}>
      <h4 className={styles.title}>Termindetails</h4>

      <div className={styles.visitContainer}>
        <div className={styles.row}>
          <div className={styles.doctorInfo}>
            <img src={profilePhoto} alt="" className={styles.profilePhoto} />
            <div className={styles.info}>
              <h5 className={styles.doctorName}>Spezialist,Leslie Alexander</h5>
              <h6 className={styles.profession}>Krankenpfleger</h6>
            </div>
          </div>
        </div>

        <div className={styles.row}>
          <div className={styles.groupContainer}>
            <div className={styles.iconContainer}>
              <img src={calendarIcon} alt="" />
            </div>
            <div className={styles.group}>
              <h5 className={styles.groupTitle}>April 29-2024 12:00, Montag</h5>
            </div>
          </div>
        </div>

        <div className={styles.row}>
          <div className={styles.groupContainer}>
            <div className={styles.iconContainer}>
              <img src={calendarIcon} alt="" />
            </div>
            <div className={styles.group}>
              <h5 className={styles.groupTitle}>Videosprechstunde Termin</h5>
              <p className={styles.groupDesc}>60 min</p>
            </div>
          </div>
        </div>

        <div className={styles.row}>
          <div className={styles.groupContainer}>
            <div className={styles.iconContainer}>
              <img src={calendarIcon} alt="" />
            </div>
            <div className={styles.group}>
              <h5 className={styles.groupTitle}>Behandelte Gruppe</h5>
              <p className={styles.groupDesc}>NEIN</p>
            </div>
          </div>
        </div>

        <div className={styles.row}>
          <div className={styles.groupContainer}>
            <div className={styles.iconContainer}>
              <img src={calendarIcon} alt="" />
            </div>
            <div className={styles.group}>
              <h5 className={styles.groupTitle}>
                Wie bereitet man sich auf ein Online-Interview vor?
              </h5>
            </div>
            <Link to={"/"} className={styles.link}>
              <img src={rightArrowIcon} className={styles.linkIcon} alt="" />
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
};

export default VisitDetails;
