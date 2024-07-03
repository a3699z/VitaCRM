import React from "react";

import styles from "./style.module.css";
import { Link } from "@inertiajs/react";
import { useEffect, useRef } from "react";

const Card = ({ title, img, text, link, linkText, direction }) => {
    const imgRef = useRef(null);

    useEffect(() => {
        if (imgRef.current) {
            imgRef.current.addEventListener("load", () => {
                imgRef.current.style.transform = `translateX(0)`;
            });
        }
    }, []);

    return (
        <div className="flex md:flex-row flex-col justify-center items-center w-full bg-[#fafafa] md:p-0 p-4">
            {direction === "right" ? (
                <>
                    <div className="md:w-1/2 w-full md:py-0 py-4 md:px-8 px-4 grid gap-4">
                        <h4 className="text-[#ca9b31] text-2xl font-bold capitalize">
                            {title}
                        </h4>
                        <p className="text-gray-900 text-base font-normal leading-loose break-words">
                            {text}
                        </p>
                        <Link
                            className="text-[#ca9b31] leading-5 font-semibold text-sm no-underline "
                            href={link}
                        >
                            {linkText}
                        </Link>
                    </div>
                    <div className="flex md:w-1/2 w-full object-cover ">
                        <img
                            ref={imgRef}
                            src={img}
                            alt=""
                            className="w-full object-cover transition duration-1000 ease-in-out"
                            style={{
                                transform: `translateX(100%)`,
                            }}
                        />
                    </div>
                </>
            ) : (
                <>
                    <div className="flex md:w-1/2 w-full object-cover ">
                        <img
                            ref={imgRef}
                            src={img}
                            alt=""
                            className="w-full object-cover transition duration-1000 ease-in-out"
                            style={{
                                transform: `translateX(-100%
                                )`,
                            }}
                        />
                    </div>
                    <div className="md:w-1/2 w-full md:py-0 py-4 md:px-8 px-4 grid gap-4">
                        <h4 className="text-[#ca9b31] text-2xl font-bold capitalize">
                            {title}
                        </h4>
                        <p className="text-gray-900 text-base font-normal leading-loose break-words">
                            {text}
                        </p>
                        <Link
                            className="text-[#ca9b31] leading-5 font-semibold text-sm no-underline "
                            href={link}
                        >
                            {linkText}
                        </Link>
                    </div>
                </>
            )}
        </div>
    );
};

export default Card;