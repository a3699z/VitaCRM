import React from "react";

import styles from "./style.module.css";
import bannerImg from "@/Assets/Home/banner/bannerImg.png";
import videoIcon from "@/Assets/Home/banner/video-square.svg";
import buildingsIcon from "@/Assets/Home/banner/buildings-alt.svg";
// import arrowDownIcon from "@/Assets/Home/banner/arrowDown.svg";
import SelectBox from "../../SelectBox";
import { Link } from "@inertiajs/react";
import Stepper from "../Stepper";
import { IoVideocamOutline } from "react-icons/io5";
import { TbBuildingBank } from "react-icons/tb";

const Banner = (employees) => {
    return (
        <div className="bg-[url('https://s3-alpha-sig.figma.com/img/4476/f375/3f8827b3f4cfb65b97adb9c22ac05c73?Expires=1720396800&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=oKYWg60xsKogCvU8J7ypZLWTC6aKqgVH5Qi0Up3ZpqEVOHfegaUW2jDG0jikSX~Vj~DVo-B1NVhDTdqHTqovgiPHRSHymlPdEiU6Fo7T1LAfpp8W6XDwLwIh~m-GvLYxxM60IaBfoRyj-q0LWGBLhfOuGZyWtNglUshxjfnCqoXFZ5CNDYaHlTi3ukXnAw~6peFDAUkowyYUQyiVXy060Z7wh~trqVOGp6xqDdeh4M~EX2q1iQvkIaAdRTNBwMn3KiEMizznAnhx6JWIA-A5DkF6IsQM~9fwz7W2oV9MKpSd891xixhoCRuSSvO~oVHytqM64kfz~gxzjMsgXcfCew__')]  bg-center bg-cover bg-no-repeat w-full h-screen  relative flex  md:flex-col flex-row justify-center items-center bg-gray-900/50">
            <div className="absolute inset-0 bg-gray-900/50 pointer-events-none"></div>
            <div className="absolute flex flex-col justify-center items-center">
                <h3 className="text-white font-bold text-2xl leading-10 tracking-tight  sm:text-3xl sm:leading-none sm:tracking-tighter mt-2 mb-4 sm:mb-8">
                    {/* ARZT FINDEN LEICHT */}
                    Videoberatung Deutschlandweit

                </h3>
                <h2 className="text-center text-white font-extrabold text-4xl sm:leading-[67px] tracking-tight  sm:text-6xl leading-none sm:tracking-tighter mb-4 sm:mb-8">
                Buchen Sie jetzt einen 
                    <br />
                    <span className="flex justify-center items-center mt-2">
                    Pflegeberatungstermin via Videokonferenz

                    </span>
                 
                </h2>

                {/* <p className="text-white text-base sm:text-lg font-normal leading-7 tracking-tight text-center px-2 sm:px-0">
                    Gesundheit ist eines der wichtigsten Dinge für uns, da für
                    sofort überprüfen Sie Ihre Gesundheit für Sie
                </p> */}

                <div className="mt-12 flex flex-col md:flex-row gap-4">
                    <button className="flex items-center gap-2 bg-[#ca9b31] hover:bg-[#f9f8f2] hover:border hover:border-[#ca9b31] hover:text-[#ca9b31]  text-white font-medium text-lg px-4 py-3 rounded-xl shadow-md   transition duration-150 ease-in-out">
                        {/* <img src={videoIcon} alt="" /> */}
                        <IoVideocamOutline />
                        Videosprechstunde
                    </button>

                    <button className="flex items-center gap-2 bg-[#ca9b31] hover:bg-[#f9f8f2] hover:border hover:border-[#ca9b31] hover:text-[#ca9b31]  text-white font-medium text-lg px-4 py-3 rounded-xl shadow-md   transition duration-150 ease-in-out">
                        {/* <img src={videoIcon} alt="" /> */}
                        {/* <img src={buildingsIcon} alt="" /> */}
                        <TbBuildingBank />
                        Vor-Ort-Termin
                    </button>
                </div>

                <SelectBox employees={employees} />
            </div>
            {/* <div className={styles.leftSide}>
                <img src={bannerImg} alt="" className={styles.bannerImg} />
            </div> */}
            <div className="absolute lg:-bottom-40 md:-bottom-52 -bottom-[460px] w-full px-12 ">
                <Stepper />
            </div>
        </div>
    );
};

export default Banner;
