import React from 'react';
import Curriculum from '../layout/curriculum';
import mainLayout from '../layout/mainLayout';
import modalLayout from '../layout/modalLayout';
import AddModal from '../layout/addModal/index';
import ConfigModal from '../layout/configModal';
import LinkModal from '../layout/linkModal';
import ModalDispatcher from '../dispatchers/modals';
import AddModalStore from '../stores/addModal';
import ConfigModalStore from '../stores/configModal';
import LinkModalStore from '../stores/linkModal';

ModalDispatcher.register( (payload) => {
  if (payload.actionType === 'modal-show') {
    let ModalStore;
    switch (payload.data) {
    case 'add':    ModalStore = AddModalStore;    break;
    case 'config': ModalStore = ConfigModalStore; break;
    case 'link':   ModalStore = LinkModalStore;   break;
    }
    ModalStore.show();
  }
});

ModalDispatcher.register( (payload) => {
  if (payload.actionType === 'search') {
    AddModalStore.search();
  }
});

ModalDispatcher.register( (payload) => {
  if (payload.actionType === 'close') {
    AddModalStore.close();
    ConfigModalStore.close();
    LinkModalStore.close();
  }
});

AddModalStore.onShow( () => {
  modalLayout(AddModal, AddModalStore.getMode() === 'search' ?
    { 'mode': 'search', 'getFilters': AddModalStore.getFilters.bind(AddModalStore) } :
    { 'mode': 'result', 'onGetResult': AddModalStore.onGetResult.bind(AddModalStore) }
  );
  $('#blackBG').removeClass('visibility-hidden');
});

AddModalStore.onSearch( () => {
  modalLayout(AddModal, { 'mode': 'result', 'onGetResult': AddModalStore.onGetResult.bind(AddModalStore) });
  $('#blackBG').removeClass('visibility-hidden');
});

ConfigModalStore.onShow( () => {
  modalLayout(ConfigModal, {
    'onClickSwitch': ConfigModalStore.onClickSwitch.bind(ConfigModalStore),
    'removeOnClickSwitch': ConfigModalStore.RemoveOnClickSwitch.bind(ConfigModalStore),
    'switches': ConfigModalStore.getSwitches()
  });
  $('#blackBG').removeClass('visibility-hidden');
});

LinkModalStore.onShow( () => {
  modalLayout(LinkModal, {
    'userName': 'xgnid',
    'fbName': '雷'
  });
  $('#blackBG').removeClass('visibility-hidden');
});

[AddModalStore, ConfigModalStore, LinkModalStore].forEach( (e) => {
  e.onClose( () => {
    modalLayout.unmount();
    $('#blackBG').addClass('visibility-hidden');
  });
});

$('#blackBG').on('click', (e) => {
  ModalDispatcher.dispatch({ 'actionType': 'close' });
});

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

let Index = React.createClass({
  'render': function () {
    return (
      <div id="container">
        <Curriculum />
        <SideBtns />
      </div>
    );
  }
});

mainLayout(Index);
