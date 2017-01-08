import React from 'react';
import ModalDispatcher from '../dispatchers/modals';
import UserStore from '../stores/user';
UserStore.load();
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

  'onLoadUserStatus': function () {
    if ( UserStore.isLogin() ) {
      if ( UserStore.isLinkFacebook() ) {
        this.setState({ 'isLogin': true, 'userName': UserStore.getUserName(), 'imageUrl': UserStore.getImageUrl() });
      }
      else {
        this.setState({ 'isLogin': true, 'userName': UserStore.getUserName() });
      }
    }
    else {
      this.setState({ 'isLogin': false });
    }
  },

  'componentWillMount': function () {
    UserStore.onLoad(this.onLoadUserStatus);
  },

  'render': function () {
    return (
      <div id="sideMenu" className="m-only">
        <div id="sideContent">

          <div id="sideProfile" >
            <img className="img-circle" src="/img/no-user-image.gif" />
            <span>{ UserStore.getUserName() }</span>
          </div>

          <div className="sideRow" onClick={this.handleClickAdd}>新增課程</div>
          <div className="sideRow" onClick={this.handleClickConfig}>通知設定</div>
          <div className="sideRow" onClick={this.handleClickLink}>帳號連結</div>

          <img id="sideBg" className="sideBg" src="/Cyinf/img/CyinfLogo.png" />

        </div>
      </div>
    );
  }
});

export default SideMenu;
