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
value="",
error=""
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
        value={value}
      />
      {info && (
        <span className={styles.info}>Muss mindestens 8 Zeichen haben.</span>
      )}
        {error && <span className={styles.error}>{error}</span>}

    </div>

  );
};

export default FormGroup;
