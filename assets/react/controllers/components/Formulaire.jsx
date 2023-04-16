import axios from "axios";
import React, { useEffect, useRef, useState } from "react";
import styled from "styled-components";
import Toast from "./Toast";


const Formulaire = () => {
  useEffect(() => {
    if (
      envoi.nom.valid === true &&
      envoi.prenom.valid === true &&
      envoi.email.valid === true &&
      envoi.message.valid === true &&
      inputRefNom.current.value !== ""
    ) {
      envoiApresValidation(envoi);
      inputRefNom.current.value = "";
      inputRefPrenom.current.value = "";
      inputRefEmail.current.value = "";
      inputRefMessage.current.value = "";
    }
  });
  const [toast, setToast] = useState(false);
  const [toastMessage,setToastMessage] = useState('');
  const inputRefNom = useRef();
  const inputRefPrenom = useRef();
  const inputRefEmail = useRef();
  const inputRefMessage = useRef();
  const [envoi, setEnvoi] = useState({
    nom: { content: "", valid: null },
    prenom: { content: "", valid: null },
    email: { content: "", valid: null },
    message: { content: "", valid: null },
  });
  const validEmail = new RegExp(
    '^[a-zA-Z0-9._:$!%-]+@[a-zA-Z0-9.-]+.[a-zA-Z]$'
  );
  function envoiApresValidation(object) {
    axios
      .post("/addContact", { object })
      .then((res) => {(res.status===200 || res.status===201)?setToastMessage("Message Envoyer"):setToastMessage("Une erreur est survenue") })
      .then(setToast(true));
  }
  function testVariable() {
    inputRefNom.current.value
      ? setEnvoi((envoi) => ({
          ...envoi,
          ...{ nom: { content: inputRefNom.current.value, valid: true } },
        }))
      : setEnvoi((envoi) => ({
          ...envoi,
          ...{ nom: { content: "", valid: false } },
        }));
    inputRefPrenom.current.value
      ? setEnvoi((envoi) => ({
          ...envoi,
          ...{ prenom: { content: inputRefPrenom.current.value, valid: true } },
        }))
      : setEnvoi((envoi) => ({
          ...envoi,
          ...{ prenom: { content: "", valid: false } },
        }));
    validEmail.test(inputRefEmail.current.value)
      ? setEnvoi((envoi) => ({
          ...envoi,
          ...{ email: { content: inputRefEmail.current.value, valid: true } },
        }))
      : setEnvoi((envoi) => ({
          ...envoi,
          ...{ email: { content: "", valid: false } },
        }));
    inputRefMessage.current.value
      ? setEnvoi((envoi) => ({
          ...envoi,
          ...{
            message: { content: inputRefMessage.current.value, valid: true },
          },
        }))
      : setEnvoi((envoi) => ({
          ...envoi,
          ...{ message: { content: "", valid: false } },
        }));
  }

  const envoiFormulaire = (e) => {
    e.preventDefault();
    testVariable();
    console.log(inputRefEmail.current.value);
  };

  return (
    <Form>
      {toast ? <Toast message={toastMessage} action={setToast}></Toast> : null}
      <h2>Nous contacté</h2>
      <FormGroupe>
        <label id="nom">Votre Nom*</label>
        <input ref={inputRefNom} type="text" id="nom" />
        {envoi.nom.valid === false ? <span>Nom nécessaire</span> : null}
      </FormGroupe>
      <FormGroupe>
        <label id="prenom">Votre Prenom*</label>
        <input ref={inputRefPrenom} type="text" id="prenom" />
        {envoi.prenom.valid === false ? <span>Prenom nécessaire</span> : null}
      </FormGroupe>
      <FormGroupe>
        <label id="email">Votre Email*</label>
        <input ref={inputRefEmail} type="text" id="email" />
        {envoi.email.valid === false ? <span>email nécessaire</span> : null}
      </FormGroupe>
      <FormGroupe>
        <label id="message">Votre Message*</label>
        <textarea ref={inputRefMessage} id="message" rows="5" cols="43" />
        {envoi.message.valid === false ? <span>Message nécessaire</span> : null}
      </FormGroupe>
      <button type="submit" onClick={envoiFormulaire}>
        Envoyer
      </button>
    </Form>
  );
};
const Form = styled.form`
  display: flex;
  flex-direction: column;
  align-self: start;
  margin: auto;
  margin-bottom: 10vh;
  background: rgba(0, 0, 0, 0.4);
  label {
    font-size: 1.3rem;
  }
  button {
    font-size: 1.2rem;
    width: 40%;
    align-self: center;
    margin: 2vw;
    background: transparent;
    color: white;
    box-sizing: border-box;
    border: 2px solid white;
    width: 50%;
    padding: 15px 0;
    box-shadow: 1px 3px 10px 3px black;
    &:active {
      box-shadow: inset 1px 3px 10px 3px black;
    }
    &:hover {
      box-shadow: 1px 3px 10px 5px black;
    }
  }
  input {
    font-size: 1.2rem;
    background: transparent;
    color: white;
    box-sizing: border-box;
    border: none;
    border-bottom: 2px solid white;
    width: 50%;
    transition: width 0.4s ease-in-out;
    padding: 15px 0;
    outline: none;
    &:focus {
      transition: width 0.4s ease-in-out;
      width: 100%;
    }
  }
  textarea {
    font-size: 1.2rem;
    background: transparent;
    color: white;
    box-sizing: border-box;
    border: none;
    border-bottom: 2px solid white;
    height: 5rem;
    transition: height 0.4s ease-in-out;
    outline: none;
    width: 100%;
    max-width: 100%;
    &:focus {
      transition: height 0.4s ease-in-out;
      height: 9rem;
    }
  }
`;
const FormGroupe = styled.div`
  display: flex;
  flex-direction: column;
  align-items: start;
  padding: 30px;
  color: white;
  span {
    color: #f26c6c;
  }
`;

export default Formulaire;
