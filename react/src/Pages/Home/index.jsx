import React from "react";
import Navbar from "../../Components/Navbar";
import Banner from "../../Components/Home/Banner";
import About from "../../Components/Home/About";
import ChooseUs from "../../Components/Home/ChooseUs";
import Reviews from "../../Components/Home/Reviews";
import ContactUs from "../../Components/Home/ContactUs";
import Footer from "../../Components/Footer";
import Stepper from "../../Components/Home/Stepper";

const Home = () => {
  return (
    <div>
      <Navbar />
      <Banner />
      <Stepper />
      <About />
      <ChooseUs />
      <Reviews />
      <ContactUs />
      <Footer />
    </div>
  );
};

export default Home;
