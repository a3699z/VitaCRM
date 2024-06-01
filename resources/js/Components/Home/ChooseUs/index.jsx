import React from "react";

import chooseImg from "@/Assets/Home/chooseUs.png";
import styles from "./style.module.css";

const ChooseUs = () => {
  return (
    <div className={styles.container}>
      <div className={styles.imgContainer}>
        <img src={chooseImg} alt="" className={styles.img} />
      </div>
      <div className={styles.contentContainer}>
        <h3 className={styles.title}>WÄHLEN SIE UNS?</h3>
        <h2 className={styles.bigTitle}>
          Warum <span className={styles.bigTitleColored}>VIP Vitalisten?</span>
        </h2>
        <p className={styles.paragraph}>
          Wir bieten Ihnen bundesweit Beratungsbesuche nach § 37 Abs. 3 SGB XI
          über einen sicheren Video-Chat. Vergessen Sie langweilige
          Warteschleifen und endlose Papierkram-Orgien – bei uns geht alles
          blitzschnell und unkompliziert!
        </p>
        <p className={styles.paragraph}>
          Und das Beste daran? Mit unserer einfachen Online-Terminbuchung sind
          Sie nur wenige Klicks von Ihrer persönlichen Beratung entfernt! Buchen
          Sie ganz leicht Ihren verfügbaren Wunschtermin. Wir sorgen mit unseren
          Fachkräften dafür, dass Sie und Ihre Liebsten die bestmögliche
          Beratung erhalten – schnell, unkompliziert und mit einem Lächeln!
        </p>
        <p className={styles.paragraph}>
          Übrigens: Für ausgewählte Städte wie Bochum, Essen, Gelsenkirchen,
          Dortmund und Hagen bieten wir optional auch klassische Hausbesuche an.
          Auch diesen Service können Sie ganz einfach online buchen.
        </p>
      </div>
    </div>
  );
};

export default ChooseUs;
