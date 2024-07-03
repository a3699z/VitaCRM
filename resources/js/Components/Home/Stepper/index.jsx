import React from "react";
import styles from "./style.module.css";
import Card from "../Card";
import about1 from "@/Assets/Home/about/about-1.png";
import about2 from "@/Assets/Home/about/about-2.png";
import about3 from "@/Assets/Home/about/about-3.png";

const limitText = (text) => text.slice(0, 150) + "...";

// const cards = [
//     {
//         id: 1,
//         title: "Intensivpflege",
//         img: about1,
//         text: limitText(
//             "Wir bieten spezialisierte außerklinische Intensivpflege (AKI) für Patienten im eigenen Zuhause mit komplexen medizinischen Bedürfnissen.Unser engagiertes Team hochqualifizierter Pflegefachkräfte gewährleistet individuelle Versorgung im häuslichen Umfeld. Ziel ist es, die Lebensqualität und Selbstbestimmung unserer Patienten zu optimieren. Wir stehen für medizinische Überwachung, einfühlsame Betreuung und die Schaffung eines sicheren, vertrauten Raums."
//         ),
//         link: "",
//         linkText: "Mehr lesen",
//     },
//     {
//         id: 2,
//         title: "Mini-VIP Kinderintensiv",
//         img: about2,
//         text: limitText(
//             "Wir sind ebenso Experten für außerklinische Kinderintensivpflege, die sich auf die besonderen Bedürfnisse junger Patienten mit komplexen medizinischen Anforderungen konzentriert. Unser engagiertes Team hochqualifizierter Pflegefachkräfte bietet einfühlsame Betreuung direkt im vertrauten Zuhause. Ziel ist es, das familiäre Umfeld zu erhalten und die Entwicklungschancen unserer kleinen Patienten zu fördern."
//         ),
//         link: "",
//         linkText: "Mehr lesen",
//     },
//     {
//         id: 3,
//         title: "Intensivpflege",
//         img: about3,
//         text: limitText(
//             "Pflegegeld-Bezieher sind verpflichtet in regelmäßigen Abständen einen Beratungsbesuch durch eine zugelassene Pflegekraft anzufordern. ​Im Rahmen eines Modellversuches mit dem GKV-Spitzenverband bieten wir exklusiv bis 2025 deutschlandweit Beratungsbesuche per Video-Beratung an. Sie können ganz bequem und fast ohne Aufwand von unserem Service profitieren."
//         ),
//         link: "",
//         linkText: "Mehr lesen",
//     },
// ];

const Stepper = () => {
    return (
        <div className=" bg-[#F9F8F2] rounded-t-2xl  ">
            <div className="grid md:grid-cols-3 grid-cols-1 md:p-8 p-4 ">
                {/* <div className={styles.stepContainer}>
                    <div className={styles.stepIndicator}>
                        <span className={styles.stepIndicatorNumber}>1</span>
                    </div>
                    <h5 className={styles.stepTitle}>Konto erstellen</h5>
                    <p className={styles.stepDesc}>
                        Beginnen Sie den Zugriff auf Gesundheitsdienste, indem
                        Sie ein kostenloses Konto erstellen.
                    </p>
                    {cards.map((card) => (
                        <Card
                            key={card.id}
                            img={card.img}
                            title={card.title}
                            text={card.text}
                            linkText={card.linkText}
                            link={card.link}
                        />
                    ))}
                </div> */}
                <div className={styles.stepContainer}>
                    <div className={styles.stepIndicator}>
                        <span className={styles.stepIndicatorNumber}>1</span>
                    </div>{" "}
                    <h5 className={styles.stepTitle}>Konto erstellen</h5>
                    <p className={styles.stepDesc}>
                        Beginnen Sie den Zugriff auf Gesundheitsdienste, indem
                        Sie ein kostenloses Konto erstellen.
                    </p>
                </div>
                <div className={styles.stepContainer}>
                    <div className={styles.stepIndicator}>
                        <span className={styles.stepIndicatorNumber}>2</span>
                    </div>
                    <h5 className={styles.stepTitle}>Termin wählen</h5>
                    <p className={styles.stepDesc}>
                        Planen Sie Ihren Termin, indem Sie ein passendes Datum
                        und eine passende Uhrzeit auswählen.
                    </p>
                </div>
                <div className={styles.stepContainer}>
                    <div className={styles.stepIndicator}>
                        <span className={styles.stepIndicatorNumber}>3</span>
                    </div>
                    <h5 className={styles.stepTitle}>Erinnerungen erhalten</h5>
                    <p className={styles.stepDesc}>
                        Vergessen Sie Ihren Termin nicht mit automatischen
                        Erinnerungen.
                    </p>
                </div>
            </div>
        </div>
    );
};

export default Stepper;