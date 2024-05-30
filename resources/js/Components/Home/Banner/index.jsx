import React from "react";

import styles from "./style.module.css";
import bannerImg from "../../../Assets/Home/banner/bannerImg.png";
import videoIcon from "../../../Assets/Home/banner/video-square.svg";
import buildingsIcon from "../../../Assets/Home/banner/buildings-alt.svg";
// import arrowDownIcon from "../../../Assets/Home/banner/arrowDown.svg";
import SelectBox from "../../SelectBox";

const Banner = (employees) => {
  return (
    <div className={styles.container}>
      <div className={styles.rightSide}>
        <h3 className={styles.title}>ARZT FINDEN LEICHT</h3>
        <h2 className={styles.bigTitle}>
          Ihrem Partner für maßgeschneiderte Beratungsbesuche
        </h2>

        <p className={styles.desc}>
          Gesundheit ist eines der wichtigsten Dinge für uns, da für sofort
          überprüfen Sie Ihre Gesundheit für Sie
        </p>

        <div className={styles.btnGroup}>
          <button className={styles.videoBtn}>
            <img src={videoIcon} alt="" />
            Videosprechstunde
          </button>
          <button className={styles.onSiteBtn}>
            <img src={buildingsIcon} alt="" />
            Vor-Ort-Termin
          </button>
        </div>

        <SelectBox employees={employees} />
      </div>
      <div className={styles.leftSide}>
        <img src={bannerImg} alt="" className={styles.bannerImg} />
      </div>
    </div>
  );
};

export default Banner;
