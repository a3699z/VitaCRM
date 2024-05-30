import React from "react";
import PersonalInformation from "../PersonalInformationForm";

import styles from "./style.module.css";
import ChangePasswordForm from "../ChangePasswordForm";

const AccountSettings = () => {
  return (
    <div className={styles.container}>
      <PersonalInformation />
      <ChangePasswordForm />
    </div>
  );
};

export default AccountSettings;
