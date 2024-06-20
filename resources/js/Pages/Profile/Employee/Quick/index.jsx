import React from "react";
import { Link } from '@inertiajs/react';

import styles from "./style.module.css";

import profilePhoto from "@/Assets/Profile/visit/profile.png";
import calendarIcon from "@/Assets/Profile/visit/calendarIcon.svg";
import rightArrowIcon from "@/Assets/Profile/visit/rightArrowIcon.svg";

import NavBar from '@/Components/NavBar';
import SelectQuickDate from '@/Components/Profile/Emplyee/SelectQuickDate';


const QuickDetails = ({auth, reservation, dates}) => {
  return (
    <>
        <NavBar user={auth.user} />
        <div className="min-h-screen bg-gray-100">
            <div className={styles.container}>
                <h4 className={styles.title}>Termindetails</h4>

                <div className={styles.visitContainer}>
                    <div className={styles.row}>
                    <div className={styles.doctorInfo}>
                        <img src={reservation.patient.profile_image ? '/images/'+reservation.patient.profile_image : profilePhoto} alt="" className={styles.profilePhoto} />
                        <div className={styles.info}>
                            <h5 className={styles.doctorName}>Patient,{reservation.patient.name}</h5>
                        </div>
                    </div>
                    </div>
                    <div className={styles.row}>
                        <SelectQuickDate dates={dates} reservation={reservation} auth={auth} />
                    </div>
                </div>
            </div>
        </div>
    </>
  );
};

export default QuickDetails;
