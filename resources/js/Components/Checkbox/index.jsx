import React from "react";
import styles from "./style.module.css";

const Checkbox = ({ text }) => {
  return (
    <div className={styles.container}>
      <label
        htmlFor="a"
        style={{
          fontSize: "14px",
          fontWeight: 500,
          lineHeight: "20px",
          color: "rgba(52, 64, 84, 1)",
        }}
        className={styles.check_container}
      >
        <input type="checkbox" name="a" id="a" className={styles.input} />
        <span></span>
        <div
          onClick={(e) => {
            e.preventDefault();
          }}
        >
          {text}
          Ich habe die{" "}
          <span style={{ color: "rgba(212, 170, 44, 1)" }}>
            Nutzungsbedingungen
          </span>{" "}
          gelesen und bin mit ihnen einverstanden.
        </div>
      </label>
    </div>
  );
};

export default Checkbox;
