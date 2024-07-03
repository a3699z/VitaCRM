import { useEffect, useRef } from "react";
import GuestLayout from "@/Layouts/GuestLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";
import styles from "./style.module.css";
import logo from "@/Assets/Logo.png";
import heroImg from "@/Assets/Auth/heroImg.png";
import FormGroup from "@/Components/FormGroup";
import Checkbox from "@/Components/Checkbox";
import Navbar from "@/Components/Navbar";
import { useState } from "react";
import { IoClose } from "react-icons/io5";

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        username: "",
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        checked: false,
        // password_confirmation: '',
    });

    const [showModal, setShowModal] = useState(false);
    const [modalContent, setModalContent] = useState(null);

    const modalRef = useRef(null);

    useEffect(() => {
        return () => {
            reset("password", "password_confirmation");
        };
    }, []);

    const [showPassword, setShowPassword] = useState(false);
    const [showConfirmPassword, setShowConfirmPassword] = useState(false);

    const submit = (e) => {
        e.preventDefault();
        // console.log(data);

        post(route("register"));
    };
    useEffect(() => {
        if (showModal && modalRef.current) {
            modalRef.current.style.overflowY = "auto";
        } else {
            if (modalRef.current) {
                modalRef.current.style.overflowY = "hidden";
            }
        }
    }, [showModal, modalRef.current]);

    const showModalOne = () => {
        setShowModal(true);
        setModalContent(
            <div>
                <div className="flex justify-between mb-6">
                    {" "}
                    <div>
                        <h2 className=" font-bold text-[#ca9b31] text-lg">
                            Allgemeine Nutzungsbedingungen
                        </h2>
                    </div>
                    <div>
                        <IoClose
                            className="cursor-pointer h-6 w-6 text-[#ca9b31] "
                            onClick={() => setShowModal(false)}
                        />
                    </div>
                </div>

                <div className="space-y-4">
                    <p className="text-gray-600 text-base font-medium flex flex-col gap-3 ">
                        <span>
                            Allgemeine Nutzungsbedingungen Die VIP GmbH
                            unterstützt Kunden mit einem Pflegegrad und ihre
                            pflegenden Angehörigen durch professionelle
                            Pflegeberatungen und Pflegekurse nach §§ 37 und 45
                            SGB XI (ggf. auch weitere Grundlagen). Damit wir uns
                            voll auf die Erfüllung der Kerntätigkeit
                            konzentrieren und Ihnen einen sehr guten Service
                            bieten können, nutzen wir einen sinnvollen und
                            unterstützenden Ablauf mit technischer
                            Unterstützung:
                        </span>
                        <span>
                            • Kontoerstellung Als Kunden müssen Sie sich
                            einmalig mit einem Konto registrieren. Das Konto
                            wird zur Vereinfachung der Administration genutzt
                            und Ihre Daten gespeichert. Eine Weitergabe erfolgt
                            nur im vereinbarten Umfang und soweit dies für die
                            Beratungsleistungen absolut notwendig ist, gemäß
                            unserer Datenschutzerklärung. Die hinterlegten Daten
                            werden in den Beratungen durch die Berater ergänzt
                            oder korrigiert. Es erfolgt immer eine
                            Aktualitätsabfrage. In diesem Konto werden die
                            nachweispflichtigen Angaben aus den Beratungen und
                            Kursen im Rahmen der gesetzlichen
                            Aufbewahrungspflicht gespeichert. Ihr Vorteil
                            besteht darin, dass bei Folgeberatungen die Berater
                            auf den letzten Stand zurückgreifen können. Sie
                            erhalten außerdem die notwendigen Nachweise,
                            Terminerinnerungen und Zugangsdaten bequem an die
                            hinterlegten Daten.
                        </span>{" "}
                        <span>
                            • Einverständnis zur Datenverarbeitung und
                            Weitergabe an die Pflegekasse Bei Pflegeberatungen
                            und Pflegekursen ist eine abgestimmte
                            Datenweitergabe an die Kostenträger und die
                            Pflegekasse notwendig. Mit der Nutzung stimmen Sie
                            der grundsätzlichen Weitergabe zu. Der
                            Beratungsbesuch dient der Sicherung der Qualität der
                            häuslichen Pflege und der regelmäßigen Hilfestellung
                            und praktischen pflegefachlichen Unterstützung der
                            häuslich Plegenden (§ 37 Abs. 3 SGB XI). Die
                            Durchführung des Beratungsbesuches ist gegenüber der
                            Pflegekasse oder dem privaten
                            Versicherungsunternehmen zu bestätigen (§§ 37 Abs.
                            4, 106a SGB XI). Die Weitergabe der beim
                            Beratungsbesuch gewonnenen Erkenntnisse über die
                            Möglichkeiten zur Verbesserung der häuslichen
                            Pflegesituation darf an die Pflegekasse oder das
                            private Versicherungsunternehmen und im Fall der
                            Beihilfeberechtigung an die zuständige
                            Beihilfefestsetzungsstelle nur mit Einwilligung der
                            pflegebedürftigen Person vorgenommen werden. Die
                            Datenverarbeitung dient der regelmäßigen
                            Hilfestellung und Beratung der Pflegenden zur
                            Sicherung der Pflegequalität. Die pflegebedürftige
                            Person und die Pflegeperson(en) wurden auch auf die
                            Auskunfts-, Beratungs- und
                            Unterstützungsmöglichkeiten der für sie zuständigen
                            Pflegestützpunkte sowie der Pflegeberatung nach § 7a
                            SGB XI hingewiesen. Die Daten werden nicht an Dritte
                            weitergegeben. Die Weitergabe der beim
                            Beratungsbesuch gemachten Einschätzungen an die
                            Pflegekasse oder das private
                            Versicherungsunternehmen und im Fall der
                            Beihilfeberechtigung an die zuständige
                            Beihilfefestsetzungsstelle ist freiwillig. Aus einer
                            Ablehnung der Einwilligung entstehen der
                            pflegebedürftigen Person keine Nachteile. Bei
                            Vorliegen einer akuten Gefahrensituation (Gefahr im
                            Verzug) erfolgt die Weitergabe der Information, dass
                            die Pflege nicht sichergestellt ist, jedoch auch
                            ohne die Einwilligung der/ des Pflegebedürftigen.
                            Eine akute Gefahrensituation liegt vor, wenn nach
                            Einschätzung der Beratungsperson ein unmittelbarer
                            Schaden für Leib oder Leben der/ des
                            Pflegebedürftigen droht, weshalb ein sofortiges
                            Einschreiten notwendig erscheint. Ebenfalls nicht
                            erforderlich ist die Einwilligung für die Weitergabe
                            der Information, dass aus Sicht der Beratungsperson
                            eine weitergehende Beratung angezeigt ist. Die
                            Einwilligung in die Datenverarbeitung kann jederzeit
                            bei der zuständigen Pflegekasse oder dem privaten
                            Versicherungsunternehmen und im Fall der
                            Beihilfeberechtigung bei der zuständigen
                            Beihilfefestsetzungsstelle – auch ohne Angaben von
                            Gründen – ganz oder teilweise schriftlich mit
                            Wirkung für die Zukunft widerrufen werden. Nach
                            Erhalt des Widerrufs werden die betreffenden Daten
                            nicht mehr genutzt bzw. verarbeitet und gelöscht.
                            Durch den Widerruf der Einwilligung wird die
                            Rechtsmäßigkeit der aufgrund der Einwilligung bis
                            zum Zeitpunkt des Widerrufs erfolgten Verarbeitung
                            nicht berührt. Mit der Nutzung stimmen Sie der
                            Übermittlung der Daten zur Sicherstellung der
                            Pflege- und Betreuungssituation und ggf. den
                            möglichen Maßnahmen zur Verbesserung der Pflege- und
                            Betreuungssituation an meine Pflegekasse bzw. mein
                            privates Versicherungsunternehmen zu.
                        </span>{" "}
                        <span>
                            • Einverständnis zum Empfang von Terminen und
                            Terminerinnerungen per E-Mail Um Ihnen ein einfaches
                            und gutes Kundenerlebnis zu ermöglichen erhalten Sie
                            die vereinbarten Termine per E-Mail. Außerdem
                            versenden wir eine Erinnerung einen Tag vor dem
                            Termin und eine Stunde vor dem Termin, um Ausfälle
                            zu verringern. Bei wiederkehrenden Beratungen
                            erhalten Sie zwei Wochen vor der nächsten Frist zur
                            Inanspruchnahme einer Pflegeberatung eine E-Mail zur
                            Erinnerung an eine neue Terminbuchung. Diese wird
                            eine Woche vor Fristablauf und einen Tag vor
                            Fristablauf wiederholt. Sollten Sie keine Interesse
                            an einer weiteren Beratung haben, können Sie die
                            Erinnerungen abschalten. Der E-Mail Kontakt soll
                            Ihnen und uns helfen, alle Termine sicher im Blick
                            zu behalten und unnötige Aufwände zu verringern.
                        </span>
                    </p>
                </div>
            </div>
        );
    };

    const showModalTwo = () => {
        setShowModal(true);
        setModalContent(
            <div>
                <div className="flex justify-between mb-6">
                    {" "}
                    <div>
                        <h2 className=" font-bold text-[#ca9b31] text-lg">
                            Allgemeine Geschäftsbedingungen (AGB) für
                            Pflegeberatungen nach § 37 Abs. 3 SGB XI über Video
                            oder als Hausbesuch, für Pflegekurse nach § 45 SGB
                            XI und die Buchung über unsere Webseite
                        </h2>
                    </div>
                    <div>
                        <IoClose
                            className="cursor-pointer h-6 w-6 text-[#ca9b31] "
                            onClick={() => setShowModal(false)}
                        />
                    </div>
                </div>

                <div className="space-y-4">
                    <p className="text-gray-600 text-base font-medium flex flex-col gap-3 ">
                        <span className="flex flex-col gap-1">
                            <strong> 1. Geltungsbereich</strong>
                            <span>
                                1.1 Diese Allgemeinen Geschäftsbedingungen (AGB)
                                gelten für alle Pflegeberatungen, die gemäß § 37
                                Abs. 3 SGB XI über Video oder als Hausbesuch,
                                für Pflegekurse nach § 45 SGB XI und für alle
                                weiteren Beratungsleistungen im Sinne der
                                Pflegeversicherung (SGB XI) durchgeführt werden.
                            </span>
                            <span>
                                1.2 Vertragspartner sind die VIP GmbH (im
                                Folgenden „Anbieter“) und der Kunde (im
                                Folgenden „Kunde“).
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong> 2. Vertragsgegenstand</strong>
                            <span>
                                2.1 Der Anbieter erbringt
                                Pflegeberatungsleistungen gemäß § 37 Abs. 3 SGB
                                XI über Video oder als Hausbesuch, oder
                                Pflegekurse nach § 45 SGB XI oder sonstige
                                Beratungsleistungen, die gesondert benannt
                                werden.
                            </span>
                            <span>
                                2.2 Die Beratung umfasst eine individuelle
                                Beratung zu pflegefachlichen Fragen sowie
                                Unterstützung und Information über
                                pflegerelevante Themen.
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong> 3. Vertragsabschluss</strong>
                            <span>
                                3.1 Der Vertrag über die Pflegeberatung kommt
                                durch die Anmeldung des Kunden zur
                                Pflegeberatung und die Bestätigung durch den
                                Anbieter zustande.
                            </span>
                            <span>
                                3.2 Die Anmeldung erfolgt über die Website des
                                Anbieters, telefonisch oder per E-Mail.
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong> 4. Durchführung der Pflegeberatung</strong>{" "}
                            <span>
                                4.1 Die Pflegeberatung oder auch die Pflegekurse
                                per Video erfolgen über ein
                                Video-Kommunikationstool, das vom Anbieter
                                bereitgestellt wird. Der Kunde erhält vor dem
                                Termin einen Zugangslink sowie Anweisungen zur
                                Nutzung des Tools.
                            </span>
                            <span>
                                4.2 Der Kunde ist dafür verantwortlich, die
                                technischen Voraussetzungen für die Teilnahme an
                                der Video-Beratung sicherzustellen (z.B.
                                Internetverbindung, Kamera, Mikrofon).
                            </span>
                            <span>
                                4.3 Der Kunde verpflichtet sich, zum
                                vereinbarten Termin verfügbar zu sein und
                                pünktlich teilzunehmen.
                            </span>
                            <span>
                                4.4 Die Pflegeberatung oder Pflegekurse als
                                Hausbesuch erfolgen in der Häuslichkeit des
                                Kunden. Der Kunde bucht den Termin und erhält
                                vor dem Termin eine Bestätigung per E-Mail.
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong>5. Datenschutz</strong>
                            <span>
                                5.1 Der Anbieter verpflichtet sich, die
                                datenschutzrechtlichen Bestimmungen,
                                insbesondere die Datenschutz-Grundverordnung
                                (DSGVO), einzuhalten.
                            </span>
                            <span>
                                5.2 Personenbezogene Daten des Kunden werden
                                ausschließlich zur Durchführung der
                                Pflegeberatung verwendet und nicht an Dritte
                                weitergegeben, es sei denn, es besteht eine
                                gesetzliche Verpflichtung zur Weitergabe. Die
                                Informationen aus den Beratungsbesuchen nach §
                                37 Abs. 3 SGB XI müssen im festgelegten Umfang
                                an die zuständige Pflegekasse weitergegeben
                                werden. Der Kunde erklärt sich damit im
                                abgestimmten Umfang einverstanden.
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong>6. Vergütung</strong>
                            <span>
                                6.1 Die Pflegeberatung nach § 37 Abs. 3 SGB XI
                                ist für den Kunden kostenfrei, da die Kosten von
                                der Pflegekasse übernommen werden. Auch die
                                Pflegekurse nach § 45 SGB XI sind für den Kunden
                                kostenfrei, da die Pflegekasse für die
                                Leistungen aufkommt. Der Kunde verpflichtet
                                sich, rechtzeitig vor dem Pflegekurs einen
                                Berechtigungsschein vorzulegen. Rechtzeitig
                                bedeutet im Regelfall 7 Tage vor der Beratung.
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong>7. Haftung</strong>
                            <span>
                                7.1 Der Anbieter haftet nur für Vorsatz und
                                grobe Fahrlässigkeit. Eine Haftung für leichte
                                Fahrlässigkeit ist ausgeschlossen, außer im
                                Falle der Verletzung wesentlicher
                                Vertragspflichten (Kardinalpfli
                            </span>
                            <span>
                                7.2 Der Anbieter übernimmt keine Haftung für
                                technische Störungen, die nicht im
                                Verantwortungsbereich des Anbieters liegen.
                            </span>
                        </span>

                        <span className="flex flex-col gap-1">
                            <strong>8. Stornierung und Terminänderungen</strong>{" "}
                            <span>
                                8.1 Der Kunde kann vereinbarte Termine bis 24
                                Stunden vor dem Termin kostenfrei stornieren
                                oder ändern.
                            </span>
                            <span>
                                8.2 Bei späteren Stornierungen oder
                                Nichterscheinen ohne rechtzeitige Absage behält
                                sich der Anbieter vor, eventuell entstandene
                                Kosten in Rechnung zu stellen.
                            </span>
                        </span>

                        <span className="flex flex-col gap-1">
                            <strong>9. Schlussbestimmungen</strong>
                            <span>
                                9.1 Sollten einzelne Bestimmungen dieser AGB
                                unwirksam sein oder werden, so wird die
                                Wirksamkeit der übrigen Bestimmungen hiervon
                                nicht berührt.
                            </span>
                            <span>
                                9.2 Es gilt das Recht der Bundesrepublik
                                Deutschland.
                            </span>
                            <span>
                                9.3 Gerichtsstand für alle Streitigkeiten aus
                                dem Vertragsverhältnis ist Gelsenkirchen..
                            </span>
                        </span>
                    </p>
                </div>
            </div>
        );
    };

    const showModalThree = () => {
        setShowModal(true);
        setModalContent(
            <div>
                <div className="flex justify-between mb-6">
                    {" "}
                    <div>
                        <h2 className=" font-bold text-[#ca9b31] text-lg">
                            Datenschutzerklärung für Pflegeberatungen nach § 37
                            Abs. 3 SGB XI per Video und Hausbesuch, sowie für
                            Pflegekurse nach § 45 SGB XI.
                        </h2>
                    </div>
                    <div>
                        <IoClose
                            className="cursor-pointer h-6 w-6 text-[#ca9b31] "
                            onClick={() => setShowModal(false)}
                        />
                    </div>
                </div>

                <div className="space-y-4">
                    <p className="text-gray-600 text-base font-medium flex flex-col gap-3 ">
                        <span className="flex flex-col gap-1">
                            <strong>
                                {" "}
                                1. Name und Kontaktdaten des Verantwortlichen
                            </strong>
                            <span>
                                Verantwortlicher im Sinne der
                                Datenschutz-Grundverordnung (DSGVO) ist die:
                                <ul>
                                    <li>VIP GmbH</li>
                                    <li>Leithestraße 39</li>
                                    <li>45886 Gelsenkirchen</li>
                                    <li>
                                        
                                        <a href="#"> datenschutz@orga.vip-vitalisten.de</a>
                                       </li>
                                </ul>
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong>
                                2. Erhebung und Speicherung personenbezogener
                                Daten sowie Art und Zweck und deren Verwendung
                            </strong>
                            <span className="flex flex-col gap-1">
                                <strong>
                                2.1 Für die Durchführung der Pflegeberatung
                                </strong>
                               
                                <span>
                                Wir
                                erheben, verarbeiten und speichern die folgenden
                                personenbezogenen Daten, um die Pflegeberatung
                                gemäß § 37 Abs. 3 SGB XI oder die Pflegekurse
                                nach § 45 SGB XI durchzuführen:
                                </span>
                                 
                                <ul>
                                    <li>• Name, Vorname</li>
                                    <li>• Anschrift</li>
                                    <li>
                                        • Kontaktdaten (Telefonnummer,
                                        E-Mail-Adresse)
                                    </li>
                                    <li>• Pflegegrad</li>
                                    <li>• Angaben zur Pflegekasse</li>
                                    <li>
                                        • Gesundheitsdaten, soweit sie für die
                                        Beratung relevant sind
                                    </li>
                                    <li>• Krankenversicherungsnummer</li>
                                    <li>
                                        • Aktuelle Pflegesituation inkl.
                                        Empfehlungen für die
                                        Verbesserungsmöglichkeiten
                                    </li>
                                    <li>
                                        • Ggf. weiterführender Beratungsbedarf,
                                        z.B. nach § 7a SGB XI durch die
                                        Pflegekasse
                                    </li>
                                </ul>
                            </span>
                            <span className="flex flex-col gap-1">
                             <strong>
                             2.2 Art und Zweck der Datenverarbeitung 

                             </strong>

                                <ul>
                                    <li>
                                    • Per
                                Video: Die personenbezogenen Daten werden
                                erhoben, um die Pflegeberatung per Video
                                durchzuführen. Dazu gehört die Zusendung des
                                Zugangslinks und die Nutzung eines
                                Video-Kommunikationstools.
                                    </li>

                                    <li>
                                    • Per Hausbesuch: Die
                                personenbezogenen Daten werden erhoben, um die
                                Pflegeberatung vor Ort durchzuführen,
                                einschließlich der Terminvereinbarung und
                                Anfahrtsplanung. 
                                    </li>

                                    <li>
                                    • In allen Fällen: Die Daten
                                werden für die Erstellung der verpflichtenden
                                Leistungsdokumentationen gespeichert und
                                verarbeitet, zum Beispiel, um den
                                Beratungsnachweis des GKV-Spitzenverbandes zu
                                erstellen und nach den gesetzlichen Fristen
                                aufzubewahren. Für Folgeberatungen werden die
                                Daten verarbeitet, um den Beratungsprozess gemäß
                                den gesetzlichen Anforderungen lückenlos zu
                                gewährleisten. Darüber hinaus erfolgt durch die
                                Verarbeitung der Daten die Rechnungslegung
                                gegenüber den Kostenträgern (Pflegekassen,
                                Krankenkassen) und die Nachweisdokumentation
                                über die erbrachten Leistungen.
                                    </li>
                                </ul>
                                
                               
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong>
                                {" "}
                                3. Rechtsgrundlage für die Datenverarbeitung
                            </strong>
                            <span>
                                Die Datenverarbeitung erfolgt auf Grundlage von
                                Art. 6 Abs. 1 lit. b DSGVO (Erfüllung eines
                                Vertrages) sowie Art. 9 Abs. 2 lit. h DSGVO
                                (Verarbeitung besonderer Kategorien
                                personenbezogener Daten).
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong> 4. Weitergabe von Daten</strong>{" "}
                            <span>
                                Ihre personenbezogenen Daten werden nicht an
                                Dritte weitergegeben, es sei denn, dies ist zur
                                Erfüllung unserer vertraglichen Verpflichtungen
                                erforderlich oder Sie haben ausdrücklich
                                eingewilligt. Eine Weitergabe kann erfolgen an:
                                <ul>
                                    <li>
                                        • Pflegekassen zur Abrechnung der
                                        Pflegeberatung
                                    </li>
                                    <li>
                                        • IT-Dienstleister, die uns bei der
                                        Bereitstellung des
                                        Video-Kommunikationstools unterstützen
                                    </li>
                                    <li>
                                        • Auf ausdrücklichen Wunsch des Kunden
                                        kann eine Weitergabe von Kontaktdaten an
                                        Kooperationspartner erfolgen, sofern die
                                        Kunden einen erweiterten Bedarf äußern
                                        und die Einschaltung wünschen.
                                    </li>
                                </ul>
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong>5. Dauer der Speicherung</strong>
                            <span>
                                Wir speichern Ihre personenbezogenen Daten nur
                                so lange, wie dies für die Durchführung der
                                Pflegeberatung und die Erfüllung gesetzlicher
                                Aufbewahrungspflichten erforderlich ist.
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong>6. Ihre Rechte</strong>
                            <span>
                                Sie haben das Recht:
                                
                                <ul>
                                    <li>
                                    • gemäß Art. 15 DSGVO
                                Auskunft über Ihre von uns verarbeiteten
                                personenbezogenen Daten zu verlangen; 
                                    </li>
                                    <li>
                                    • gemäß
                                Art. 16 DSGVO unverzüglich die Berichtigung
                                unrichtiger oder Vervollständigung Ihrer bei uns
                                gespeicherten personenbezogenen Daten zu
                                verlangen; 

                                    </li>
                                    <li>
                                    • gemäß Art. 17 DSGVO die Löschung
                                Ihrer bei uns gespeicherten personenbezogenen
                                Daten zu verlangen, soweit nicht die
                                Verarbeitung zur Erfüllung einer rechtlichen
                                Verpflichtung erforderlich ist; 

                                    </li>
                                    <li>


                                    • gemäß Art. 18
                                DSGVO die Einschränkung der Verarbeitung Ihrer
                                personenbezogenen Daten zu verlangen; 
                                    </li>
                                    <li>

                                    • gemäß
                                Art. 20 DSGVO Ihre personenbezogenen Daten in
                                einem strukturierten, gängigen und
                                maschinenlesbaren Format zu erhalten oder die
                                Übermittlung an einen anderen Verantwortlichen
                                zu verlangen;
                                    </li>
                                    <li>

                                    • gemäß Art. 7 Abs. 3 DSGVO Ihre
                                einmal erteilte Einwilligung jederzeit gegenüber
                                uns zu widerrufen; 
                                    </li>
                                    <li>

                                    • gemäß Art. 77 DSGVO sich
                                    bei einer Aufsichtsbehörde zu beschweren.
                                    </li>
                                </ul>
                     
                            </span>
                        </span>
                        <span className="flex flex-col gap-1">
                            <strong>7. Widerspruchsrecht</strong>
                            <span>
                                Sofern Ihre personenbezogenen Daten auf
                                Grundlage von berechtigten Interessen gemäß Art.
                                6 Abs. 1 lit. f DSGVO verarbeitet werden, haben
                                Sie das Recht, gemäß Art. 21 DSGVO Widerspruch
                                gegen die Verarbeitung Ihrer personenbezogenen
                                Daten einzulegen, soweit dafür Gründe vorliegen,
                                die sich aus Ihrer besonderen Situation ergeben.
                            </span>
                        </span>

                        <span className="flex flex-col gap-1">
                            <strong>8. Datensicherheit</strong>{" "}
                            <span>
                                Wir verwenden geeignete technische und
                                organisatorische Sicherheitsmaßnahmen, um Ihre
                                Daten gegen Manipulation, Verlust, Zerstörung
                                oder unbefugten Zugriff zu schützen.
                            </span>
                        </span>

                        <span className="flex flex-col gap-1">
                            <strong>
                                9. Aktualität und Änderung dieser
                                Datenschutzerklärung
                            </strong>
                            <span>
                                Diese Datenschutzerklärung ist aktuell gültig
                                und hat den Stand Juli 2024. Durch die
                                Weiterentwicklung unserer Dienstleistungen oder
                                aufgrund geänderter gesetzlicher beziehungsweise
                                behördlicher Vorgaben kann es notwendig werden,
                                diese Datenschutzerklärung zu ändern. Die
                                jeweils aktuelle Datenschutzerklärung kann
                                jederzeit auf unserer Website abgerufen und
                                ausgedruckt werden.
                            </span>
                            Impressum:
                            <a
                                href="    https://www.vip-vitalisten.de/kontakt"
                                className=" no-underline text-[#ca9b31] "
                                target="_blank"
                            >
                                {" "}
                                https://www.vip-vitalisten.de/kontakt
                            </a>
                        </span>
                    </p>
                </div>
            </div>
        );
    };

    return (
        <>
            <Navbar user={false} />

            <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                <Head title="Register" />

                <div className={styles.container}>
                    {/* left side start */}
                    <div>
                        <div className={styles.formContainer}>
                            <div className={styles.headContainer}>
                                <img
                                    src={logo}
                                    alt="logo"
                                    className={styles.logo}
                                />
                                <h3 className={styles.title}>Registieren</h3>
                            </div>

                            <form className={styles.form} onSubmit={submit}>
                                {/* <FormGroup
                            id={"username"}
                            label={"Benutzername*"}
                            name={"username"}
                            onChange={(e) => {
                                setData('username', e.target.value);
                            }}
                            placeholder={"username"}

                        /> */}
                                <div className={styles.formGroup}>
                                    <label
                                        htmlFor="username"
                                        className={styles.label}
                                    >
                                        {/* Benutzername* */}
                                        Vorname*
                                    </label>
                                    <input
                                        type="text"
                                        name="username"
                                        id="username"
                                        className={styles.input}
                                        placeholder="name"
                                        onChange={(e) =>
                                            setData("username", e.target.value)
                                        }
                                    />
                                </div>
                                <InputError
                                    message={errors.username}
                                    className="mt-2"
                                />
                                {/* <FormGroup
                            id={"name"}
                            label={"Name*"}
                            name={"name"}
                            onChange={(e) => {
                                setData('name', e.target.value);
                            }}
                            placeholder={"Ihre name eingeben"}
                        /> */}
                                <div className={styles.formGroup}>
                                    <label
                                        htmlFor="name"
                                        className={styles.label}
                                    >
                                        Nachname*
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        className={styles.input}
                                        placeholder="Ihre nachname eingeben"
                                        onChange={(e) =>
                                            setData("name", e.target.value)
                                        }
                                    />
                                </div>
                                <InputError
                                    message={errors.name}
                                    className="mt-2"
                                />
                                {/* <FormGroup
                            id={"email"}
                            label={"E-mail*"}
                            name={"email"}
                            onChange={(e) => {
                                setData('email', e.target.value);
                            }}
                            placeholder={"Ihre E-Mail eingeben"}
                        /> */}

                                <div className={styles.formGroup}>
                                    <label
                                        htmlFor="email"
                                        className={styles.label}
                                    >
                                        E-mail*
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        className={styles.input}
                                        placeholder="Ihre E-Mail eingeben"
                                        onChange={(e) =>
                                            setData("email", e.target.value)
                                        }
                                    />
                                </div>
                                <InputError
                                    message={errors.email}
                                    className="mt-2"
                                />
                                {/* <FormGroup
                            id={"password"}
                            label={"Passwort*"}
                            name={"password"}
                            onChange={(e) => {
                                setData('password', e.target.value);
                            }}
                            placeholder={"••••••••"}
                            type={"password"}
                            info={"Muss mindestens 8 Zeichen haben."}
                        /> */}
                                <div
                                    className={`${styles.formGroup} ${styles.passwordContainer}`}
                                >
                                    <label
                                        htmlFor="password"
                                        className={styles.label}
                                    >
                                        Passwort*
                                    </label>
                                    <input
                                        type={
                                            showPassword ? "text" : "password"
                                        }
                                        name="password"
                                        id="password"
                                        className={styles.input}
                                        placeholder="••••••••"
                                        onChange={(e) =>
                                            setData("password", e.target.value)
                                        }
                                    />
                                    <span
                                        className={styles.passwordToggle}
                                        onClick={() =>
                                            setShowPassword(!showPassword)
                                        }
                                    >
                                        {showPassword ? "🙈" : "👁️"}
                                    </span>
                                    <span className={styles.info}>
                                        Muss mindestens 8 Zeichen haben.
                                    </span>
                                </div>
                                <InputError
                                    message={errors.password}
                                    className="mt-2"
                                />

                                {/* password confirmation */}
                                <div
                                    className={`${styles.formGroup} ${styles.passwordContainer}`}
                                >
                                    <label
                                        htmlFor="password_confirmation"
                                        className={styles.label}
                                    >
                                        Passwort bestätigen*
                                    </label>
                                    <input
                                        type={
                                            showConfirmPassword
                                                ? "text"
                                                : "password"
                                        }
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        className={styles.input}
                                        placeholder="••••••••"
                                        onChange={(e) =>
                                            setData(
                                                "password_confirmation",
                                                e.target.value
                                            )
                                        }
                                    />
                                    <span
                                        className={styles.confirmPasswordToggle}
                                        onClick={() =>
                                            setShowConfirmPassword(
                                                !showConfirmPassword
                                            )
                                        }
                                    >
                                        {showConfirmPassword ? "🙈" : "👁️"}
                                    </span>
                                </div>
                                <InputError
                                    message={errors.password_confirmation}
                                    className="mt-2"
                                />

                                <div className={styles.container}>
                                    <label
                                        htmlFor="a"
                                        style={{
                                            fontSize: "14px",
                                            fontWeight: 500,
                                            lineHeight: "20px",
                                            color: "rgba(52, 64, 84, 1)",
                                        }}
                                        className={styles.check_container}
                                    >
                                        <input
                                            type="checkbox"
                                            name="a"
                                            id="a"
                                            className={styles.ckeckboxInput}
                                            onChange={(e) => {
                                                setData(
                                                    "checked",
                                                    e.target.checked
                                                );
                                            }}
                                        />
                                        <span></span>
                                        <div
                                            onClick={(e) => {
                                                e.preventDefault();
                                            }}
                                        >
                                            Ich habe die{" "}
                                            <div className=" flex md:flex-row flex-col   gap-1">
                                                <span
                                                    style={{
                                                        color: "rgba(212, 170, 44, 1)",
                                                    }}
                                                    className="cursor-pointer"
                                                    onClick={showModalOne}
                                                >
                                                    Nutzungsbedingungen,
                                                </span>{" "}
                                                <span
                                                    style={{
                                                        color: "rgba(212, 170, 44, 1)",
                                                    }}
                                                    className="cursor-pointer"
                                                    onClick={showModalTwo}
                                                >
                                                    Geschäftsbedingungen,
                                                </span>{" "}
                                                <span
                                                    style={{
                                                        color: "rgba(212, 170, 44, 1)",
                                                    }}
                                                    className="cursor-pointer"
                                                    onClick={showModalThree}
                                                >
                                                    Datenschutzerklärung
                                                </span>{" "}
                                            </div>
                                            gelesen und bin mit ihnen
                                            einverstanden.
                                        </div>
                                    </label>
                                    <InputError
                                        message={errors.checked}
                                        className="mt-2"
                                    />
                                </div>
                                <button
                                    type="submit"
                                    className={styles.submitBtn}
                                >
                                    Los Gehts!
                                </button>
                                <p className={styles.registerText}>
                                    Haben Sie schon ein Konto?{" "}
                                    <Link href="/login" className={styles.link}>
                                        Sich anmelden
                                    </Link>
                                </p>
                            </form>
                        </div>
                        <div className={styles.footerContainer}>
                            <p className={styles.footerText}>
                                © 2016 - 2024 VIP GmbH. All Rights Reserved.
                            </p>
                        </div>
                    </div>
                    {/* left side end */}

                    {/* right side start */}
                    <div className={styles.heroImgContainer}>
                        <img src={heroImg} alt="" className={styles.heroImg} />
                    </div>
                    {/* right side end */}
                </div>

                {showModal && (
                    <div className="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
                        <div
                            ref={modalRef}
                            className="bg-white rounded-lg shadow-2xl p-8 w-11/12 md:w-4/12 h-[700px] max-h-screen overflow-y-auto"
                        >
                            {modalContent}
                        </div>
                    </div>
                )}
            </div>
        </>
    );
}
