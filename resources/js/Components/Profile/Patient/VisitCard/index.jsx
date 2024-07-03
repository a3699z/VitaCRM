import React from "react";
import styles from "./style.module.css";

import profilePhoto from "@/Assets/Profile/visit/profile.png";
import videoIcon from "@/Assets/Profile/visit/videoIcon.svg";
import editIcon from "@/Assets/Profile/visit/editIcon.svg";
import calendarIcon from "@/Assets/Profile/visit/calendarIcon.svg";
import { Link } from '@inertiajs/react';

const VisitCard = ({
  visitType,
  doctorName,
  profession,
  date,
  time,
  visitId,
    profile_image="",
}) => {
  return (
    <div className={`${styles.container} w-full p-6 rounded-lg shadow  `}>
          <div className={`${styles.appointmentInfo} flex md:flex-row flex-col md:justify-between justify-start  `}>
    
        <div className={`${styles.doctorInfo} flex md:flex-row flex-col md:justify-between justify-start gap-4  `}>
          <img src={profile_image ? '/images/' +profile_image : profilePhoto} alt="" className={styles.profilePhoto} />
          <div className={styles.info}>
            <h4 className={styles.appointmentType}>
              <img src={videoIcon} alt="" />
              {visitType}
            </h4>
            <h5 className={styles.doctorName}>{doctorName}</h5>
            <h6 className={styles.profession}>{profession}</h6>
          </div>
        </div>
        <div className={styles.dateInfo}>
          <div className={styles.date}>{date}</div>
          <div className={styles.time}>{time}</div>
        </div>
      </div>
      <div className={styles.btnGroup}>
        <Link className={styles.btn} href={route('visit', visitId)}>
          <img src={calendarIcon} alt="" />
          Termindetails
        </Link>
        {/* <button className={styles.btn}>
          <img src={editIcon} alt="" />
          Einen Kommentar hizufügen
        </button> */}
      </div>
    </div>
  );
};

export default VisitCard;
