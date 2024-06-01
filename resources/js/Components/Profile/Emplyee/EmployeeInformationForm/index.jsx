import React from "react";
import styles from "./style.module.css";
import FormGroup from "../../../FormGroup";
import { useForm } from '@inertiajs/react';
import { useState, useEffect } from 'react';


const EmployeeInformationForm = ({auth, flash}) => {




  const { data, setData, errors, post, reset, processing, recentlySuccessful } = useForm({
    summary: auth.user.summary ? auth.user.summary : '',
    university: auth.user.university ? auth.user.university : '',
    department: auth.user.department ? auth.user.department : '',
    certificate_source: auth.user.certificate_source ? auth.user.certificate_source : '',
    certificate: auth.user.certificate ? auth.user.certificate : '',
    specializations: auth.user.specializations ? auth.user.specializations : '',
    profession: auth.user.profession ? auth.user.profession : '',
    });

  const onChange = () => {};

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('profile.update_employee'));
    }

  return (
    <div className={styles.container}>
      <div className={styles.titleContainer}>
        <h4 className={styles.title}>Persönliche Daten</h4>
        <p className={styles.info}>
          Hier können Sie Ihre persönlichen Daten aktualisieren.
        </p>
      </div>
      <div className={styles.formContainer}>
        <form>



            <div className={styles.formGroup}>
                <label className={styles.label}>Zusammenfassung</label>
                <textarea
                    className={styles.textArea}
                    name="summary"
                    value={auth.user.summary ? auth.user.summary : ''}
                    onChange={(e) => setData('summary', e.target.value)}
                ></textarea>
            </div>

            <div className={styles.formGroup}>
                <label className={styles.label}>Universität</label>
                <input
                    type="text"
                    name="university"
                    className={styles.input}
                    value={auth.user.university ? auth.user.university : ''}
                    onChange={(e) => setData('university', e.target.value)}
                />
            </div>

            <div className={styles.formGroup}>
                <label className={styles.label}>Fachbereich</label>
                <input
                    type="text"
                    name="department"
                    className={styles.input}
                    value={auth.user.department ? auth.user.department : ''}
                    onChange={(e) => setData('department', e.target.value)}
                />
            </div>

            <div className={styles.formGroup}>
                <label className={styles.label}>Zertifikat Universität</label>
                <input
                    type="text"
                    name="certificate_source"
                    className={styles.input}
                    value={auth.user.certificate_source ? auth.user.certificate_source : ''}
                    onChange={(e) => setData('certificate_source', e.target.value)}
                />
            </div>

            <div className={styles.formGroup}>
                <label className={styles.label}>Zertifikat</label>
                <input
                    type="text"
                    name="certificate"
                    className={styles.input}
                    value={auth.user.certificate ? auth.user.certificate : ''}
                    onChange={(e) => setData('certificate', e.target.value)}
                />
            </div>

            <div className={styles.formGroup}>
                <label className={styles.label}>Beruf</label>
                <input
                    type="text"
                    name="profession"
                    className={styles.input}
                    value={auth.user.profession ? auth.user.profession : ''}
                    onChange={(e) => setData('profession', e.target.value)}
                />
            </div>



            <div className={styles.formGroup}>
                <label className={styles.label}>Spezialisierung</label>
                <textarea
                    className={styles.textArea}
                    name="specializations"
                    value={auth.user.specializations ? auth.user.specializations : ''}
                    onChange={(e) => setData('specializations', e.target.value)}
                ></textarea>

                <span className={styles.info}>Write your specializations separated by comma ','</span>
            </div>

        </form>
        <div className={styles.btnGroup}>
          {/* <button className={styles.cancelBtn}>ABBRECHEN</button> */}
          <button className={styles.saveBtn}  onClick={(e) => {handleSubmit(e)}}>Speichern</button>
        </div>
      </div>
    </div>
  );
};

export default EmployeeInformationForm;
// color: "#141417";
// fontSize: 18;
// fontFamily: "Manrope";
// fontWeight: "600";
// lineHeight: 64;
// wordWrap: "break-word";
