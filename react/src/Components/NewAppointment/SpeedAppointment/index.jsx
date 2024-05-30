import React, { useState } from "react";
import styles from "./style.module.css";

import TimeSelect from "../TimeSelect";
import DateSelect from "../DateSelect";

const deDays = [
  "Sonntag",
  "Montag",
  "Dienstag",
  "Mittwoch",
  "Donnerstag",
  "Freitag",
  "Samstag",
];
const deToday = "Heute";
const deTomorrow = "Morgen";

const SpeedAppointment = () => {
  const [activeTab, setActiveTab] = useState("online");
  const date = new Date();
  console.log(date.getDate());

  return (
    <div className={styles.container}>
      <h6 className={styles.title}>Speed Termin</h6>

      <div
        className={styles.tabMenu}
        aria-valuenow={activeTab === "online" ? "0" : "1"}
      >
        <button
          className={[
            styles.tabBtn,
            activeTab == "online" && styles.active,
          ].join(" ")}
          onClick={() => setActiveTab("online")}
        >
          Videosprechstunde
        </button>
        <button
          className={[
            styles.tabBtn,
            activeTab == "onsite" && styles.active,
          ].join(" ")}
          onClick={() => setActiveTab("onsite")}
        >
          Vor-Ort-Termin
        </button>
      </div>

      <div className={styles.appointmentDateContainer}>
        <DateSelect />

        <div className={styles.divider}></div>

        <TimeSelect />

        <button className={styles.submitBtn}>Termin vereinbaren</button>
      </div>
    </div>
  );
};

export default SpeedAppointment;
