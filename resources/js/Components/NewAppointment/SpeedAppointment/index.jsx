import React, { useState } from "react";
import styles from "./style.module.css";

import TimeSelect from "../TimeSelect";
import DateSelect from "../DateSelect";
import axios from "axios";
import { useEffect } from "react";
import InputError from '@/Components/InputError';


import rightArrowIcon from "@/Assets/NewAppointment/rightArrowIcon.svg";
import leftArrowIcon from "@/Assets/NewAppointment/leftArrowIcon.svg";

import QuickAppointmentRequest from "@/Components/NewAppointment/QuickAppointmentRequest";


import { Head, Link, useForm } from '@inertiajs/react';


// const deDays = [
//   "Sonntag",
//   "Montag",
//   "Dienstag",
//   "Mittwoch",
//   "Donnerstag",
//   "Freitag",
//   "Samstag",
// ];
const deToday = "Heute";
const deTomorrow = "Morgen";

const SpeedAppointment = ({dates, employeeUID, quickDate, quickHour}) => {
    const [hours, setHours] = useState([]);
    const [activeTab, setActiveTab] = useState("online");


    const { data, setData, post, get, processing, errors, reset } = useForm({
        date: dates[0].date,
        hour: null,
        online: 1,
        employeeUID: employeeUID,
    });


    const selectDate = (date) => {
        axios.get('/reservation/get_hours?date='+date+'&employeeUID='+employeeUID, {
            date: date,
            employeeUID: employeeUID,
        }).then((response) => {
            setData("date", date);
            setHours(response.data.hours);
            const dateBoxes = document.querySelectorAll(`.${styles.dateBox}`);
            dateBoxes.forEach((dateBox) => {
                dateBox.classList.remove(styles.selectedDateBox);
            });
            const selectedDate = document.querySelector(`.${styles.dateBox}[data-date="${date}"]`);
            selectedDate.classList.add(styles.selectedDateBox);
        });
    }

    const setSelectedHour = (event) => {
        const hour = event.target.getAttribute("data-hour");
        setData("hour", hour);
        const timeBoxes = document.querySelectorAll(`.${styles.timeBox}`);
        timeBoxes.forEach((timeBox) => {
            timeBox.classList.remove(styles.timeBoxSelected);
        });
        event.target.classList.add(styles.timeBoxSelected);
    }

    const handleActivaTab = (tab) => {
        setActiveTab(tab);
        setData("online", tab === "online" ? 1 : 0);
    }

    useEffect(() => {
        selectDate(dates[0].date)
    }, []);

    const submit = () => {
        // console.log(data);
        post(route('reservation.check'));
    }

    const scroll = (direction) => {
        const container = document.querySelector(`.${styles.dateBoxContainer}`);
        const scrollAmount = 200;
        const scrollDirection = direction === "left" ? -scrollAmount : scrollAmount;
        container.scrollBy({
            top: 0,
            left: scrollDirection,
            behavior: "smooth",
        });
        const scrollBtn = document.querySelector(`.${styles.scrollBtn}`);
        scrollBtn.classList.remove(styles.inactive);
        container.addEventListener("scroll", () => {
            if (container.scrollLeft === 0) {
                document.querySelector(`.${styles.scrollBtn}.left`).classList.add(styles.inactive);
            }
            if (container.scrollLeft === container.scrollWidth - container.clientWidth) {
                document.querySelector(`.${styles.scrollBtn}.right`).classList.add(styles.inactive);
            }
            if (container.scrollLeft !== container.scrollWidth - container.clientWidth) {
                document.querySelector(`.${styles.scrollBtn}.right`).classList.remove(styles.inactive);
            }
        });
    };



  return (
    <div className={styles.container}>

<QuickAppointmentRequest employeeUID={employeeUID} quickDate={quickDate} quickHour={quickHour} />
      

      <div
        className={styles.tabMenu}
        aria-valuenow={activeTab === "online" ? "0" : "1"}
      >
        <button
          className={[
            styles.tabBtn,
            activeTab == "online" && styles.active,
          ].join(" ")}
          onClick={() => handleActivaTab("online")}
        >
          Videosprechstunde
        </button>
        <button
          className={[
            styles.tabBtn,
            activeTab == "onsite" && styles.active,
          ].join(" ")}
          onClick={() => handleActivaTab("onsite")}
        >
          Vor-Ort-Termin
        </button>
      </div>

      <div className={styles.appointmentDateContainer}>


          {/* dates */}
        <div className={styles.dateSelectContainer}>
            <h5 className={styles.dateTitle}>Datum wählen</h5>
            <div className={styles.dateSelect}>
                <button className={[styles.scrollBtn, styles.inactive].join(" ")} onClick={() => scroll("left")}>
                <img src={leftArrowIcon} alt="" />
                </button>
                <div className={styles.dateBoxContainer}>
                    {dates.map((date, index) => {
                        return (
                            <div className={styles.dateBox} key={index} onClick={() => selectDate(date.date)} data-date={date.date}>
                                <h6 className={   styles.dateBoxTitle   }>{date.day}</h6>
                                <p className={styles.dateBoxDayInfo}>{date.weekday}</p>
                            </div>
                        );
                    })}
                </div>
                <button className={styles.scrollBtn} onClick={() => scroll("right")}>
                <img src={rightArrowIcon} alt="" />
                </button>
            </div>
            <InputError message={errors.date} />
        </div>



        <div className={styles.divider}></div>

        {/* hours */}

        <div className={styles.timeSelectContainer}>
            <h5 className={styles.dateTitle}>Verfügbare Stunden</h5>
            <div className={`${styles.timeSelect} grid md:grid-cols-3 grid-cols-2 gap-2  `}>
                {/* <div className={[styles.timeBox, styles.timeBoxSelected].join(" ")}>
                9:00
                </div>
                <div className={[styles.timeBox].join(" ")}>9:00</div>
                <div className={[styles.timeBox, styles.timeBoxDisabled].join(" ")}>
                9:00
                </div>
                <div className={[styles.timeBox].join(" ")}>9:00</div>
                <div className={[styles.timeBox].join(" ")}>9:00</div>
                <div className={[styles.timeBox].join(" ")}>9:00</div> */}
                {hours.map((hour, index) => {
                    return (
                        <div className={[styles.timeBox].join(" ")} key={index} onClick={() => setSelectedHour(event)} data-hour={hour}>
                            {hour}
                        </div>
                    );
                })}
            </div>
            <InputError message={errors.hour} />
        </div>

        <button className={styles.submitBtn} onClick={() => submit()}>Termin vereinbaren</button>
      </div>

    </div>

  );
};

export default SpeedAppointment;
