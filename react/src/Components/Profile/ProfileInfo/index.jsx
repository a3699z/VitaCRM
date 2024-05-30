import React from "react";
import styles from "./style.module.css";

import proilePhoto from "../../../Assets/Profile/profileInfo/profile.png";

const ProfileInfo = () => {
  return (
    <div className={styles.container}>
      <div className={styles.content}>
        <div className={styles.profilePhotoContainer}>
          <img src={proilePhoto} className={styles.profilePhoto} alt="" />
        </div>
        <div className={styles.infoContainer}>
          <h6 className={styles.name}>Rita Greiner</h6>
          <p className={styles.email}>ritagreiner@gmail.com</p>
        </div>
      </div>
    </div>
  );
};

export default ProfileInfo;
