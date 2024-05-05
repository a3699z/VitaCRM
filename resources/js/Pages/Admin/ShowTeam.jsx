import AdminLayout from '@/Layouts/AdminLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { useState, useEffect } from 'react';
import axios from 'axios';


export default function ShowTeam({ auth, reservations, team, employees }) {

    const deleteReservation = (key) => {
        axios.post('/admin/reservation/delete', {key: key}).then((response) => {
            console.log(response.data)
        })
    }

    const deleteEmployee = (id) => () => {
        setData('id', id);
        post(route('admin.employee.delete'));
    }



    return (
        <AdminLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />
            <th>
                {team.name}
            </th>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">Employees</div>
                    </div>
                    <div className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <table className="table-auto w-full">
                            <thead>
                                <tr>
                                    <th className="px-4 py-2">Name</th>
                                    <th className="px-4 py-2">Email</th>
                                    <th className="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {employees.map((employee) => (
                                    <tr key={employee.uid}>
                                        <td className="border px-4 py-2">{employee.name}</td>
                                        <td className="border px-4 py-2">{employee.email}</td>
                                        <td className="border px-4 py-2">
                                            <Link href={route('admin.employee.edit', employee.uid)} className="text-blue-500 hover:text-blue-800">Edit</Link>
                                            <button onClick={deleteEmployee(employee.uid)} className="text-red-500 hover:text-red-800">Delete</button>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">Reservations</div>
                    </div>
                    <div className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
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
                </div>
            </div>
        </AdminLayout>
    );
}
