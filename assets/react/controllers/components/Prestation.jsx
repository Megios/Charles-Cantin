import React from "react";
import styled from "styled-components";

const Prestation = ({ objet }) => {
  return (
    <Wrapper>
      <h3>{objet.title}</h3>
      <p>{objet.content}</p>
      <p className="Price">{objet.tarif}</p>
    </Wrapper>
  );
};

const Wrapper = styled.div`
  background-color: rgba(255, 255, 255, 0.7);
  width: 60vw;
  margin: 10px;
  padding: 10px;
  border-radius: 30px;
  h3 {
    font-size: 1.6rem;
    color: black;
    margin: 15px;
  }
  p {
    margin: 5px;
    color: #152028;
  }
  .Price {
    color: red;
    margin-bot: 5px;
    font-size: 1.2rem;
  }
`;
export default Prestation;
