import React, { useState, useEffect } from "react";
import styles from "./style.module.css";
import QuickCard from "../QuickCard";
import axios from "axios";


const Quicks = ({}) => {
  const [quicks, setQuicks] = useState();

    useEffect(() => {
        axios.get('/quick_reservations').then((res) => {
            console.log(res);
            setQuicks(res.data);
        });
    }, []);



  return (
    <div className={styles.container}>
      <h5 className={styles.title}>Abgeschlossene Besuche</h5>
      <div className={styles.visitContainer}>
        {quicks &&
            quicks.map((quick) => (
            <QuickCard
                patientName={quick.patient_name}
                quickId={quick.key}
                profile_image={quick.profile_image}
            />
            ))}
      </div>
    </div>
  );
};

export default Quicks;
