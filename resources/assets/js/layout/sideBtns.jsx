import React from 'react';
import ModalDispatcher from '../dispatchers/modals';

let SideBtns = React.createClass({
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

export default SideBtns;
