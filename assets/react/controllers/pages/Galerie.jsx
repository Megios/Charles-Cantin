import React, { useEffect, useState } from "react";
import Header from "../components/Header";
import styled from "styled-components";
import Card from "../components/Card";
import axios from "axios";
import Footer from "../components/Footer";

const Galerie = () => {
  const [data, setData] = useState([]);
  const [selectedCat, setSelectedCat] = useState();
  const [categories, setCategories]= useState([]);
  // [
  //   "Grossesse",
  //   "Mariage",
  //   "Bébé",
  //   "Famille",
  //   "Baptême",
  //   "CouplePortrait",
  // ];
  useEffect(() => {
    axios.get("/getPhotos").then((res) => {setData(res.data.data);setCategories(res.data.categories)});
  }, []);

  return (
    <Wrapper>
      <Header />
      <Main>
        <NavTri>
          {categories.map((categorie) => (
            <li key={Math.random()}>
              <input
                type="radio"
                id={categorie}
                name="categoriesRadio"
                checked={categorie === selectedCat}
                onChange={(e) => setSelectedCat(e.target.id)}
              />
              <label htmlFor={categorie}>{categorie}</label>
            </li>
          ))}
        </NavTri>
        {selectedCat && (
          <button onClick={() => setSelectedCat()}>Annuler le filtre</button>
        )}
        <WrapperCard>
          {selectedCat
            ? data
                .filter((photo) => photo.categories.includes(selectedCat))
                .map((photo) => <Card key={Math.random()} photo={photo} />)
            : data.map((photo) => <Card key={Math.random()} photo={photo} />)}
        </WrapperCard>
      </Main>
      <Footer />
    </Wrapper>
  );
};
const WrapperCard = styled.ul`
  margin: 0;
  padding: 20px 10px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
`;
const Wrapper = styled.div`
  position: relative;
  text-align: center;
  display: flex;
  flex-direction:column;
  justify-content:space-between;
  min-height: 100vh;
  button {
    background: transparent;
    color: white;
    box-sizing: border-box;
    border: 2px solid white;
    padding: 15px;
    box-shadow: 1px 3px 10px 3px black;
    margin: 15px;

    &:hover {
      box-shadow: 1px 3px 10px 5px black;
    }
    &:active {
      box-shadow: inset 1px 3px 10px 3px black;
    }
    @media screen and (max-width: 796px){
      margin: 5px;
      padding: 1.5%;
    }
  }
`;
const NavTri = styled.ul`
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  li {
    display: flex;
    align-items: center;
    list-style-type: none;
    font-size: 1.6rem;
    padding: 0 10px;
    &:hover {
      color: black;
    }
    @media screen and (max-width:796px){
      font-size: 0.8rem;
    }
  }
  label {
    &:hover {
      cursor: pointer;
    }
  }
`;
const Main= styled.main`
  display: flex;
  flex-direction: column;
  align-items: center;
  height: auto;
  flex:1;
`;
export default Galerie;
