// use adminlayout
import AdminLayout from '../../Layouts/AdminLayout';
import { useEffect, useState } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';

export default function ShowUser({ auth, user }) {
    const { data, setData, post, processing, errors, reset } = useForm({
    });

    useEffect(() => {
        return () => {
            // reset('password', 'password_confirmation');
        };
    }, []);

    return (
        <AdminLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Show User</h2>}
        >
            <Head title="User Info" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">User Info</div>
                    </div>
                    {/* blocks for into */}
                    <div className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div className="mb-4">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="name">
                                Name
                            </label>
                            <input
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name"
                                type="text"
                                placeholder="Name"
                                value={user.name}
                                readOnly
                            />
                        </div>
                        {/* middle name */}
                        <div className="mb-4">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="middle_name">
                                Middle Name
                            </label>
                            <input
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="middle_name"
                                type="text"
                                placeholder="Middle Name"
                                value={user.middle_name}
                                readOnly
                            />
                        </div>
                        {/* surname */}
                        <div className="mb-4">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="surname">
                                Surname
                            </label>
                            <input
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="surname"
                                type="text"
                                placeholder="Surname"
                                value={user.surname}
                                readOnly
                            />
                        </div>
                        <div className="mb-6">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="email">
                                Email
                            </label>
                            <input
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="email"
                                type="text"
                                placeholder="Email"
                                value={user.email}
                                readOnly
                            />
                        </div>
                        <div className="mb-6">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="user_type">
                                User Type
                            </label>
                            <input
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="user_type"
                                type="text"
                                placeholder="User Type"
                                value={user.user_type}
                                readOnly
                            />
                        </div>
                        {/* place_of_residence */}
                        <div className="mb-6">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="place_of_residence">
                                Place of Residence
                            </label>
                            <input
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="place_of_residence"
                                type="text"
                                placeholder="Place of Residence"
                                value={user.place_residence}
                                readOnly
                            />
                        </div>
                        {/* phone_number */}
                        <div className="mb-6">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="phone_number">
                                Mobile
                            </label>
                            <input
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="mobile"
                                type="text"
                                placeholder="Mobile"
                                value={user.mobile}
                                readOnly
                            />
                        </div>
                        {/* telephone */}
                        <div className="mb-6">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="telephone">
                                Telephone
                            </label>
                            <input
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="telephone"
                                type="text"
                                placeholder="Telephone"
                                value={user.telephone}
                                readOnly
                            />
                        </div>

                        {/* date_of_birth */}
                        <div className="mb-6">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="date_of_birth">
                                Date of Birth
                            </label>
                            <input
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="date_of_birth"
                                type="text"
                                placeholder="Date of Birth"
                                value={user.date_of_birth}
                                readOnly
                            />
                        </div>
                        {user.user_type == 'employee' &&
                            <div>
                                {/* team */}

                                {user.team &&
                                    <div className="mb-4">
                                        <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="team">
                                            Team
                                        </label>
                                        <input
                                            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="team"
                                            type="text"
                                            placeholder="Team"
                                            value={user.team.name}
                                            readOnly
                                        />
                                    </div>
                                }
                                {/* training */}
                                <div className="mb-4">
                                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="training">
                                        Training
                                    </label>
                                    <input
                                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="training"
                                        type="text"
                                        placeholder="Training"
                                        value={user.training_profession}
                                        readOnly
                                    />
                                </div>
                                {/* completion date */}
                                <div className="mb-4">
                                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="completion_date">
                                        Completion Date
                                    </label>
                                    <input
                                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="completion_date"
                                        type="text"
                                        placeholder="Completion Date"
                                        value={user.training_completion_date}
                                        readOnly
                                    />
                                </div>
                                {/* organization */}
                                <div className="mb-4">
                                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="organization">
                                        Organization
                                    </label>
                                    <input
                                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="organization"
                                        type="text"
                                        placeholder="Organization"
                                        value={user.organization}
                                        readOnly
                                    />
                                </div>
                                {/*  lifetime_employee_number */}
                                <div className="mb-4">
                                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="lifetime_employee_number">
                                        Lifetime Employee Number
                                    </label>
                                    <input
                                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="lifetime_employee_number"
                                        type="text"
                                        placeholder="Lifetime Employee Number"
                                        value={user.lifetime_employee_number}
                                        readOnly
                                    />
                                </div>
                            </div>
                        }
                        {user.user_type == 'patient' &&
                            <div>
                                {/* level_of_care */}
                                <div className="mb-4">
                                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="level_of_care">
                                        Level of Care
                                    </label>
                                    <input
                                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="level_of_care"
                                        type="text"
                                        placeholder="Level of Care"
                                        value={user.level_of_care}
                                        readOnly
                                    />
                                </div>
                                {/* legal guardian */}
                                <div className="mb-4">
                                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="legal_guardian">
                                        Legal Guardian
                                    </label>
                                    <input
                                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="legal_guardian"
                                        type="text"
                                        placeholder="Legal Guardian"
                                        value={user.legal_guardian}
                                        readOnly
                                    />
                                </div>
                                {/* health insurance */}
                                <div className="mb-4">
                                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="health_insurance">
                                        Health Insurance
                                    </label>
                                    <input
                                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="health_insurance"
                                        type="text"
                                        placeholder="Health Insurance"
                                        value={user.health_insurance}
                                        readOnly
                                    />
                                </div>
                            </div>
                        }
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
    }
