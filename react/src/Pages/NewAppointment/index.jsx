import React from "react";
import Navbar from "../../Components/Navbar";
import Hashtag from "../../Components/NewAppointment/Hashtags";
import SpeedAppointment from "../../Components/NewAppointment/SpeedAppointment";
import Footer from "../../Components/Footer";
import Resume from "../../Components/NewAppointment/Resume";
import Education from "../../Components/NewAppointment/Education";
import Certificates from "../../Components/NewAppointment/Certificates";
import Specializations from "../../Components/NewAppointment/Specializations";

import styles from "./style.module.css";
import profileImg from "../../Assets/NewAppointment/profile.png";
import PatientReviews from "../../Components/NewAppointment/PatientReviews";

const NewAppointment = () => {
  return (
    <div className={styles.container}>
      <Navbar />
      <div className={styles.content}>
        <div className={styles.left}>
          <div className={styles.imgContainer}>
            <img src={profileImg} alt="" className={styles.profileImg} />
          </div>

          <div className={styles.doctorInfoContainer}>
            <Resume />

            <Education />

            <Certificates />

            <Specializations />

            <PatientReviews />
          </div>
        </div>

        <div className={styles.right}>
          <div>
            <h5 className={styles.doctorName}>Spezialist, Leslie Alexander</h5>
            <p className={styles.doctorProfession}>Krankenpfleger</p>
          </div>

          <Hashtag />
          <SpeedAppointment />
        </div>
      </div>
      <Footer />
    </div>
  );
};

export default NewAppointment;
