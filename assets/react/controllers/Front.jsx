import React from "react";
import * as ReactDOM from "react-dom";
import * as ReactDOMClient from 'react-dom/client';
import {
  createBrowserRouter,
  RouterProvider,
} from "react-router-dom";
import Galerie from "./pages/Galerie";
import Home from "./pages/Home";
import Offre from "./pages/Offre";
import { createGlobalStyle } from "styled-components";
import NovaMono from "./assets/fonts/NovaMono.ttf";
import Contact from "./pages/Contact";
import img from "./assets/images/photobackgroundfix.png";
const Front = (props ) => {
  const router= createBrowserRouter([ 
    {
      path: "/",
      element: <Home />
    },
    {
      path:"/galerie",
      element: <Galerie/>
    }
    ,
    {
      path:"/offres",
      element: <Offre/>
    }
    ,
    {
      path:"/contact",
      element: <Contact/>
    }
  ])
  props.rooty.render((
    <>
    <GlobalStyle/>
    <RouterProvider router={router} />
    </>
  ));
};

const GlobalStyle = createGlobalStyle`
  @font-face {
    font-family: 'font-1';
    src: url(${NovaMono});
  }
  body{
    margin:0;
    padding:0;
    background: fixed center/cover url(${img});
    overflow-x:hidden;
  }
  h2,h1,h3,p,li,button{
    font-family: 'font-1';
    color: white;
  }
`;
export default Front;
