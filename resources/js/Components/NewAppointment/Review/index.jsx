import React from "react";
import styles from "./style.module.css";

import patientProfile from "@/Assets/NewAppointment/patientProfile.png";
import starIcon from "@/Assets/NewAppointment/startIcon.svg";
import doctorProfile from "@/Assets/NewAppointment/doctorProfile.png";

const Rewiev = () => {
  return (
    <div className={styles.review}>
      <div className={styles.reviewContainer}>
        <img src={patientProfile} alt="" className={styles.profileImg} />
        <div className={styles.reviewInfoContainer}>
          <div className={styles.patientContainer}>
            <h6 className={styles.reviewerName}>Guy Hawkins</h6>
            <p className={styles.reviewDate}>18 Dez, 2023</p>
            <img src={starIcon} alt="" className={styles.starIcon} />
            <p className={styles.reviewScore}>4,5</p>
          </div>
          <div className={styles.comment}>
            Aliqua id fugiat nostrud irure ex duis ea quis id quis ad et. Sunt
            qui esse pariatur duis deserunt mollit dolore cillum minim tempor
            enim.
          </div>
        </div>
      </div>

      <div className={styles.replyContainer}>
        <img src={doctorProfile} className={styles.profileImg} alt="" />
        <div className={styles.reply}>
          <div className={styles.doctorInfoContainer}>
            <h6 className={styles.doctorName}>Spezialist, Leslie Alexander</h6>
            <p className={styles.doctorProfession}>Krankenpfleger</p>
          </div>
          <div className={styles.replyText}>
            Aliqua id fugiat nostrud irure ex duis ea quis id quis ad et. Sunt
            qui esse pariatur duis deserunt mollit dolore cillum minim tempor
            enim.
          </div>
        </div>
      </div>
    </div>
  );
};

export default Rewiev;
