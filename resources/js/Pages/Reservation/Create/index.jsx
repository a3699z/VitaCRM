import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import { useState, useEffect } from 'react';
import axios from 'axios';
import Navbar from '@/Components/Navbar';
import styles from './style.module.css';

import FormGroup from '@/Components/FormGroup';


import profilePhoto from "@/Assets/Profile/visit/profile.png";

import videoIcon from "@/Assets/Profile/visit/videoIcon.svg";
import editIcon from "@/Assets/Profile/visit/editIcon.svg";
import calendarIcon from "@/Assets/Profile/visit/calendarIcon.svg";

export default function Create({ auth, employee, date, hour, is_online }) {

    const { data, setData, post, processing, errors, reset } = useForm({
        insurance_type: 'legal',
        insurance_policy_number: '',
        employee_uid: employee.uid,
        date: date,
        hour: hour,
        is_online: is_online
    });
    const submit = (e) => {
        e.preventDefault();
        post(route('reservation.store'));
    }
    return (

        <>
            <Navbar user={auth.user} />
            <div className="min-h-screen bg-gray-100">
                <Head title="Dashboard" />
                <div>
                    {employee.name}
                    {date}
                    {hour}
                    {is_online ? 'Online' : 'Offline'}
                </div>
                <div className={styles.visitContainer}>

                    <div className={styles.container}>
                        <div className={styles.appointmentInfo}>
                            <div className={styles.doctorInfo}>
                            <img src={profilePhoto} alt="" className={styles.profilePhoto} />
                            <div className={styles.info}>
                                <h4 className={styles.appointmentType}>
                                    <img src={videoIcon} alt="" />
                                    Videosprechstunde Termin
                                </h4>
                                <h5 className={styles.doctorName}>{employee.name}</h5>
                                <h6 className={styles.profession}>Krankenpfleger</h6>
                            </div>
                            </div>
                            <div className={styles.dateInfo}>
                            <div className={styles.date}>{date}</div>
                            <div className={styles.time}>{hour}</div>
                            </div>
                        </div>
                    </div>
                </div>
                    {/* <div>
                        <label htmlFor="insurance_type">Insurance Type</label>
                        <select name="insurance_type" id="insurance_type" onChange={(e) => setData('insurance_type', e.target.value)}>
                            <option value="legal">Legal Insurance</option>
                            <option value="private">Private Insurance</option>
                        </select>
                    </div>
                    <div>
                        <label htmlFor="insurance_policy_number">Insurance Policy Number</label>

                        <FormGroup
                            id={"insurance_policy_number"}
                            name={"insurance_policy_number"}
                            label={"Insurance Policy Number"}
                            placeholder={"123456789"}
                            onChange={(e) => setData('insurance_policy_number', e.target.value)}
                            type="text"
                        />
                    </div> */}

                    {/* <div className={styles.btnGroup}>
                        <button className={styles.saveBtn}>Speichern</button>
                    </div> */}
                    <div className={styles.container}>
                        <div className={styles.titleContainer}>
                            <h4 className={styles.title}>Versicherungsinformationen</h4>
                            <p className={styles.info}>
                                Put Insurance Policy Number
                            </p>
                        </div>
                        <div className={styles.formContainer}>
                            <form>
                                {/* select input for input type */}

                                <div className={styles.formGroup}>
                                    <label htmlFor="insurance_type" className={styles.label}>
                                        Insurance Type
                                    </label>
                                    <select name="insurance_type" id="insurance_type" onChange={(e) => setData('insurance_type', e.target.value)} className={styles.selectInput}>
                                        <option value="legal">Legal Insurance</option>
                                        <option value="private">Private Insurance</option>
                                    </select>
                                </div>
                                <FormGroup
                                    id={"insurance_policy_number"}
                                    name={"insurance_policy_number"}
                                    label={"Insurance Policy Number"}
                                    placeholder={"123456789"}
                                    onChange={(e) => setData('insurance_policy_number', e.target.value)}
                                    type="text"
                                />
                            </form>
                            <div className={styles.btnGroup}>
                                {/* <button className={styles.cancelBtn}>ABBRECHEN</button> */}
                                <button className={styles.saveBtn} onClick={(e) => submit(e) }>Speichern</button>
                            </div>
                        </div>
                        </div>
            </div>
        </>
        );
}
