import { Link, Head, useForm } from '@inertiajs/react';
import TextInput from '@/Components/TextInput';
import axios from 'axios';
import NavBar from '@/Components/Navbar';

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
    // console.log(dates)
    const available_dates = employee.available_dates ? employee.available_dates : [];
    available_dates.length > 0 && available_dates.map((date, index) => {
        console.log(date.date);
        console.log(date.hours);
    });

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


            <div className={styles.container}>
                {/* <NavBar2 /> */}
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
                    <SpeedAppointment dates={dates} employeeUID={employee.uid} />
                    </div>
                </div>
                <Footer />
            </div>
            {/* <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"> */}
                {/* <div className="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">

                    <div className="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                        <div className="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                            <main className="mt-6">
                                <div className="grid gap-6 lg:grid-cols-2 lg:gap-8">
                                    <div className="space-y-6 lg:col-span-2">
                                        <h2 className="text-lg font-medium text-gray-900">Employee Information</h2>
                                        <p className="mt-1 text-sm text-gray-600">
                                            View information about the employee.
                                        </p>
                                    </div>
                                    <div className="space-y-6 lg:col-span-2">
                                        <h2 className="text-lg font-medium text-gray-900">Available Dates</h2>
                                        <p className="mt-1 text-sm text-gray-600">
                                            View available dates for the employee.
                                        </p>
                                    </div>
                                    {available_dates.length > 0 ? (

                                        <div className="space-y-6 lg:col-span-2">
                                            {available_dates.map((date, index) => (
                                                <div key={index} className="flex items-center space-x-4">
                                                    { date.date }
                                                    {date.hours && date.hours.length > 0 && date.hours.map((hour, hourIndex) => (
                                                        <Link key={hourIndex} href={route('reservation.check', { date: date.date, hour: hour, employee: employee.uid })}>
                                                            {hour}
                                                        </Link>
                                                    ))}
                                                </div>
                                            ))}
                                        </div>
                                    ) : (
                                        <div className="space-y-6 lg:col-span-2">
                                            <p className="text-sm text-gray-600">No available dates.</p>
                                        </div>
                                    )}

                                </div>
                            </main>
                            <footer className="py-16 text-center text-sm text-black dark:text-white/70">
                            </footer>
                        </div>
                    </div>
                </div> */}
            {/* </div> */}

        </>
    );
}
