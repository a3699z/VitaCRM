import React, { useState } from "react";
import styles from "./style.module.css";
import VisitCard from "../VisitCard";

const initialVisits = [
  {
    id: Math.random(),
    visitType: "Videosprechstunde Termin",
    doctorName: "Spezialist, Leslie Alexander",
    profession: "Krankenpfleger",
    date: "April 29-2024",
    time: "12:00, Montag",
    visitId: "visit1",
  },
  {
    id: Math.random(),
    visitType: "Videosprechstunde Termin",
    doctorName: "Spezialist, Leslie Alexander",
    profession: "Krankenpfleger",
    date: "April 29-2024",
    time: "12:00, Montag",
    visitId: "visit2",
  },
  {
    id: Math.random(),
    visitType: "Videosprechstunde Termin",
    doctorName: "Spezialist, Leslie Alexander",
    profession: "Krankenpfleger",
    date: "April 29-2024",
    time: "12:00, Montag",
    visitId: "visit3",
  },
  {
    id: Math.random(),
    visitType: "Videosprechstunde Termin",
    doctorName: "Spezialist, Leslie Alexander",
    profession: "Krankenpfleger",
    date: "April 29-2024",
    time: "12:00, Montag",
    visitId: "visit4",
  },
];

const Visits = ({reservations}) => {
    console.log(Array.isArray(reservations))
  const [visits, setVisits] = useState(reservations);

//   const loadMore = () => {
//     const newVisits = [];
//     for (let i = 0; i < 4; i++) {
//       newVisits.push({
//         id: Math.random(),
//         visitType: "Videosprechstunde Termin",
//         doctorName: "Spezialist, Leslie Alexander",
//         profession: "Krankenpfleger",
//         date: "April 29-2024",
//         time: "12:00, Montag",
//         visitId: "visit4",
//       });
//     }
//     setVisits([...visits, ...newVisits]);
//   };

//   visits = reservations

  return (
    <div className={styles.container}>
      <h5 className={styles.title}>Abgeschlossene Besuche</h5>
      <div className={styles.visitContainer}>
        {visits.map((reservation) => (
          <VisitCard
            key={reservation.key}
            visitType={reservation.is_online?'Videosprechstunde Termin':'Vor-Ort-Termin'}
            doctorName={reservation.employee.name}
            profession='nurse'
            date={reservation.date}
            time={reservation.hour}
            visitId={reservation.key}
            profile_image={reservation.employee.profile_image ? reservation.employee.profile_image : ''}
          />
        ))}
        {/* <button className={styles.showMoreBtn} onClick={loadMore}>
          Zeige alles
        </button> */}
      </div>
    </div>
  );
};

export default Visits;
