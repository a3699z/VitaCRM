import React from "react";
import PersonalInformation from "../PersonalInformationForm";

import styles from "./style.module.css";
import ChangePasswordForm from "../ChangePasswordForm";
import EmployeeInformationForm from "../EmployeeInformationForm";

const AccountSettings = ({auth}) => {
  return (
    <div className={styles.container}>
      <PersonalInformation auth={auth} />
      <ChangePasswordForm />
        <EmployeeInformationForm auth={auth} />
    </div>
  );
};

export default AccountSettings;
