import AdminLayout from '@/Layouts/AdminLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { useState, useEffect } from 'react';
import axios from 'axios';


export default function Reservations({ auth, reservations }) {
    console.log(reservations)

    const deleteReservation = (key) => {
        axios.post('/admin/reservation/delete', {key: key}).then((response) => {
            console.log(response.data)
        })
    }




    return (
        <AdminLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />
            <div>

                <thead>
                    <tr>
                        <th className="px-4 py-2">Patient</th>
                        <th className="px-4 py-2">Doctor</th>
                        <th className="px-4 py-2">Date</th>
                        <th className="px-4 py-2">Time</th>
                        <th className="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {reservations.map((reservation) => (
                        <tr key={reservation.key}>
                            {/* link to user info page */}
                            <td className="border px-4 py-2">
                                <Link href={`/admin/user/show/${reservation.patient.uid}`}>{reservation.patient.name}</Link>
                            </td>
                            <td className="border px-4 py-2">
                                <Link href={`/admin/user/show/${reservation.employee.uid}`}>{reservation.employee.name}</Link>
                            </td>
                            <td className="border px-4 py-2">{reservation.date}</td>
                            <td className="border px-4 py-2">{reservation.time}</td>
                            <td className="border px-4 py-2">
                                {/* delete button */}
                                <button onClick={(e) => {deleteReservation(reservation.key)}}>Delete</button>

                            </td>
                        </tr>
                    ))}
                </tbody>

            </div>
        </AdminLayout>
    );
}
