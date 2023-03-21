import React from 'react';
import ReactDOM from 'react-dom';
import * as ReactDOMClient from 'react-dom/client';
import Front from './Front';

if (document.getElementById('root')){
  const rooty= ReactDOMClient.createRoot(document.getElementById("root"))
  rooty.render(<Front rooty = {rooty}/>)
}
