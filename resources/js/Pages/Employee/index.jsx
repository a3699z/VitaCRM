import { Link, Head, useForm } from "@inertiajs/react";
import TextInput from "@/Components/TextInput";
import axios from "axios";
import NavBar from "@/Components/Navbar";

import NavBar2 from "@/Components/NavBar2";
import Hashtag from "@/Components/NewAppointment/Hashtags";
import SpeedAppointment from "@/Components/NewAppointment/SpeedAppointment";
import Footer from "@/Components/Footer";
import Resume from "@/Components/NewAppointment/Resume";
import Education from "@/Components/NewAppointment/Education";
import Certificates from "@/Components/NewAppointment/Certificates";
import Specializations from "@/Components/NewAppointment/Specializations";

import styles from "./style.module.css";
import profileImg from "@/Assets/NewAppointment/profile.png";
import PatientReviews from "@/Components/NewAppointment/PatientReviews";

export default function Employee({ auth, employee, dates }) {
    console.log(employee);
    // makeReservation
    // const checkReservation = (date, hour) => {
    //     // console.log(date,hour)
    //     axios.get('/reservation/check/', {
    //         date,
    //         hour
    //     }).then((response) => {
    //         console.log(response);
    //     });
    // }

    return (
        <>
            <NavBar user={auth.user} />
            <Head title="Welcome" />

            <div className={`${styles.container} `}>
                {/* <NavBar2 /> */}
                <div className={`${styles.content} flex flex-col md:flex-row `}>
                    <div className={`${styles.left}  `}>
                        <div
                            className={`${styles.imgContainer} max-w-[800px] `}
                        >
                            <img
                                src={
                                    employee.profile_image
                                        ? "/images/" + employee.profile_image
                                        : profileImg
                                }
                                alt=""
                                className={styles.profileImg}
                            />
                        </div>

                        {/* <div className={styles.doctorInfoContainer}>
                            <Resume summary={employee.summary?employee.summary:''} />

                            <Education university={employee.university?employee.university:''} department={employee.department?employee.department:''} />

                            <Certificates cerfiticate_source={employee.certificate_source?employee.certificate_source:''} certificate={employee.certificate?employee.certificate:''} />

                            <Specializations tags={employee.specializations?employee.specializations:[]} />

                            <PatientReviews />
                        </div> */}
                    </div>

                    <div className={`${styles.right}  sm:mt-4 lg:mt-0`}>
                        <div>
                            <h5 className={`${styles.doctorName}`}>
                               {employee.username} {employee.name}
                            </h5>
                            {employee.profession ? (
                                <p className={styles.doctorProfession}>
                                    {employee.profession}
                                </p>
                            ) : (
                                ""
                            )}
                        </div>

                        <div >
                            <Hashtag
                                tags={
                                    employee.specializations
                                        ? employee.specializations
                                        : []
                                }
                            />
                            <SpeedAppointment dates={dates} employeeUID={employee.uid} quickDate={employee.quick_date} quickHour={employee.quick_hour} />
                        </div>
                    </div>
                </div>
                <Footer />
            </div>
        </>
    );
}
