import React from "react";
import styled from "styled-components";

const Footer = () => {
  return (
    <Wrapper>
      <span>Facebook</span>
      <span>instagram</span>
      <span>@Copyright Megios Dev</span>
    </Wrapper>
  );
};
const Wrapper = styled.div`
  position: absolute;
  display: flex;
  flex-direction: column;
  background: black;
  width: 100%;
  bottom: -120px;
  height: 80px;
  padding-top: 20px;
  padding-bottom: 20px;
  text-align: center;
  span {
    color: white;
  }
`;

export default Footer;
