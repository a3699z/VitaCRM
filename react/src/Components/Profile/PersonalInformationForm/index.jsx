import React from "react";
import styles from "./style.module.css";
import FormGroup from "../../FormGroup";

const PersonalInformation = () => {
  const onChange = () => {};
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
          <FormGroup
            id={"userName"}
            name={"userName"}
            label={"Benutzername"}
            placeholder={"ritaaagreiner"}
            onChange={onChange}
            type="text"
          />
          <FormGroup
            id={"name"}
            name={"name"}
            label={"Name"}
            placeholder={"Rita Greiner"}
            onChange={onChange}
            type="text"
          />
          <FormGroup
            id={"email"}
            name={"email"}
            label={"E-mail"}
            placeholder={"ritagreiner@gmail.com"}
            onChange={onChange}
            type="mail"
          />
        </form>
        <div className={styles.btnGroup}>
          <button className={styles.cancelBtn}>ABBRECHEN</button>
          <button className={styles.saveBtn}>Speichern</button>
        </div>
      </div>
    </div>
  );
};

export default PersonalInformation;
// color: "#141417";
// fontSize: 18;
// fontFamily: "Manrope";
// fontWeight: "600";
// lineHeight: 64;
// wordWrap: "break-word";
