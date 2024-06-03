import React from "react";
import styles from "./style.module.css";
import FormGroup from "../../../FormGroup";

const ChangePasswordForm = () => {
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
        <form>
          {/* <FormGroup
            id={"password"}
            name={"password"}
            label={"Passwort"}
            placeholder={"Altes Passwort"}
            onChange={onChange}
            type="text"
          /> */}
          <div class={styles.formGroup}>
            <label for="password" class={styles.label}>
              Passwort
            </label>
            <input
              type="text"
              name="password"
              id="password"
              class={styles.input}
              placeholder="Altes Passwort"
              onChange={onChange}
            />
            </div>
          {/* <FormGroup
            id={"name"}
            name={"name"}
            label={"Neues Passwort"}
            placeholder={"Neues Passwort"}
            onChange={onChange}
            type="text"
          /> */}
          <div class={styles.formGroup}>
            <label for="name" class={styles.label}>
              Neues Passwort
            </label>
            <input
              type="text"
              name="name"
              id="name"
              class={styles.input}
              placeholder="Neues Passwort"
              onChange={onChange}
            />
            </div>

          {/* <FormGroup
            id={"email"}
            name={"email"}
            label={"Neues Passwort (Nochmals)"}
            placeholder={"Neues Passwort (Nochmals)"}
            onChange={onChange}
            type="mail"
          /> */}
            <div class={styles.formGroup}>
                <label for="email" class={styles.label}>
                Neues Passwort (Nochmals)
                </label>
                <input
                type="mail"
                name="email"
                id="email"
                class={styles.input}
                placeholder="Neues Passwort (Nochmals)"
                onChange={onChange}
                />
                </div>

        </form>
        <button className={styles.submitBtn}>Passwort zurücksetzen</button>
      </div>
    </div>
  );
};

export default ChangePasswordForm;
