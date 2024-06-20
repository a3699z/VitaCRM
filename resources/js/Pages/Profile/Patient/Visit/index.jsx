import React from "react";

import styles from "./style.module.css";

import profilePhoto from "@/Assets/Profile/visit/profile.png";
import calendarIcon from "@/Assets/Profile/visit/calendarIcon.svg";
import rightArrowIcon from "@/Assets/Profile/visit/rightArrowIcon.svg";
import NavBar from '@/Components/NavBar';
import { Head, Link, useForm } from '@inertiajs/react';
// import axios from 'axios';

// import { router } from '@inertiajs/react';

const VisitDetails = ({auth, reservation}) => {
    const { data, setData, post, processing, errors, reset } = useForm({
        key: reservation.key
    });

    const cancelReservation = (key) => {
        post(route('reservation.cancel'));
    };


  return (
    <>
        <NavBar user={auth.user} />
        <div className="min-h-screen bg-gray-100">
            <div className={styles.container}>
                <h4 className={styles.title}>Termindetails</h4>

                <div className={styles.visitContainer}>
                    <div className={styles.row}>
                    <div className={styles.doctorInfo}>
                        <img src={reservation.employee.profile_image ? '/images/'+reservation.employee.profile_image : profilePhoto} alt="" className={styles.profilePhoto} />
                        <div className={styles.info}>
                        <h5 className={styles.doctorName}>Spezialist,{reservation.employee.name}</h5>
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
                            <h5 className={styles.groupTitle}>

                            {/* April 29-2024 12:00, Montag */}
                            {new Date(reservation.date).toLocaleDateString('de-DE', { month: 'long', day: '2-digit' })}-{new Date(reservation.date).getFullYear()} {reservation.hour}, {new Date(reservation.date).toLocaleDateString('de-DE', { weekday: 'long' })}


                            </h5>
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
                        <Link className={styles.link}>
                        <img src={rightArrowIcon} className={styles.linkIcon} alt="" />
                        </Link>
                    </div>
                    </div>

                    {reservation.status === 'accepted' && reservation.call ?
                    <div className={styles.row}>
                        <div className={styles.groupContainer}>
                            <div className={styles.iconContainer}>
                            <img src={calendarIcon} alt="" />
                            </div>
                            <div className={styles.group}>
                                <h5 className={styles.groupTitle}>Starten Sie die Videosprechstunde</h5>
                            </div>
                        </div>
                        <div className={styles.btnGroup}>
                                <Link href={route('call', reservation.call.key)} className={styles.btn}>Starten</Link>
                        </div>
                    </div>
                    :
                    <></>
                    }

                    {/* cancel */}
                    <div className={styles.row}>
                        <div className={styles.groupContainer}>
                            <div className={styles.iconContainer}>
                                <img src={calendarIcon} alt="" />
                            </div>
                            <div className={styles.group}>
                                <h5 className={styles.groupTitle}>Do you need to cancel the Appointment?</h5>
                            </div>
                            <form className={styles.btnGroup} onSubmit={(e) => {e.preventDefault(); cancelReservation(reservation.key)}}>
                                <button className={styles.btn}>
                                    Stornieren
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </>
  );
};

export default VisitDetails;
