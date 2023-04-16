import React, { useState } from "react";
import styled from "styled-components";

const Toast = (props) => {
  const [conteur, setConteur] = useState(true);
  const fermetureToast = (e) => {
    e.preventDefault();
    setConteur(false);
    props.action(false);
  };
  return (
    <Wrapper className={conteur ? "test" : "test2"}>
      <span>{props.message}</span>
      <button onClick={fermetureToast}>X</button>
    </Wrapper>
  );
};

const Wrapper = styled.div`
  position: absolute;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 50%;
  background: #3a3a3a;
  border-radius: 10px;
  box-shadow: 0px 1px 4px 6px black;
  left: 25%;
  bottom: 20%;
  align-items:center;
  @media screen and (min-width: 796px){
    width: 30%;
    left: 35%;
  }
  &.test2 {
    display: none;
  }
  span {
    color: white;
    margin: 10px;
  }
  button {
    box-shadow: 1px 3px 15px 3px black;
    &:active {
      box-shadow: inset 1px 3px 10px 3px black;
    }
    &:hover {
      box-shadow: 1px 3px 10px 5px black;
    }
  }
  
`;

export default Toast;
