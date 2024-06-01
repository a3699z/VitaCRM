import React from "react";
import styles from "./style.module.css";
import FormGroup from "../../../FormGroup";
import { useForm } from '@inertiajs/react';


const ChangePasswordForm = () => {

    const { data, setData, errors, put, reset, processing, recentlySuccessful } = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
    });

    const updatePassword = (e) => {
        e.preventDefault();
        put(route('password.update'));
    };

  const onChange = () => {};
  return (
    <div className={styles.container}>
      <div className={styles.titleContainer}>
        <h4 className={styles.title}>Passwort Andern</h4>
        <p className={styles.info}>
          Sie können Ihr Passwort in diesem Bereich aktualisieren und Ihre
          Mitgliedschaft fortsetzen.
        </p>
      </div>
      <div className={styles.formContainer}>
        <form onSubmit={(e) => updatePassword(e)}>
          <FormGroup
            id={"password"}
            name={"password"}
            label={"Passwort"}
            placeholder={"Altes Passwort"}
            onChange={ (e) => { setData('current_password', e.target.value) }}
            type="text"
          />
          <FormGroup
            id={"name"}
            name={"name"}
            label={"Neues Passwort"}
            placeholder={"Neues Passwort"}
            onChange={ (e) => { setData('password', e.target.value) }}
            type="text"
          />
          <FormGroup
            id={"email"}
            name={"email"}
            label={"Neues Passwort (Nochmals)"}
            placeholder={"Neues Passwort (Nochmals)"}
            onChange={ (e) => { setData('password_confirmation', e.target.value) }}
            type="mail"
          />
        </form>
        <button className={styles.submitBtn} type="submit" onClick={(e) => updatePassword(e)}>Passwort zurücksetzen</button>
      </div>
    </div>
  );
};

export default ChangePasswordForm;
