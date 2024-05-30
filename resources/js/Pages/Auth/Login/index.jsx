import { useEffect } from 'react';
// import Checkbox from '@/Components/Checkbox';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';
import { useParams } from 'react-router-dom';
import styles from "./style.module.css";
import FormGroup from "@/Components/FormGroup/index.jsx";
import Checkbox from "@/Components/Checkbox/index.jsx";
import logo from "@/Assets/Logo.png";
import heroImg from "@/Assets/Auth/heroImg.png";
import Navbar from '@/Components/Navbar';

export default function Login({ status, canResetPassword }) {
    const params = new URLSearchParams(window.location.search);
    const ref = params.get('ref');

    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
        ref: ref ? ref : ''
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route('login'));
    };

    return (

        <>
            <Navbar  user={false} />
            <Head title="Log in" />
            <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

                {status && <div className="mb-4 font-medium text-sm text-green-600">{status}</div>}


                <div className={styles.container}>
                    {/* left side start */}
                    <div>
                    <div className={styles.formContainer}>
                        <div className={styles.headContainer}>
                        <img src={logo} alt="logo" className={styles.logo} />
                        <div className={styles.titleContainer}>
                            <h3 className={styles.title}>Anmelden bei Ihrem Konto</h3>

                            <p className={styles.subTitle}>
                            Willkommen zurück! Bitte geben Sie Ihre details ein.
                            </p>
                        </div>
                        </div>

                        <form className={styles.form} onSubmit={submit}>
                        <FormGroup
                            id={"email"}
                            label={"E-mail*"}
                            name={"email"}
                            onChange={(e) => {
                                setData('email', e.target.value);
                            }}
                            placeholder={"Ihre E-Mail eingeben"}
                        />
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
                        <button type="submit" className={styles.submitBtn}>
                            Anmelden
                        </button>
                        <p className={styles.registerText}>
                            Sie haben noch kein Konto?{" "}
                            <Link to="/register" className={styles.link}>
                            Registieren
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
