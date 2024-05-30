import React from "react";
import styles from "./style.module.css";

import hashtagIcon from "../../../Assets/NewAppointment/hashtagIcon.svg";

const tags = [
  {
    id: Math.random(),
    text: "Patientenpflege",
  },
  {
    id: Math.random(),
    text: "Medizinische Behandlung",
  },
  {
    id: Math.random(),
    text: "Rehabilitation",
  },
  {
    id: Math.random(),
    text: "Patientenschulung",
  },
  {
    id: Math.random(),
    text: "Physiotherapie",
  },
  {
    id: Math.random(),
    text: "Gesundheitsberatung",
  },
  {
    id: Math.random(),
    text: "Patientenüberwachung",
  },
  {
    id: Math.random(),
    text: "Patientenüberwachung",
  },
  {
    id: Math.random(),
    text: "Dokumentation",
  },
];

const Hashtag = () => {
  return (
    <div className={styles.tagContainer}>
      <h6 className={styles.tagsTitle}>Spezialisierungen</h6>
      <div className={styles.tags}>
        {tags.map((tag, i) => (
          <span key={tag.id}>
            <p className={styles.tag} key={tag.id}>
              <img src={hashtagIcon} alt="" />
              {tag.text}
            </p>
            {(i + 1) % 3 === 0 && <br />}
          </span>
        ))}
      </div>
    </div>
  );
};

export default Hashtag;
