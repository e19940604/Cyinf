import React from 'react';

let SideMenu = React.createClass({
  'render': function () {
    return (
      <div id="sideMenu" className="m-only">
        <div id="sideContent">

          <div id="sideProfile" >
            <img className="img-circle" src="/img/no-user-image.gif" />
            <span>xgnid</span>
          </div>

          <div className="sideRow">新增課程</div>
          <div className="sideRow">通知設定</div>
          <div className="sideRow">帳號連結</div>

          <img id="sideBg" src="/Cyinf/img/CyinfLogo.png" />

        </div>
      </div>
    );
  }
});

export default SideMenu;
