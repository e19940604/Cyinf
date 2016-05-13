import React from 'react';
import ReactDOM from 'react-dom';

import Header from './header';
import Footer from './footer';
import SideMenu from './sideMenu';

let mainLayout = function mainLayout(Container) {

  ReactDOM.render(<Header />, document.getElementById('header') );
  ReactDOM.render(<SideMenu />, document.getElementById('sideMenu-wrap') );
  ReactDOM.render(<Container />, document.getElementById('container-wrap') );
  ReactDOM.render(<Footer />, document.getElementById('footer') );

};

export default mainLayout;
