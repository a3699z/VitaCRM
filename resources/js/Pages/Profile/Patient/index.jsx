import React, { useState } from "react";
import Navbar from "@/Components/Navbar";
import ProfileInfo from "@/Components/Profile/Patient/ProfileInfo";
import Menu from "@/Components/Profile/Patient/Menu";

import styles from "./style.module.css";
import Visits from "@/Components/Profile/Patient/Visits";
import AccountSettings from "@/Components/Profile/Patient/AccountSettings";
import { useNavigate, useParams } from "react-router-dom";
import VisitDetails from "@/Components/Profile/Patient/VisitDetails";



const Profile = ({auth, reservations}) => {
    const tabs = [
        {
          id: "profile",
          label: "Meine Termine",
          component: <Visits reservations={reservations} />,
        },
        {
          id: "accountSettings",
          label: "Account Einstellungen",
          component: <AccountSettings auth={auth} />,
        },
      ];
    console.log(reservations)
//   const navigate = useNavigate();
  const { visitId } = useParams();

  const [activeTab, setActiveTab] = useState("profile");

  const changeTab = (tab) => {
    // navigate("/profile");
    setActiveTab(tab);
  };

  return (
    <>

        <Navbar user={auth.user} />
        <div className={styles.container}>
            <ProfileInfo auth={auth} />
            <div className={`${styles.contentContainer} flex md:flex-row flex-col`}>
                <Menu tabs={tabs} activeTab={activeTab} changeTab={changeTab} />
                <div className={styles.content}>
                    {tabs.find((t) => t.id === activeTab).component}
                </div>
            </div>
        </div>
    </>
  );
};

export default Profile;
