import React from "react";

import styles from "./style.module.css";

import logo from "../../Assets/Logo.png";
import pinIcon from "../../Assets/Footer/pinIcon.png";
import phoneIcon from "../../Assets/Footer/phoneIcon.png";
import mailIcon from "../../Assets/Footer/mailIcon.png";

import galleryPhoto1 from "../../Assets/Footer/gallery/1.png";
import galleryPhoto2 from "../../Assets/Footer/gallery/2.png";
import galleryPhoto3 from "../../Assets/Footer/gallery/3.png";
import galleryPhoto4 from "../../Assets/Footer/gallery/4.png";
import galleryPhoto5 from "../../Assets/Footer/gallery/5.png";
import galleryPhoto6 from "../../Assets/Footer/gallery/6.png";

import instagramIcon from "../../Assets/Footer/instagram.png";
import facebookIcon from "../../Assets/Footer/facebook.png";
import youtubeIcon from "../../Assets/Footer/youtube.png";
import { Link } from "react-router-dom";

const contactList = [
  {
    id: Math.random(),
    img: pinIcon,
    title: "Address:",
    paragraph: "Leithestraße 39 45886 Gelsenkirchen",
  },
  {
    id: Math.random(),
    img: phoneIcon,
    title: "Phone:",
    paragraph: "1209 95907815 - 0209 95907816",
  },
  {
    id: Math.random(),
    img: mailIcon,
    title: "Mail:",
    paragraph: "info@vip-vitalisten.de",
  },
];

const Footer = () => {
  return (
    <div className={styles.container}>
      <div className={styles.footer}>
        <div className={styles.col}>
          <div>
            <img src={logo} alt="" className={styles.logo} />
          </div>
          <p className={styles.paragraph}>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit
            amet turpis venenatis nulla dignissim scelerisque. Ut volutpat
            maximus ligula.Lorem ipsum dolor sit amet, consectetur adipiscing
            elit.
          </p>
        </div>
        <div className={styles.col}>
          <h5 className={styles.title}>KONTAKT</h5>
          <div className={styles.list}>
            {contactList.map((item) => (
              <div className={styles.listItem} key={item.id}>
                <img src={item.img} alt="" className={styles.listIcon} />
                <h6 className={styles.listTitle}>{item.title}</h6>
                <p className={styles.listParagraph}>{item.paragraph}</p>
              </div>
            ))}
          </div>
        </div>
        <div className={styles.col}>
          <h5 className={styles.title}>UNSERE DIENSTLEISTUNGEN</h5>
          <ul className={styles.servicesList}>
            <li className={styles.servicesListItem}>Was wir machen</li>
            <li className={styles.servicesListItem}>Mitarbeit</li>
            <li className={styles.servicesListItem}>Klientenportal</li>
            <li className={styles.servicesListItem}>Über uns</li>
            <li className={styles.servicesListItem}>Kontakt</li>
          </ul>
        </div>
        <div className={styles.col}>
          <h5 className={styles.title}>SOCIAL MEDIA GALERIE</h5>
          <div className={styles.gallery}>
            <img src={galleryPhoto1} alt="" className={styles.galleryPhoto} />
            <img src={galleryPhoto2} alt="" className={styles.galleryPhoto} />
            <img src={galleryPhoto3} alt="" className={styles.galleryPhoto} />
            <img src={galleryPhoto4} alt="" className={styles.galleryPhoto} />
            <img src={galleryPhoto5} alt="" className={styles.galleryPhoto} />
            <img src={galleryPhoto6} alt="" className={styles.galleryPhoto} />
          </div>
        </div>
      </div>
      <div className={styles.copyright}>
        <p className={styles.copyText}>
          © 2016 - 2024 VIP GmbH. All Rights Reserved.
        </p>
        <div className={styles.socialMedia}>
          <p className={styles.copyText}>Folgen Sie uns:</p>
          <div className={styles.iconContainer}>
            <Link className={styles.socialLink}>
              <img src={instagramIcon} alt="" className={styles.socialIcon} />
            </Link>
            <Link className={styles.socialLink}>
              <img src={facebookIcon} alt="" className={styles.socialIcon} />
            </Link>
            <Link className={styles.socialLink}>
              <img src={youtubeIcon} alt="" className={styles.socialIcon} />
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Footer;
