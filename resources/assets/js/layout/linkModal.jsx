import React from 'react';
import ModalDispatcher from '../dispatchers/modals';

let LinkModal = React.createClass({
  'getInitialState': function () {
    return {
      'unlinking': false
    }
  },

  'closeModal': function () {
    ModalDispatcher.dispatch({ 'actionType': 'close' });
  },

  'onClickUnlink': function (e) {
    if (this.state.unlinking) return;
    this.setState({ 'unlinking': true });
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
            {
              this.props.isLogin ?
                <span className="mod-text mod-link-text">登入中： {this.props.userName} / <a href="/users/logout">登出</a></span> :
                <span className="mod-text mod-link-text"><a href="/users/login">登入</a></span>
            }
          </div>
          <div className="mod-item mod-link">
            <img className="mod-image" src="/img/fb-blue.png" />
            {
              this.props.isLogin ? (
                this.props.isLinkFacebook ?
                  <span className="mod-text mod-link-text">連結中： {this.props.fbName} / <a onClick={this.onClickUnlink}>斷開{this.state.unlinking && '中...'}</a></span> :
                  <span className="mod-text mod-link-text"><a href="/curriculum/link-facebook">連結</a></span>
                ) :
                <span className="mod-text mod-link-text">請先登入 Facing Course</span>
            }
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
