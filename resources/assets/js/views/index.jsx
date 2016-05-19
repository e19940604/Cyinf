import React from 'react';
import Curriculum from '../layout/curriculum';
import mainLayout from '../layout/mainLayout';
import modalLayout from '../layout/modalLayout';
import AddModal from '../layout/addModal/index';
import ConfigModal from '../layout/configModal';
import LinkModal from '../layout/linkModal';

let SideBtns = React.createClass({
  'handleClickAdd': function (e) {
    modalLayout(AddModal);
    $('#blackBG').removeClass('visibility-hidden');
  },
  'handleClickConfig': function (e) {
    modalLayout(ConfigModal);
    $('#blackBG').removeClass('visibility-hidden');
  },
  'handleClickLink': function (e) {
    modalLayout(LinkModal);
    $('#blackBG').removeClass('visibility-hidden');
  },
  'render': function () {
    return (
      <div id="sideBtns" className="desk-only">
        <div id="addCourseBtn" className="sideBtn pinkBtn cursor-pointer" onClick={this.handleClickAdd}>
          <span>新增</span>
        </div>
        <div id="configBtn" className="sideBtn blueBtn cursor-pointer" onClick={this.handleClickConfig}>
          <span>設定</span>
        </div>
        <div id="connectBtn" className="sideBtn orangeBtn cursor-pointer" onClick={this.handleClickLink}>
          <span>連結</span>
        </div>
      </div>
    );
  }
});

let index = React.createClass({
  'render': function () {
    return (
      <div id="container">
        <Curriculum />
        <SideBtns />
      </div>
    );
  }
});

mainLayout(index);
