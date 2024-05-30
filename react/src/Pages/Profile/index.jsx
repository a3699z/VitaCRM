import React, { useState } from "react";
import Navbar from "../../Components/Navbar";
import ProfileInfo from "../../Components/Profile/ProfileInfo";
import Menu from "../../Components/Profile/Menu";

import styles from "./style.module.css";
import Visits from "../../Components/Profile/Visits";
import AccountSettings from "../../Components/Profile/AccountSettings";
import { useNavigate, useParams } from "react-router-dom";
import VisitDetails from "../../Components/Profile/VisitDetails";

const tabs = [
  {
    id: "profile",
    label: "Meine Termine",
    component: <Visits />,
  },
  {
    id: "accountSettings",
    label: "Account Einstellungen",
    component: <AccountSettings />,
  },
];

const Profile = () => {
  const navigate = useNavigate();
  const { visitId } = useParams();

  const [activeTab, setActiveTab] = useState("profile");

  const changeTab = (tab) => {
    navigate("/profile");
    setActiveTab(tab);
  };

  return (
    <div className={styles.container}>
      <Navbar />
      <ProfileInfo />
      <div className={styles.contentContainer}>
        <Menu tabs={tabs} activeTab={activeTab} changeTab={changeTab} />
        <div className={styles.content}>
          {visitId ? (
            <VisitDetails />
          ) : (
            tabs.find((t) => t.id === activeTab).component
          )}
        </div>
      </div>
    </div>
  );
};

export default Profile;
