import React from 'react';
import ReactDOM from 'react-dom';

let modalLayout = function modalLayout(Modal, props) {
  let modalElement = document.getElementById('modal');
  let unmount = () => {
    ReactDOM.unmountComponentAtNode(modalElement);
  };

  ReactDOM.render(<Modal {...props} unmount={unmount}/>, modalElement );
};

export default modalLayout;
