import React, { useState, useEffect, useRef } from "react";

import chooseImg from "@/Assets/Home/chooseUs.png";
import styles from "./style.module.css";
import { FaFacebook, FaLinkedin } from "react-icons/fa";
import { FaXTwitter, FaLink } from "react-icons/fa6";
import { IoIosArrowUp, IoIosArrowDown } from "react-icons/io";
import { IoSearchOutline, IoClose } from "react-icons/io5";
import { CiSearch } from "react-icons/ci";

const questions = [
    {
        id: 1,
        question: "Was ist eine Pflegeberatung nach § 37 Abs. 3 SGB XI?",
        answer: "Die Pflegeberatung nach § 37 Abs. 3 des Sozialgesetzbuches XI (SGB XI) ist eine gesetzlich vorgeschriebene Beratung für Pflegebedürftige, die Pflegegeld beziehen und von Angehörigen oder ehrenamtlichen Pflegepersonen zu Hause gepflegt werden. Diese Beratung soll sicherstellen, dass die häusliche Pflege ordnungsgemäß durchgeführt wird und die Pflegenden die nötige Unterstützung und Informationen erhalten.",
    },
    {
        id: 2,
        question: "Kostet die Pflegeberatung Geld?",
        answer: "Die Kosten für die Pflegeberatung nach § 37 Abs. 3 SGB XI rechnen wir direkt mit der Pflegeversicherung ab. Für Sie entstehen keine Kosten.",
    },
    {
        id: 3,
        question:
            "Welche Vorteile hat die Videoberatung im Vergleich zum Hausbesuch?",
        answer: [
            ` 1. Zeitersparnis:


Sie müssen keine An- und Abreise des Beraters einplanen, was insbesondere in ländlichen Gebieten oder bei langen Anfahrtswegen vorteilhaft ist.

Flexible Terminvereinbarungen sind einfacher möglich, da keine Anfahrtszeiten berücksichtigt werden müssen.`,

            `2. Komfort und Bequemlichkeit:

Die Beratung kann bequem von zu Hause aus durchgeführt werden, ohne dass die pflegebedürftige Person und die Pflegeperson sich auf den Besuch vorbereiten müssen.

Keine Notwendigkeit, den Haushalt für den Besuch vorzubereiten oder mögliche Störungen durch Besucher zu berücksichtigen.`,

            `3. Schnellere Verfügbarkeit:


Videoberatungen können oft kurzfristiger und flexibler organisiert werden, da Berater keine Fahrtzeiten einplanen müssen.

Dies ermöglicht eine schnellere Reaktion auf akute Fragen oder Probleme.`,

            `4. Geringere Ansteckungsgefahr:


Gerade in Zeiten von Pandemien oder ansteckenden Krankheiten minimiert die Videoberatung das Infektionsrisiko, da kein physischer Kontakt stattfindet.,
`, `5. Diskretion und Privatsphäre:


Videoberatung kann diskreter sein, da keine zusätzlichen Personen das Haus betreten müssen und Nachbarn oder Besucher nicht mitbekommen, dass eine Beratung stattfindet.`,

            `6. Erreichbarkeit:


Videoberatung ermöglicht es auch, Berater in entlegenen oder unterversorgten Gebieten zu erreichen, wo es möglicherweise keine lokalen Berater gibt. Auch eine unkomplizierte Anbindung von Angehörigen ist dadurch möglich, selbst wenn diese zum Zeitpunkt an einem anderen Ort sind.`,

            `Fazit
Videoberatung bietet zahlreiche Vorteile in Bezug auf Flexibilität, Komfort, Sicherheit und Effizienz. Sie stellt eine wertvolle Ergänzung zu traditionellen Hausbesuchen dar und kann insbesondere für Personen in abgelegenen Gebieten oder mit eingeschränkter Mobilität eine optimale Lösung sein.`,
        ],
    },
    {
        id: 4,
        question: "Ist die Pflegeberatung verpflichtend?",
        answer: "Ja, die Inanspruchnahme der Pflegeberatung ist für Pflegegeldempfänger verpflichtend. Erfolgt die Beratung nicht regelmäßig, kann die Pflegekasse das Pflegegeld kürzen oder in Einzelfällen sogar einstellen.",
    },
    {
        id: 5,
        question: "Wie wird die Pflegeberatung beantragt?",
        answer: "Pflegebedürftige Menschen mit einem Pflegegrad zwischen 2 und 5 haben automatisch einen Anspruch, ein separater Antrag vor der Durchführung ist daher nicht erforderlich. Die VIP regelt alles formelle für Sie.",
    },
    {
        id: 6,
        question: "Wer hat Anspruch auf eine Pflegeberatung?",
        answer: "Pflegebedürftige Personen, die Leistungen der Pflegeversicherung in Form von Pflegegeld beziehen, haben Anspruch auf eine regelmäßige Pflegeberatung. Dies gilt für alle Pflegegrade (2 bis 5).",
    },
    {
        id: 7,
        question:
            "Wie oft muss die Pflegeberatung in Anspruch genommen werden?",
        answer: [`Die Häufigkeit der Beratung hängt vom Pflegegrad ab:`,

`Pflegegrad 2 und 3: einmal alle sechs Monate`,

`Pflegegrad 4 und 5: einmal alle drei Monate`]
    },
    {
        id: 8,
        question: "Was sind die Inhalte der Pflegeberatung?",
        answer: [`Überprüfung der Pflegesituation und Qualität der häuslichen Pflege`,

`Beratung zu pflegerischen Techniken und Hilfsmitteln`,

`Information über weitere Unterstützungsangebote und Entlastungsmöglichkeiten`,

`Tipps zur Verbesserung der Pflegesituation`],
    },
    {
        id: 9,
        question: "Wer führt die Pflegeberatung durch?",
        answer: "Die Pflegeberatung wird von zugelassenen Pflegediensten oder qualifizierten Pflegeberatern durchgeführt. Alle Mitarbeiterinnen und Mitarbeiter (Vitalisten) sind als examinierte Fachkräfte zugelassen und besonders weitergebildet.",
    },
    {
        id: 10,
        question: "Welche Vorteile bietet die Pflegeberatung?",
        answer: [`Die Pflegeberatung bietet mehrere Vorteile:`,
`
Sicherstellung einer hohen Pflegequalität`,

`Unterstützung und Entlastung der pflegenden Angehörigen`,

`Information über zusätzliche Hilfs- und Entlastungsangebote`,

`Vermeidung von Pflegefehlern und gesundheitlichen Risiken für den Pflegebedürftigen`
        ]
,
    },
    {
        id: 11,
        question: "Wie kann ich einen Termin vereinbaren?",
        answer: "Am einfachsten nutzen Sie unser Kontaktformular. Wir melden uns dann zeitnah bei Ihnen.",
    },
];

const ChooseUs = () => {
    const [activeQuestion, setActiveQuestion] = useState(null);
    const [showSearch, setShowSearch] = useState(false);
    const [searchTerm, setSearchTerm] = useState("");
    const searchBarRef = useRef(null);

    const toggleText = (id) => {
        setActiveQuestion(activeQuestion === id ? null : id);
    };

    const toggleSearch = () => {
        setShowSearch(!showSearch);
    };

    const handleSearchChange = (event) => {
        setSearchTerm(event.target.value);
    };

    const filteredQuestions = searchTerm
        ? questions.filter((item) =>
              item.question.toLowerCase().includes(searchTerm.toLowerCase())
          )
        : questions;

    const handleClearSearch = () => {
        setSearchTerm("");
        setShowSearch(false);
    };

    return (
        <div className="mx-auto my-36 flex flex-col items-center justify-center w-full max-w-3xl ">
            {!showSearch && (
                <div className="flex w-full justify-between relative  items-center mb-5  md:px-0 px-6  ">
                    <h2 className="flex items-center justify-center mx-auto text-5xl font-semibold leading-[52px] text-[#c7982e]">
                        Weitere Infos | FAQ
                    </h2>
                    <IoSearchOutline
                        onClick={toggleSearch}
                        className=" flex items-end text-[#c7982e] cursor-pointer w-5 h-5  hover:opacity-60"
                    />
                </div>
            )}
            {showSearch && (
                <div className="flex  items-center w-full relative ">
                    <IoSearchOutline className="flex items-center absolute left-2 text-[#c7982e]   " />
                    <input
                        type="text"
                        placeholder="Suche..."
                        onChange={handleSearchChange}
                        className="w-full px-8 h-12 text-sm text-[#c7982e] placeholder-[#c7982e] bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#c7982e] focus:border-transparent "
                    />
                    <IoClose
                        className="absolute flex items-center right-2 text-[#c7982e] cursor-pointer"
                        onClick={handleClearSearch}
                    />
                </div>
            )}

            {filteredQuestions.map((item) => (
                <div
                    key={item.id}
                    className=" flex flex-col justify-center w-full max-w-[800px] pt-3 md:px-0 px-6"
                >
                    <button
                        className={`flex items-center justify-between py-8 text-left w-full transition duration-1000 ease-in-out ${
                            activeQuestion === item.id
                                ? " border-none  "
                                : "border-b-[1px]  border-[#c7982e] "
                        }`}
                        onClick={() => toggleText(item.id)}
                    >
                        <div className="flex items-center">
                            <h3 className="text-2xl text-[#c7982e] leading-normal ">
                                {item.question}
                            </h3>
                        </div>
                        <span>
                            {activeQuestion === item.id ? (
                                <div>
                                    <IoIosArrowDown className="size-4 items-center flex justify-center text-[#c7982e] " />
                                </div>
                            ) : (
                                <div>
                                    <IoIosArrowUp className="size-4 items-center flex justify-center text-[#c7982e]" />
                                </div>
                            )}
                        </span>
                    </button>
                    {activeQuestion === item.id && (
                        <div>
                            <div className="mt-2">
                            {Array.isArray(item.answer) ? (
                                <ul className={styles.answerList}>
                                    {item.answer.map((answerItem, index) => (
                                        <li key={index} className={styles.answerListItem}>
                                            {answerItem}
                                        </li>
                                    ))}
                                </ul>
                             ) : (
                                <span>{item.answer}</span>
                            )}
                            </div>
                            <div className="flex gap-2 mt-4 text-[#c7982e] cursor-pointer transition duration-300 ease-in-out ">
                                <FaFacebook className="hover:opacity-55" />
                                <FaXTwitter className="hover:opacity-55" />
                                <FaLinkedin className="hover:opacity-55" />
                                <FaLink className="hover:opacity-55" />
                            </div>
                        </div>
                    )}
                </div>
            ))}
        </div>
    );
};

export default ChooseUs;