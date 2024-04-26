import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { useState, useEffect } from 'react';
import axios from 'axios';


export default function Create({ auth}) {

    const [name, setName] = useState();
    const [uid, setUid] = useState();
    const [date, setDate] = useState();
    const [hour, setHour] = useState();
    useEffect(() => {
        axios.get('/reservation/session').then((response) => {
            console.log(response.data.employee.uid)
            setName(response.data.employee.name)
            setUid(response.data.employee.uid)
            setDate(response.data.date)
            setHour(response.data.time)
            // if (response.data.employee.uid) {
            //     setData('employee_uid', response.data.employee.uid)
            // }
            // if (response.data.date) {
            //     setData('date', response.data.date)
            // }
            // if (response.data.time) {
            //     setData('hour', response.data.time)
            // }
            console.log(data)
        })
    }, []);
    const { data, setData, post, processing, errors, reset } = useForm({
        insurance_type: 'legal',
        insurance_policy_number: '',
        // employee_uid: '',
        // date: '',
        // hour: ''
    });
    const submit = (e) => {
        e.preventDefault();

        post(route('reservation.store'));
    }
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
            <form method="post" onSubmit={(e) => {submit(e)}}>
                <div>
                    <label htmlFor="insurance_type">Insurance Type</label>
                    <select name="insurance_type" id="insurance_type" onChange={(e) => setData('insurance_type', e.target.value)}>
                        <option value="legal">Legal Insurance</option>
                        <option value="private">Private Insurance</option>
                    </select>
                </div>
                <div>
                    <label htmlFor="insurance_policy_number">Insurance Policy Number</label>
                    <input type="text" name="insurance_policy_number" id="insurance_policy_number" onChange={(e) => setData('insurance_policy_number', e.target.value)} />
                </div>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </AuthenticatedLayout>
        );
}
