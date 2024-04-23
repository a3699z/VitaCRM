// use adminlayout
import AdminLayout from '../../Layouts/AdminLayout';
import { useEffect, useState } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Employees({ auth, employees }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        id: '',
    });


    const deleteEmployee = (id) => () => {
        setData('id', id);
        post(route('admin.employee.delete'));
    }
    return (
        <AdminLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Employees</h2>}
        >
            <Head title="Employees" />
            {/* button for create employee */}
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link href={route('admin.employee.create')} className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create Employee</Link>
            </div>

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
                                    <tr key={employee.id}>
                                        <td className="border px-4 py-2">{employee.name}</td>
                                        <td className="border px-4 py-2">{employee.email}</td>
                                        <td className="border px-4 py-2">
                                            <Link href={route('admin.employee.edit', employee.id)} className="text-blue-500 hover:text-blue-800">Edit</Link>
                                            <button onClick={deleteEmployee(employee.id)} className="text-red-500 hover:text-red-800">Delete</button>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
