import React from "react";

import styles from "./style.module.css";
import { Link } from "react-router-dom";

const Card = ({ title, img, text, link, linkText }) => {
  return (
    <div className={styles.card}>
      <div className={styles.cardImgContainer}>
        <img src={img} alt="" className={styles.cardImg} />
      </div>
      <div className={styles.cardBody}>
        <h4 className={styles.cardTitle}>{title}</h4>
        <p className={styles.cardText}>{text}</p>
        <Link className={styles.cardLink} to={link}>
          {linkText}
        </Link>
      </div>
    </div>
  );
};

export default Card;
