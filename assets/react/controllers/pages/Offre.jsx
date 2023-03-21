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
      .get("http://localhost:3200/prestations")
      .then((res) => setOffres(res.data));
  }, []);
  return (
    <Wrapper>
      <Header />
      <h1>Nos Offres</h1>
      {offres.map((prestation) => (
        <Prestation objet={prestation} />
      ))}
      <Footer />
    </Wrapper>
  );
};
const Wrapper = styled.div`
  position: relative;
  font-family: "font-1";
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
`;
export default Offre;
