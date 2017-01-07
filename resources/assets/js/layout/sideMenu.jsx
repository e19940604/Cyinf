import React from 'react';
import ModalDispatcher from '../dispatchers/modals';

let SideMenu = React.createClass({
  'handleClickAdd': function (e) {
    ModalDispatcher.dispatch({ 'actionType': 'modal-show', 'data': 'add' });
  },

  'handleClickConfig': function (e) {
    ModalDispatcher.dispatch({ 'actionType': 'modal-show', 'data': 'config' });
  },

  'handleClickLink': function (e) {
    ModalDispatcher.dispatch({ 'actionType': 'modal-show', 'data': 'link' });
  },
  'render': function () {
    return (
      <div id="sideMenu" className="m-only">
        <div id="sideContent">

          <div id="sideProfile" >
            <img className="img-circle" src="/img/no-user-image.gif" />
            <span>xgnid</span>
          </div>

          <div className="sideRow" onClick={this.handleClickAdd}>新增課程</div>
          <div className="sideRow" onClick={this.handleClickConfig}>通知設定</div>
          <div className="sideRow" onClick={this.handleClickLink}>帳號連結</div>

          <img id="sideBg" src="/Cyinf/img/CyinfLogo.png" />

        </div>
      </div>
    );
  }
});

export default SideMenu;
