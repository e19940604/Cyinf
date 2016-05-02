import React from 'react';
import Curriculum from '../layout/curriculum';
import mainLayout from '../layout/mainLayout';

let SideBtns = React.createClass({
  render: function () {
    return (
      <div id="sideBtns" className="desk-only">
          <div id="addCourseBtn" className="sideBtn pinkBtn">
              <span>新增</span>
          </div>
          <div id="configBtn" className="sideBtn blueBtn">
              <span>設定</span>
          </div>
          <div id="connectBtn" className="sideBtn orangeBtn">
              <span>連結</span>
          </div>
      </div>
    );
  }
});

let index = React.createClass({
  render: function () {
    return (
      <div id="container">
          <Curriculum />
          <SideBtns />
      </div>
    );
  }
});

mainLayout(index);
