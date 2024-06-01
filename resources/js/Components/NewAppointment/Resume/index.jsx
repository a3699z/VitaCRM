import React from "react";

import styles from "./style.module.css";
import { Link } from "@inertiajs/react";

const Resume = ({summary}) => {
  return (
    <div className={styles.container}>
      <h5 className={styles.title}>Resume</h5>
      <p className={styles.paragraph}>
        {summary}
        {/* Aliqua id fugiat nostrud irure ex duis ea quis id quis ad et. Sunt qui
        esse pariatur duis deserunt mollit dolore cillum minim tempor enim. Elit
        aute irure tempor cupidatat incididunt sint deserunt ut voluptate aute
        id deserunt nisi.Aliqua id fugiat nostrud irure ex duis ea quis id quis
        ad et. Sunt qui esse pariatur duis deserunt mollit dolore cillum
        minim... */}
      </p>
      {/* <Link className={styles.link}>Mehr lesen</Link> */}
    </div>
  );
};

export default Resume;
