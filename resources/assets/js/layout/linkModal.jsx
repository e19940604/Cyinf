import React from 'react';
import ModalDispatcher from '../dispatchers/modals';

let LinkModal = React.createClass({
  'closeModal': function () {
    ModalDispatcher.dispatch({ 'actionType': 'close' });
  },

  'onClickLogout': function () {
    ModalDispatcher.dispatch({ 'actionType': 'link-logout' });
  },

  'onClickUnlink': function () {
    ModalDispatcher.dispatch({ 'actionType': 'link-unlink' });
  },

  'render': function () {
    return (
      <div id="link-modal" className="orangeModal mod">
        <img src="/Curr/img/close.png" className="closeBtn cursor-pointer" onClick={this.closeModal} />
        <div className="mod-content">
          <div className="mod-title">
            <h4 className="mod-title-text">帳號連結</h4>
          </div>
          <div className="mod-item mod-link">
            <img className="mod-image" src="/img/shortIcon.png" />
            <span className="mod-text mod-link-text">登入中： {this.props.userName} / <a onClick={this.onClickLogout}>登出</a></span>
          </div>
          <div className="mod-item mod-link">
            <img className="mod-image" src="/img/fb-blue.png" />
            <span className="mod-text mod-link-text">連結中： {this.props.fbName} / <a onClick={this.onClickUnlink}>斷開</a></span>
          </div>
          <div className="mod-bg m-only">
            <img src="/Cyinf/img/CyinfLogo.png" />
          </div>
        </div>
      </div>
    );
  }
});

export default LinkModal;
