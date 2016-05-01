import React from 'react';
import ReactDOM from 'react-dom';

import Header from './header';
import Footer from './footer';

let mainLayout = function mainLayout(Container) {

  ReactDOM.render( <Header /> , document.getElementById('header') );
  ReactDOM.render( <Container /> , document.getElementById('container') );
  ReactDOM.render( <Footer /> , document.getElementById('footer') );

};

export default mainLayout;
