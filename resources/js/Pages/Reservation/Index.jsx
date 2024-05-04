import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { useState, useEffect } from 'react';
import axios from 'axios';


export default function Index({ auth, reservations }) {
    console.log(reservations)

    const accept = (key) => {
        axios.post('/reservation/accept', {key: key}).then((response) => {
            console.log(response.data)
        })
    }

    const decline = (key) => {
        axios.post('/reservation/decline', {key: key}).then((response) => {
            console.log(response.data)
        })
    }




    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />
            <div>

                <thead>
                    <tr>
                        {auth.user.user_type === 'employee' ? <th className="px-4 py-2">Patient</th> : <th className="px-4 py-2">Doctor</th>}
                        <th className="px-4 py-2">Date</th>
                        <th className="px-4 py-2">Time</th>
                        {auth.user.user_type === 'employee' ? <th className="px-4 py-2">Action</th> : <th className="px-4 py-2">Status</th>}
                    </tr>
                </thead>
                <tbody>
                    {reservations.map((reservation) => (
                        <tr key={reservation.key}>
                            {auth.user.user_type === 'employee' ? <td className="border px-4 py-2">{reservation.reservation_with.name}</td> : <td className="border px-4 py-2">{reservation.reservation_with.name}</td>}
                            <td className="border px-4 py-2">{reservation.date}</td>
                            <td className="border px-4 py-2">{reservation.time}</td>
                            {auth.user.user_type === 'employee' ?  <td className="border px-4 py-2">
                                    {/* accept and decline button */}
                                    <button onClick={(e) => {accept(reservation.key)}}>Accept</button>
                                    <button onClick={(e) => {decline(reservation.key)}}>Decline</button>
                                </td> :
                                <td className="border px-4 py-2">{reservation.status}</td>
                            }

                        </tr>
                    ))}
                </tbody>

            </div>
        </AuthenticatedLayout>
    );
}
