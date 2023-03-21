import React from "react";
import styled from "styled-components";
import breakpoints from "../commons/breakpoints";

const Card = (props) => {
  const photo = props.photo;
  return (
    <Wrapper>
      {photo.type === "portrait" ? (
        <img className="portrait" src={photo.source} alt={photo.title} />
      ) : (
        <img className="paysage" src={photo.source} alt={photo.title} />
      )}
      <h3>{photo.title}</h3>
    </Wrapper>
  );
};

const Wrapper = styled.div`
  height: 20vw;
  width: 20vw;
  background: black;
  margin: 10px;
  box-shadow: 0px 1px 15px 0px white;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  h3 {
    opacity: 0;
    position: absolute;
    transition: 1s;
  }

  &:hover {
    h3 {
      opacity: 1;
      transition: 0.5s;
      transition-delay: 0.5s;
      background: rgba(0, 0, 0, 0.4);
      padding: 10px;
    }
  }
  .portrait {
    width: 100%;
  }
  .paysage {
    height: 100%;
  }
  &:hover {
    box-shadow: 0px 1px 4px 6px white;
  }
  img {
    transition: 1s;
    &:hover {
      transition: 0.8s ease;
      transform: scale(1.09);
    }
  }
  @media only screen and ${breakpoints.sm} {
    width: 28vw;
    height: 28vw;
  }
  @media only screen and ${breakpoints.xs} {
    width: 80vw;
    height: 80vw;
  }
`;
export default Card;
