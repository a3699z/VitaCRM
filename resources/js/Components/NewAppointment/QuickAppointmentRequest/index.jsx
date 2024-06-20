import React, { useState } from "react";
import styles from "./style.module.css";


import { Head, Link, useForm } from '@inertiajs/react';



const QuickAppointmentRequest = ({employeeUID}) => {

    // const { data, setData, post, get, processing, errors, reset } = useForm({
    //     employeeUID: employeeUID,
    // });


    // const submit = () => {
    //     // console.log(data);
    //     post(route('reservation.quick_request'), data);
    // }



  return (
    <div className={styles.container}>
      <h6 className={styles.title}>Quick Appointment Request</h6>
        <Link href={route('reservation.quick', employeeUID)} className={styles.link}>Request an appointment</Link>

    </div>
  );
};

export default QuickAppointmentRequest;
