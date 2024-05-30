import { useEffect } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';
import styles from "./style.module.css";
import logo from "@/Assets/Logo.png";
import heroImg from "@/Assets/Auth/heroImg.png";
import FormGroup from "@/Components/FormGroup";
import Checkbox from "@/Components/Checkbox";
import Navbar from "@/Components/Navbar";


export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        username: '',
        name: '',
        email: '',
        password: '',
        checked: false,
        // password_confirmation: '',
    });

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();
        // console.log(data);

        post(route('register'));
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
                        <img src={logo} alt="logo" className={styles.logo} />
                        <h3 className={styles.title}>Registieren</h3>
                        </div>

                        <form className={styles.form} onSubmit={submit}>
                        <FormGroup
                            id={"username"}
                            label={"Benutzername*"}
                            name={"username"}
                            onChange={(e) => {
                                setData('username', e.target.value);
                            }}
                            placeholder={"username"}

                        />
                        <InputError message={errors.username} className="mt-2" />
                        <FormGroup
                            id={"name"}
                            label={"Name*"}
                            name={"name"}
                            onChange={(e) => {
                                setData('name', e.target.value);
                            }}
                            placeholder={"Ihre name eingeben"}
                        />
                            <InputError message={errors.name} className="mt-2" />
                        <FormGroup
                            id={"email"}
                            label={"E-mail*"}
                            name={"email"}
                            onChange={(e) => {
                                setData('email', e.target.value);
                            }}
                            placeholder={"Ihre E-Mail eingeben"}
                        />
                            <InputError message={errors.email} className="mt-2" />
                        <FormGroup
                            id={"password"}
                            label={"Passwort*"}
                            name={"password"}
                            onChange={(e) => {
                                setData('password', e.target.value);
                            }}
                            placeholder={"••••••••"}
                            type={"password"}
                            info={"Muss mindestens 8 Zeichen haben."}
                        />
                            <InputError message={errors.password} className="mt-2" />

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
                                    <input type="checkbox" name="a" id="a" className={styles.input} onChange={(e) => {setData('checked', e.target.checked)}} />
                                    <span></span>
                                    <div
                                    onClick={(e) => {
                                        e.preventDefault();
                                    }}
                                    >
                                    Ich habe die{" "}
                                    <span style={{ color: "rgba(212, 170, 44, 1)" }}>
                                        Nutzungsbedingungen
                                    </span>{" "}
                                    gelesen und bin mit ihnen einverstanden.
                                    </div>
                                </label>
                                <InputError message={errors.checked} className="mt-2" />
                            </div>
                        <button type="submit" className={styles.submitBtn} >
                            Los Gehts!
                        </button>
                        <p className={styles.registerText}>
                            Haben Sie schon ein Konto?{" "}
                            <Link to="/login" className={styles.link}>
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
            </div>
        </>
    );
}
