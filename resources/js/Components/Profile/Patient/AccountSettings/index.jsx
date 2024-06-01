import React from "react";
import PersonalInformation from "../PersonalInformationForm";

import styles from "./style.module.css";
import ChangePasswordForm from "../ChangePasswordForm";

const AccountSettings = ({auth}) => {
  return (
    <div className={styles.container}>
      <PersonalInformation auth={auth} />
      <ChangePasswordForm />
    </div>
  );
};

export default AccountSettings;
