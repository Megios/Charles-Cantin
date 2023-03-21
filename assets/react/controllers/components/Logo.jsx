import React from "react";
import styled from "styled-components";

const Logo = () => {
  return (
    <Wrapper>
      <img src="./img/logo.png" alt="logo" />
    </Wrapper>
  );
};

const Wrapper = styled.div`
  border-radius: 50%;

  img {
    box-shadow: 0px 1px 15px 0px white;
    border-radius: 50%;
    width: 8vw;
  }
`;
export default Logo;
