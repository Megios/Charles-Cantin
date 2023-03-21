import React from "react";
import styled from "styled-components";
import Footer from "../components/Footer";
import Formulaire from "../components/Formulaire";
import Header from "../components/Header";

const Contact = () => {
  return (
    <Wrapper>
      <Header />
      <h3>A propos de votre photographe</h3>
      <p>
        Deserunt minim ex aliqua consequat id non fugiat qui est tempor nostrud.
        Velit fugiat voluptate nostrud adipisicing ipsum velit esse fugiat. Eu
        do et irure mollit velit enim dolore id. Magna duis elit ex laboris
        eiusmod. Aliquip aute adipisicing id occaecat ex cillum nisi irure
        ullamco dolore. Tempor anim consequat elit id ipsum dolore minim minim
        ullamco exercitation. Deserunt minim ex aliqua consequat id non fugiat
        qui est tempor nostrud. Velit fugiat voluptate nostrud adipisicing ipsum
        velit esse fugiat. Eu do et irure mollit velit enim dolore id. Magna
        duis elit ex laboris eiusmod. Aliquip aute adipisicing id occaecat ex
        cillum nisi irure ullamco dolore. Tempor anim consequat elit id ipsum
        dolore minim minim ullamco exercitation.
      </p>
      <Formulaire />
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
  p {
    font-size: 1.4rem;
    margin: 20px;
    width: 80%;
  }
`;
export default Contact;
