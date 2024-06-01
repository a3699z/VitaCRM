import React from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import { Pagination } from "swiper/modules";

import "swiper/css";
import "swiper/css/pagination";

import styles from "./style.module.css";
import bgImg from "@/Assets/Home/reviews/reviewsBackground.png";

const reviews = [
  {
    id: Math.random(),
    name: "Brian Polley",
    profession: "Personal",
    paragraph:
      "Ich habe etwas gefunden, das zu finden ich schon keine Hoffnung mehr hatte: eine berufliche Heimat und ein Team, in dem ich mich pudelwohl fühle. Wertschätzung, Professionalität, immer ein offenes Ohr für fachliche und persönliche Dinge... Dank an euch alle!",
  },
  {
    id: Math.random(),
    name: "Brian Polley",
    profession: "Personal",
    paragraph:
      "Ich habe etwas gefunden, das zu finden ich schon keine Hoffnung mehr hatte: eine berufliche Heimat und ein Team, in dem ich mich pudelwohl fühle. Wertschätzung, Professionalität, immer ein offenes Ohr für fachliche und persönliche Dinge... Dank an euch alle!",
  },
  {
    id: Math.random(),
    name: "Brian Polley",
    profession: "Personal",
    paragraph:
      "Ich habe etwas gefunden, das zu finden ich schon keine Hoffnung mehr hatte: eine berufliche Heimat und ein Team, in dem ich mich pudelwohl fühle. Wertschätzung, Professionalität, immer ein offenes Ohr für fachliche und persönliche Dinge... Dank an euch alle!",
  },
  {
    id: Math.random(),
    name: "Brian Polley",
    profession: "Personal",
    paragraph:
      "Ich habe etwas gefunden, das zu finden ich schon keine Hoffnung mehr hatte: eine berufliche Heimat und ein Team, in dem ich mich pudelwohl fühle. Wertschätzung, Professionalität, immer ein offenes Ohr für fachliche und persönliche Dinge... Dank an euch alle!",
  },
  {
    id: Math.random(),
    name: "Brian Polley",
    profession: "Personal",
    paragraph:
      "Ich habe etwas gefunden, das zu finden ich schon keine Hoffnung mehr hatte: eine berufliche Heimat und ein Team, in dem ich mich pudelwohl fühle. Wertschätzung, Professionalität, immer ein offenes Ohr für fachliche und persönliche Dinge... Dank an euch alle!",
  },
];

const Reviews = () => {
  return (
    <div
      style={{ backgroundImage: `url(${bgImg})` }}
      className={styles.container}
    >
      <div className={styles.titleContainer}>
        <h4 className={styles.title}>REVIEWS</h4>
        <h3 className={styles.bigTitle}>
          <span className={styles.bigTitleColored}>Patientenbewertung</span> von
          uns
        </h3>
      </div>
      <div>
        <Swiper
          onSlideChange={() => {
            // console.log("slide change");
          }}
          onSwiper={(swiper) => {
            // console.log(swiper);
          }}
          pagination={{
            clickable: true,
            bulletActiveClass: styles.bulletActive,
            bulletClass: styles.bullet,
          }}
          modules={[Pagination]}
        >
          {reviews.map((review) => (
            <SwiperSlide
              style={{ padding: "30px 0", cursor: "pointer" }}
              key={review.id}
            >
              <div className={styles.slideItem}>
                <p className={styles.slideParagraph}>{review.paragraph}</p>
                <h5 className={styles.slideName}>{review.name}</h5>
                <h6 className={styles.slideProfession}>{review.profession}</h6>
              </div>
            </SwiperSlide>
          ))}
        </Swiper>
      </div>
    </div>
  );
};

export default Reviews;
