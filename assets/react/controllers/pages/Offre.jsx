import React, { useEffect, useState } from "react";
import styled from "styled-components";
import Header from "../components/Header";
import Prestation from "../components/Prestation";
import axios from "axios";
import Footer from "../components/Footer";
const Offre = () => {
  const [offres, setOffres] = useState([]);
  useEffect(() => {
    axios
      .get("/getOffres")
      .then((res) => setOffres(res.data.data));
  }, []);
  return (
    <Wrapper>
      <Header />
      <Main>
        <h1>Nos Offres</h1>
        {offres.map((prestation) => (
          <Prestation objet={prestation} />
        ))}
      </Main>
      <Footer />
    </Wrapper>
  );
};
const Wrapper = styled.div`
  position: relative;
  text-align: center;
  display: flex;
  flex-direction:column;
  justify-content:space-between;
  min-height: 100vh;
`;
const Main= styled.main`
  display: flex;
  flex-direction: column;
  align-items: center;
  height: auto;
  flex:1;
`;
export default Offre;
