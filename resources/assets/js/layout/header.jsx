import React from 'react';
//var React = require('react');
import NotifyPartial from './notifyPartial';
import UserStore from '../stores/user';
import NotificationStore from '../stores/notification';

NotificationStore.load();
UserStore.load();

let SideBar = React.createClass({
  'getInitialState': function () {
    return {
      'showNotification': false
    }
  },

  'onClickOutsideNotification': function (event) {
    if ($(event.target).parents('#note').length === 0) this.onClickNotification();
  },

  'onClickNotification': function (event) {
    if (event) event.stopPropagation();

    if (this.state.showNotification) {
      this.setState({ 'showNotification': false });
      $('body').off('click', this.onClickOutsideNotification);
    }
    else {
      this.setState({ 'showNotification': true });
      $('body').on('click', this.onClickOutsideNotification);
    }
  },

  'render': function() {
    return (
      <div id="profile">
        <ul>
          <li id="note" >
            <i className="fa fa-bell-o cursor-pointer" onClick={this.onClickNotification}></i>
            <div className="notify-container" style={this.state.showNotification ? {} : {'display': 'none'}}>
                <NotifyPartial
                  onUpdate={NotificationStore.onUpdate.bind(NotificationStore)}
                  removeOnUpdate={NotificationStore.removeOnUpdate.bind(NotificationStore)}
                  getNotifications={NotificationStore.getNotifications.bind(NotificationStore)}
                />
            </div>
          </li>
          <li id="m-sidebtn" className="m-only" ><i id="m-side" className="fa fa-bars"></i></li>
          <li className="desk-only"> | </li>
          <li id="fb-icon" className="desk-only"><a href="#" ><img className="img-circle"  src={this.props.imageUrl} /></a></li>
          <li className="desk-only"> | </li>
          <li id="fb-name" className="desk-only"><a href={this.props.isLogin ? '#' : '/users/login'}>{this.props.isLogin ? this.props.userName : '登入'}</a></li>
        </ul>
      </div>
    );
  }
});

let Header = React.createClass({

  'getInitialState': function () {
    return {
      'isLogin': false,
      'imageUrl': '/img/no-user-image.gif',
      'userName': ''
    };
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
      <div id="hd-container" >
        <div id="title-wrap"><a href="/curriculum"><img id="logo" src="/curr/img/icon_c.svg" /><h3>urriculum</h3></a></div>
        <SideBar {...this.state} />
      </div>
    );
  }

});

export default Header;
