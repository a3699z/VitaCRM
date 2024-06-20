import { Link, Head, useForm, usePage } from '@inertiajs/react';
import TextInput from '@/Components/TextInput';
import axios from 'axios';
import { useState } from 'react';
import Authenticated from '@/Layouts/AuthenticatedLayout';
import Navbar from '@/Components/Navbar';
import Banner from "@/Components/Home/Banner";
import About from "@/Components/Home/About";
import ChooseUs from "@/Components/Home/ChooseUs";
// import Reviews from "@/Components/Home/Reviews";
import ContactUs from "@/Components/Home/ContactUs";
import Footer from "@/Components/Footer";
import Stepper from "@/Components/Home/Stepper";


export default function Welcome({ auth, laravelVersion, phpVersion, employees }) {

    const { status } = usePage().props;

    console.log(status);
    const handleImageError = () => {
        document.getElementById('screenshot-container')?.classList.add('!hidden');
        document.getElementById('docs-card')?.classList.add('!row-span-1');
        document.getElementById('docs-card-content')?.classList.add('!flex-row');
        document.getElementById('background')?.classList.add('!hidden');
    };
    const { data, setData, get, errors, processing, recentlySuccessful } = useForm({
        search: '',
    });
    console.log(employees);
    const [employeess, setEmployees] = useState([]);

    // const searchEmployee = (search) => {
        // setData('search', '');
        // axios.get(`/employees/search?search= `).then((response) => {
        //     response.data.data.map((employee) => {
        //         console.log(employee);
        //     });
        //     setEmployees(response.data.data);
        //     console.log(response.data.data);
        //     employeess.map((employee) => {
        //         console.log(employee);
        //     });
        // });
    // }

    return (
        <>
            <Navbar user={auth.user} />

            <Banner employees={employees} />
            <Stepper />
            <About />
            <ChooseUs />
            {/* <Reviews /> */}
            <ContactUs />
            <Footer />


            {/* <div className="min-h-screen bg-gray-100">
                <Head title="Welcome" />
                <div className="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
                    <div className="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                        <div className="relative w-full max-w-2xl px-6 lg:max-w-7xl">


                            <main className="mt-6">
                                <div className="grid gap-6 lg:grid-cols-2 lg:gap-8">
                                    <input type="text" onChange={(e) => searchEmployee(e.target.value)} />
                                </div>
                                <div>
                                    {employees.map((employee) => (
                                        <Link key={employee.uid} href={route('employee.show', employee.uid)}>
                                            {employee.name}
                                        </Link>
                                    ))}
                                </div>
                            </main>

                            <footer className="py-16 text-center text-sm text-black dark:text-white/70">
                                Laravel v{laravelVersion} (PHP v{phpVersion})
                            </footer>
                        </div>
                    </div>
                </div>
            </div> */}
        </>
    );
}
