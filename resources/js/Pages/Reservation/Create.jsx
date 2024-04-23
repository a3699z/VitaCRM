import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { useState, useEffect } from 'react';
import axios from 'axios';


export default function Create({ auth}) {
    const [data, setData] = useState();
    const [name, setName] = useState();
    const [id, setId] = useState();
    const [date, setDate] = useState();
    const [hour, setHour] = useState();
    useEffect(() => {
        axios.get('/reservation/session').then((response) => {
            console.log(response.data)
            setData(response.data)
            setName(response.data.employee.name)
            setId(response.data.employee.id)
            setDate(response.data.date)
            setHour(response.data.time)
            console.log(data)
        })
    }, []);
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />
            <div>
                {name}
                {date}
                {hour}
            </div>
        </AuthenticatedLayout>
        );
}
