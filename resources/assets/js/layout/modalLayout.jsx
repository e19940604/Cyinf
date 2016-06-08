import React from 'react';
import ReactDOM from 'react-dom';

let modalLayout = (Modal, props) => {
  ReactDOM.render(<Modal {...props} />, modalLayout.modalElement);
};

modalLayout.unmount = () => {
  ReactDOM.unmountComponentAtNode(modalLayout.modalElement);
};

modalLayout.modalElement = document.getElementById('modal');

export default modalLayout;
