import React from "react";
import Card from "../Card";

import styles from "./style.module.css";
import about1 from "@/Assets/Home/about/about-1.png";
import about2 from "@/Assets/Home/about/about-2.png";
import about3 from "@/Assets/Home/about/about-3.png";

const limitText = (text) => text.slice(0, 400) + "...";

const cardsData = [
    {
        id: 1,
        title: "Beratungsbesuch § 37 Abs. 3 SGB XI",
        img: about1,
        text: 
            "Sie erhalten Pflegegeld und benötigen einen Beratungsbesuch? Dann buchen Sie einfach einen Termin bei unseren freundlichen Experten! Die Termine sind abhängig vom Pflegegrad unterschiedlich häufig in Anspruch zu nehmen, um das Pflegegeld zu sichern."
        ,
        link: "",
        linkText: "Mehr lesen",
        direction: "right",
    },
    {
        id: 2,
        title: "Sie haben die Wahl: Vor Ort!",
        img: about2,
        text: 
            "Bei den Vitalisten wählen Sie ganz bequem aus: Wir bieten Hausbesuche zur Pflegeberatung nach § 37 Abs. 3 SGB XI in Gelsenkirchen und Umgebung (Bochum, Dortmund, Essen, Hagen, Herne) an.​"
        ,
        link: "",
        linkText: "Mehr lesen",
        direction: "left",
    },
    {
        id: 3,
        title: "NEU: Videoberatung deutschlandweit",
        img: about3,
        text: 
            "Deutschlandweit bieten wir im Rahmen des Modellprojektes Telepflege des GKV-Spitzenverbandes super bequem Beratungsbesuche als Videokonferenz an. Dazu brauchen Sie nur ein Smartphone oder einen Laptop mit Internetanschluss. Sie haben nicht viel Zeit für den Besuch, oder Ihre Angehörigen wollen sich von einem anderen Ort aus dazuschalten? Dann ist die Videoberatung die perfekte Lösung!"
        ,
        link: "",
        linkText: "Mehr lesen",
        direction: "right",
    },
];

const About = () => {
    return (
        <div>
            <div className="flex flex-col items-center mb-20 md:mt-52 mt-[420px] px-12 ">
                <h3 className={styles.title}>
                    Willkommen bei den VIP Vitalisten: im Dienste Ihrer
                    Gesundheit
                </h3>
                <h5 className={styles.subTitle}>
                    Schön, dass Sie uns besuchen.Herzlich Willkommen bei den
                    Vitalisten.
                </h5>
            </div>
            <div className="grid grid-cols-1 max-w-screen-lg mx-auto ">
                {cardsData.map((card) => (
                    <Card
                        key={card.id}
                        img={card.img}
                        title={card.title}
                        text={card.text}
                        // linkText={card.linkText}
                        link={card.link}
                        direction={card.direction}
                    />
                ))}
            </div>

            <div className="flex flex-col justify-center items-center mt-32 md:mt-40 px-4 md:px-0 ">
                <h5 className="text-[#c7982e] font-bold leading-6 text-lg">
                    WÄHLEN SIE UNS?
                </h5>
                <h1 className=" text-4xl font-semibold leading-10 text-center  ">
                    Warum
                    <span className="text-[#c7982e] ml-2">VIP Vitalisten?</span>
                </h1>
                <img
                    src="https://s3-alpha-sig.figma.com/img/ab1e/7e9a/e09bd4f9219f80d93d3f72c353a3cb15?Expires=1720396800&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=PFXwZllKj0dYZaq1Lv40jHifKTJaeYGdoQKijnniT-OAJp1SmiMv~UZY6DfxhVWFwG4KIMDUNCY8eYqxUh2NAYOBuCC3CHwoyD~w~YBmTTZwdGAYFvMSNIHxKTAFn-IiPZ5AOmOziF~WFx0NwPKzPePTosO2jO2-eUYHl4t5hUG7XZZIXCYGtNsZoZSzDwWOEfEsgiXEH4pY1tMW2-AZzJcgRPgFMnfM-x6HoTar-u~2TC2q~wZHHpdfTyVQ7FzXOP7v0kCGs3tsGtIfA~sN7WIX1WJvY850WYdKPyb~x~ovo2MwTg5JST8Q29Po1HJo1Nrv4fusnAS5wtg1293Qbg__"
                    alt=""
                    className="max-w-full  w-[1217px] h-[462px] object-cover  rounded-xl mt-12 md:mt-16"
                />
                <div
                    className="max-w-full  w-[1217px] text-base  font-normal leading-6 items-center text-center  px-4  mt-12 md:mt-16  flex flex-col gap-6
                "
                >
                    <p>
                        Wir bieten Ihnen bundesweit Beratungsbesuche nach § 37
                        Abs. 3 SGB XI über einen sicheren Video-Chat. Vergessen
                        Sie langweilige Warteschleifen und endlose
                        Papierkram-Orgien – bei uns geht alles blitzschnell und
                        unkompliziert!
                    </p>
                    <p>
                        Und das Beste daran? Mit unserer einfachen
                        Online-Terminbuchung sind Sie nur wenige Klicks von
                        Ihrer persönlichen Beratung entfernt! Buchen Sie ganz
                        leicht Ihren verfügbaren Wunschtermin. Wir sorgen mit
                        unseren Fachkräften dafür, dass Sie und Ihre Liebsten
                        die bestmögliche Beratung erhalten – schnell,
                        unkompliziert und mit einem Lächeln!
                    </p>
                    <p>
                        Übrigens: Für ausgewählte Städte wie Bochum, Essen,
                        Gelsenkirchen, Dortmund und Hagen bieten wir optional
                        auch klassische Hausbesuche an. Auch diesen Service
                        können Sie ganz einfach online buchen.
                    </p>
                </div>
            </div>
        </div>
    );
};

export default About;