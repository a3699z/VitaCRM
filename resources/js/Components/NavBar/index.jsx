import React, { useState } from "react";
import { Link } from "@inertiajs/react";
import logo from "@/Assets/Logo.png";
import avatar from "@/Assets/Home/avatar.svg";
import menu from "@/Assets/Home/menu.svg";

import Dropdown from "@/Components/Dropdown";

import profilePhoto from "@/Assets/Profile/profileInfo/profile.png";

import { IoMdClose } from "react-icons/io";
import styles from "./style.module.css";


const Navbar = ({ user }) => {
    const [showMobileMenu, setShowMobileMenu] = useState(false);

    const toggleMobileMenu = () => {
        setShowMobileMenu(!showMobileMenu);
    };

    return (
        <nav className="bg-white shadow-md py-4 md:px-8 px-6">
            <div className="flex justify-between items-center">
                <Link href="/">
                    <img src={logo} alt="logo" className="h-10" />
                </Link>
                <div className="hidden md:flex space-x-4 items-center">
                    {user ? (
                        <>
                            <Link
                                href={route("dashboard")}
                                className="btn-primary  rounded-md bg-[#c7982e] flex items-center justify-center px-4 py-2 gap-4 text-white font-semibold text-base"
                            >
                                Dashboard
                            </Link>
                            <Dropdown>
                                <Dropdown.Trigger>
                                    <div className="w-12 h-12 cursor-pointer">
                                        <img
                                            src={profilePhoto}
                                            className="rounded-full"
                                            alt="Profile"
                                        />
                                    </div>
                                </Dropdown.Trigger>
                                <Dropdown.Content>
                                    <Dropdown.Link
                                        href={route("profile.index")}
                                    >
                                        Profile
                                    </Dropdown.Link>
                                    <Dropdown.Link
                                        href={route("logout")}
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </Dropdown.Link>
                                </Dropdown.Content>
                            </Dropdown>
                        </>
                    ) : (
                        <>
                            <Link
                                className={styles.registerLink}
                                href="/register"
                            >
                                {" "}
                                {/* to="/register" */}
                                Registrieren
                            </Link>
                            <Link href="/login"  className="  rounded-md bg-[#c7982e] flex items-center justify-center px-4 py-2 gap-2 text-white font-semibold text-base">
                                {" "}
                                {/* to="/login" */}
                                <img src={avatar} alt="" />
                                Anmelden
                            </Link>
                   
                        </>
                    )}
                </div>
                <div
                    className="md:hidden cursor-pointer"
                    onClick={toggleMobileMenu}
                >
                    <img src={menu} alt="Menu" className="h-6" />
                </div>
            </div>

            {showMobileMenu && (
                <div className="md:hidden fixed inset-0 bg-black bg-opacity-90 flex flex-col items-center justify-center space-y-6 z-50">
                    <div className="absolute top-4 right-4">
                        {/* <img
                            src={menu}
                            alt="Close"
                            className="h-6 cursor-pointer"
                            onClick={toggleMobileMenu}
                        /> */}

                        <IoMdClose
                            className=" h-10 w-10 cursor-pointer   btn-primary   text-[#c7982e]  font-semibold "
                            onClick={toggleMobileMenu}
                        />
                    </div>
                    {user ? (
                        <>
                            <Link
                                href={route("dashboard")}
                                className={styles.profileBtn}
                                onClick={toggleMobileMenu}
                            >
                                Dashboard
                            </Link>
                            <Link
                                href={route("profile.index")}
                                className={styles.profileBtn}
                                onClick={toggleMobileMenu}
                            >
                                Profile
                            </Link>
                            <Link
                                href={route("logout")}
                                method="post"
                                as="button"
                                className={styles.profileBtn}
                                onClick={toggleMobileMenu}
                            >
                                Log Out
                            </Link>
                        </>
                    ) : (
                        <div className="flex flex-col gap-4">
                            <Link
                                href="/register"
                                className={styles.profileBtn}
                                onClick={toggleMobileMenu}
                            >
                                Registrieren
                            </Link>
                            <Link
                                href="/login"
                                className={styles.profileBtn}
                                onClick={toggleMobileMenu}
                            >
                                Anmelden
                            </Link>
                        </div>
                    )}
                </div>
            )}
        </nav>
    );
};

export default Navbar;