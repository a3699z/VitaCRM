import React from "react";
import { Link } from '@inertiajs/react';
import styles from "./style.module.css";
import { useState } from 'react';
import logo from "@/Assets/Logo.png";
import avatar from "@/Assets/Home/avatar.svg";
import menu from "@/Assets/Home/menu.svg";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink";
import Dropdown from '@/Components/Dropdown';

const Navbar = (user) => {
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);
  return (
    <nav className={styles.container}>
      <div className={styles.navbar}>
        <div className={styles.rightContainer}>
          <img src={logo} alt="logo" />

          <div className={styles.linkContainer}>
            <Link className={styles.link}>Was wir machen</Link>
            <Link className={styles.link}>Über uns</Link>
            <Link className={styles.link}>Kontakt</Link>
          </div>

        </div>

        <div className={styles.leftContainer}>
          <div className={styles.authContainer}>
          {user.user ? (
            <>
                <Link
                    href={route('dashboard')}
                    className={styles.profileBtn}
                >
                    Dashboard
                </Link>

                <nav className="bg-white border-b border-gray-100">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between h-16">

                        <div className="hidden sm:flex sm:items-center sm:ms-6">
                            <div className="ms-3 relative">
                                <Dropdown>
                                    <Dropdown.Trigger>
                                        <span className="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                className="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >

                                                <img src={menu} width={16} height={16} alt="" />
                                            </button>
                                        </span>
                                    </Dropdown.Trigger>

                                    <Dropdown.Content>
                                        <Dropdown.Link href={route('profile.index')}>Profile</Dropdown.Link>
                                        {/* reservations */}
                                        {/* <Dropdown.Link href={route('reservations.index')}>Reservations</Dropdown.Link> */}
                                        <Dropdown.Link href={route('logout')} method="post" as="button">
                                            Log Out
                                        </Dropdown.Link>
                                    </Dropdown.Content>
                                </Dropdown>
                            </div>
                        </div>

                        <div className="-me-2 flex items-center sm:hidden">
                            <button
                                onClick={() => setShowingNavigationDropdown((previousState) => !previousState)}
                                className="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg className="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        className={!showingNavigationDropdown ? 'inline-flex' : 'hidden'}
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        className={showingNavigationDropdown ? 'inline-flex' : 'hidden'}
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div className={(showingNavigationDropdown ? 'block' : 'hidden') + ' sm:hidden'}>
                    <div className="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink href={route('dashboard')} active={route().current('dashboard')}>
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <div className="pt-4 pb-1 border-t border-gray-200">
                        <div className="px-4">
                            <div className="font-medium text-base text-gray-800">{user.name}</div>
                            <div className="font-medium text-sm text-gray-500">{user.email}</div>
                        </div>

                        <div className="mt-3 space-y-1">
                            <ResponsiveNavLink href={route('profile.index')}>Profile</ResponsiveNavLink>
                            <ResponsiveNavLink method="post" href={route('logout')} as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>
            </>
            ) : (
                <>
                    <Link className={styles.registerLink} href="/register"> {/* to="/register" */}
                    Registrieren
                    </Link>
                    <Link className={styles.profileBtn} href="/login"> {/* to="/login" */}
                    <img src={avatar} alt="" />
                    Anmelden
                    </Link>
                </>

            )}

          </div>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
