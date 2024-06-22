import React, { useState } from "react";
import styles from "./style.module.css";


import { Head, Link, useForm } from '@inertiajs/react';



const QuickAppointmentRequest = ({employeeUID}) => {

    const { data, setData, post, get, processing, errors, reset } = useForm({
        employeeUID: employeeUID,
    });


    const submit = () => {
        // console.log(data);
        post(route('reservation.quick'), data);
    }



  return (
    <div className={styles.quickContainer}>
      <h6 className={styles.title}>Quick Appointment Request</h6>
        <form className={styles.form} onSubmit={e => { e.preventDefault(); submit(); }}>
            <button type="submit" className={styles.submitBtnQuick}>Quick Appointment</button>
        </form>

    </div>
  );
};

export default QuickAppointmentRequest;
