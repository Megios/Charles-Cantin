import React from "react";
import styled from "styled-components";
import Navigation from "../components/Navigation";
import img from "../assets/images/backgroundAccueil.jpg";
import Footer from "../components/Footer";

const Home = () => {
  return (
    <div>
      <Accueil>
        <HeaderA>
          <Navigation />
        </HeaderA>
        <h1>Charles Cantin - photographe</h1>
      </Accueil>
      <Footer />
    </div>
  );
};
const HeaderA = styled.div`
  display: flex;
  position: absolute;
  top: 0;
  flex-direction: column;
  align-items: center;
  background: transparent;
  width: 100vw;
`;
const Accueil = styled.div`
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 100vh;
  background: center/cover url(${img});
  align-items: center;
  overflow: hidden;
  h1 {
    font-size: 3vw;
  }
`;

export default Home;
