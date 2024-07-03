import { useEffect, useState, useRef } from "react";
import InputError from "@/Components/InputError";
import { Head, Link, useForm } from "@inertiajs/react";
import styles from "./style.module.css";
import FormGroup from "@/Components/FormGroup/index.jsx";
import logo from "@/Assets/Logo.png";
import heroImg from "@/Assets/Auth/heroImg.png";
import Navbar from "@/Components/Navbar";
import { IoClose } from "react-icons/io5";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";

export default function Login({ status, canResetPassword }) {
    const params = new URLSearchParams(window.location.search);
    const ref = params.get("ref");

    const { data, setData, post, processing, errors, reset } = useForm({
        email: "",
        password: "",
        remember: false,
        ref: ref ? ref : "",
        checked: true,
    });

    const [showPassword, setShowPassword] = useState(false);

    const [showModal, setShowModal] = useState(false);
    const [modalContent, setModalContent] = useState(null);

    const modalRef = useRef(null);

    useEffect(() => {
        return () => {
            reset("password");
        };
    }, []);

    const togglePasswordVisibility = () => {
        setShowPassword((prevState) => !prevState);
    };

    const submit = (e) => {
        e.preventDefault();

        // on errors
        post(route("login"), {
            preserveScroll: true,
            onError: (errors) => {
                console.log(errors);
            },
            onSuccess: () => {
                console.log("success");
            },
        });
    };

    const submitPassword = (e) => {
        e.preventDefault();

        post(route("password.email"));
    };

    useEffect(() => {
        if (showModal && modalRef.current) {
            modalRef.current.style.overflowY = "auto";
        } else {
            if (modalRef.current) {
                modalRef.current.style.overflowY = "hidden";
            }
        }
    }, [showModal, modalRef.current]);



    const showForgotPasswordModal = () => {
        setShowModal(true);

        setModalContent(
            <>
                <div>
                    <IoClose
                        className="flex float-end cursor-pointer h-6 w-6 text-[#ca9b31] "
                        onClick={() => setShowModal(false)}
                    />
                </div>

                <div className="flex flex-col justify-center items-center h-full p-8">
                    <div className="">
                        <div className="mb-4 text-sm text-gray-600">
                            Forgot your password? No problem. Just let us know
                            your email address and we will email you a password
                            reset link that will allow you to choose a new one.
                        </div>

                        {status && (
                            <div className="mb-4 font-medium text-sm text-green-600">
                                {status}
                            </div>
                        )}

                        <form onSubmit={submitPassword}>
                            <TextInput
                                id="email"
                                type="email"
                                name="email"
                                value={data.email}
                                className="mt-1 block w-full"
                                isFocused={true}
                                onChange={(e) =>
                                    setData("email", e.target.value)
                                }

                            />

                            <InputError
                                message={errors.email}
                                className="mt-2"
                            />

                            <div className="flex items-center justify-center mt-6">
                                <PrimaryButton

                                    disabled={processing}
                                >
                                    Email Password Reset Link
                                </PrimaryButton >
                            </div>
                        </form>
                    </div>
                </div>
            </>
        );
    };

    return (
        <>
            <Navbar user={false} />
            <Head title="Log in" />
            <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                {status && (
                    <div className="mb-4 font-medium text-sm text-green-600">
                        {status}
                    </div>
                )}

                <div className={styles.container}>
                    {/* left side start */}
                    <div>
                        <div className={styles.formContainer}>
                            <div className={styles.headContainer}>
                                <img
                                    src={logo}
                                    alt="logo"
                                    className={styles.logo}
                                />
                                <div className={styles.titleContainer}>
                                    <h3 className={styles.title}>
                                        Anmelden bei Ihrem Konto
                                    </h3>

                                    <p className={styles.subTitle}>
                                        Willkommen zurück! Bitte geben Sie Ihre
                                        details ein.
                                    </p>
                                </div>
                            </div>

                            <form className={styles.form} onSubmit={submit}>
                                <div className={styles.formGroup}>
                                    <label
                                        htmlFor="email"
                                        className={styles.label}
                                    >
                                        E-mail*
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        className={styles.input}
                                        placeholder="Ihre E-Mail eingeben"
                                        onChange={(e) =>
                                            setData("email", e.target.value)
                                        }
                                    />
                                </div>
                                <InputError message={errors.email} />

                                <div className={styles.formGroup}>
                                    <label
                                        htmlFor="password"
                                        className={styles.label}
                                    >
                                        Passwort*
                                    </label>
                                    <div className={styles.passwordContainer}>
                                        <input
                                            type={
                                                showPassword
                                                    ? "text"
                                                    : "password"
                                            }
                                            name="password"
                                            id="password"
                                            className={styles.input}
                                            placeholder="••••••••"
                                            onChange={(e) =>
                                                setData(
                                                    "password",
                                                    e.target.value
                                                )
                                            }
                                        />
                                        <span
                                            className={styles.passwordToggle}
                                            onClick={() =>
                                                setShowPassword(!showPassword)
                                            }
                                        >
                                            {showPassword ? "🙈" : "👁️"}
                                        </span>
                                    </div>
                                    <span className={styles.info}>
                                        Muss mindestens 8 Zeichen haben.
                                    </span>
                                </div>
                                <InputError message={errors.password} />
{/* 
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
                                        <input
                                            type="checkbox"
                                            name="a"
                                            id="a"
                                            className={styles.ckeckboxInput}
                                            onChange={(e) => {
                                                setData(
                                                    "checked",
                                                    e.target.checked
                                                );
                                            }}
                                        />
                                        <span></span>
                                        <div
                                            onClick={(e) => {
                                                e.preventDefault();
                                            }}
                                        >
                                            Ich habe die{" "}
                                            <div className=" flex md:flex-row flex-col   gap-1">
                                                <span
                                                    style={{
                                                        color: "rgba(212, 170, 44, 1)",
                                                    }}
                                                    className="cursor-pointer"
                                                    onClick={showModalOne}
                                                >
                                                    Nutzungsbedingungen,
                                                </span>{" "}
                                                <span
                                                    style={{
                                                        color: "rgba(212, 170, 44, 1)",
                                                    }}
                                                    className="cursor-pointer"
                                                    onClick={showModalTwo}
                                                >
                                                    Geschäftsbedingungen,
                                                </span>{" "}
                                                <span
                                                    style={{
                                                        color: "rgba(212, 170, 44, 1)",
                                                    }}
                                                    className="cursor-pointer"
                                                    onClick={showModalThree}
                                                >
                                                    Datenschutzerklärung
                                                </span>{" "}
                                            </div>
                                            gelesen und bin mit ihnen
                                            einverstanden.
                                        </div>
                                    </label>
                                    <InputError
                                        message={errors.checked}
                                        className="mt-2"
                                    />
                                </div> */}
                                <button
                                    type="submit"
                                    className={styles.submitBtn}
                                >
                                    Anmelden
                                </button>
                                <p className={styles.registerText}>
                                    Sie haben noch kein Konto?{" "}
                                    <Link
                                        href="/register"
                                        className={styles.link}
                                    >
                                        Registieren
                                    </Link>
                                </p>
                                <p
                                 style={{
                                    color: "rgba(212, 170, 44, 1)",
                                }}
                                    className={`${styles.forgetPasswordText} flex justify-center cursor-pointer text-sm `}
                                    onClick={showForgotPasswordModal}
                                >
                                    Passwort vergessen?
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

                {showModal && (
                    <div className="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
                        <div
                            ref={modalRef}
                            className="bg-white rounded-lg shadow-2xl p-8 w-11/12 md:w-4/12 h-[400px] md:h-[300px] max-h-screen overflow-y-auto"
                        >
                            {modalContent}
                        </div>
                    </div>
                )}
            </div>
        </>
    );
}
