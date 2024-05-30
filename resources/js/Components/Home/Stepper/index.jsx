import React from "react";
import styles from "./style.module.css";

const Stepper = () => {
  return (
    <div className={styles.container}>
      <div className={styles.steps}>
        <div className={styles.stepContainer}>
          <div className={styles.stepIndicator}>
            <span className={styles.stepIndicatorNumber}>1</span>
          </div>
          <h5 className={styles.stepTitle}>Konto erstellen</h5>
          <p className={styles.stepDesc}>
            Beginnen Sie den Zugriff auf Gesundheitsdienste, indem Sie ein
            kostenloses Konto erstellen.
          </p>
        </div>
        <div className={styles.stepContainer}>
          <div className={styles.stepIndicator}>
            <span className={styles.stepIndicatorNumber}>2</span>
          </div>{" "}
          <h5 className={styles.stepTitle}>Spezialisten suchen und finden</h5>
          <p className={styles.stepDesc}>
            Wählen Sie in der Suchleiste den gewünschten Facharzt oder
            Gesundheitsdienst aus.
          </p>
        </div>
        <div className={styles.stepContainer}>
          <div className={styles.stepIndicator}>
            <span className={styles.stepIndicatorNumber}>3</span>
          </div>
          <h5 className={styles.stepTitle}>Termin wählen</h5>
          <p className={styles.stepDesc}>
            Planen Sie Ihren Termin, indem Sie ein passendes Datum und eine
            passende Uhrzeit auswählen.
          </p>
        </div>
        <div className={styles.stepContainer}>
          <div className={styles.stepIndicator}>
            <span className={styles.stepIndicatorNumber}>4</span>
          </div>
          <h5 className={styles.stepTitle}>Erinnerungen erhalten</h5>
          <p className={styles.stepDesc}>
            Vergessen Sie Ihren Termin nicht mit automatischen Erinnerungen.
          </p>
        </div>
      </div>
    </div>
  );
};

export default Stepper;
