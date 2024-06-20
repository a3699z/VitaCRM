import React from "react";
import styles from "./style.module.css";

import proilePhoto from "@/Assets/Profile/profileInfo/profile.png";

const ProfileInfo = ({auth}) => {
    const proilePhoto =auth.user.profile_image? 'images/' +auth.user.profile_image : 'images/profile.png';
  return (
    <div className={styles.container}>
      <div className={styles.content}>
        <div className={styles.profilePhotoContainer}>
          <img src={proilePhoto} className={styles.profilePhoto} alt="" />
        </div>
        <div className={styles.infoContainer}>
          <h6 className={styles.name}>{auth.user.username}</h6>
          <p className={styles.email}>{auth.user.email}</p>
        </div>
      </div>
    </div>
  );
};

export default ProfileInfo;
