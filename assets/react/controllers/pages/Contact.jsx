import React from "react";
import styled from "styled-components";
import Footer from "../components/Footer";
import Formulaire from "../components/Formulaire";
import Header from "../components/Header";

const Contact = () => {
  return (
    <Wrapper>
      <Header />
      <Main>
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
  p {
    font-size: 1rem;
    margin: 20px;
    width: 80%;
  }
`;
const Main= styled.main`
  display: flex;
  flex-direction: column;
  align-items: center;
  flex:1;
  height: auto;
  h3{
    font-size: 1.4rem;
  };
  
`;
export default Contact;
