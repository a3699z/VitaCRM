import React from "react";
import styles from "./style.module.css";

const FormGroup = ({
  label,
  name,
  id,
  onChange,
  placeholder,
  type = "text",
  info,
}) => {
  return (
    <div className={styles.formGroup}>
      <label htmlFor={name} className={styles.label}>
        {label}
      </label>
      <input
        type={type}
        name={name}
        id={id}
        className={styles.input}
        placeholder={placeholder}
        onChange={onChange}
      />
      {info && (
        <span className={styles.info}>Muss mindestens 8 Zeichen haben.</span>
      )}
    </div>
  );
};

export default FormGroup;
