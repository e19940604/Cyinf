import React from 'react';

import mainLayout from '../layout/mainLayout';
import modalLayout from '../layout/modalLayout';

import Curriculum from '../layout/curriculum';
import SideBtns from '../layout/sideBtns';
import AddModal from '../layout/addModal/index';
import ConfigModal from '../layout/configModal';
import LinkModal from '../layout/linkModal';

import ModalDispatcher from '../dispatchers/modals';

import AddModalStore from '../stores/addModal';
import ConfigModalStore from '../stores/configModal';
import LinkModalStore from '../stores/linkModal';
import CurriculumStore from '../stores/curriculum';

ModalDispatcher.register( (payload) => {
  switch (payload.actionType) {
  case 'modal-show':
    switch (payload.data) {
    case 'add':    AddModalStore.show();    break;
    case 'config': ConfigModalStore.show(); break;
    case 'link':   LinkModalStore.show();   break;
    }
    break;

  case 'close':
    AddModalStore.close();
    ConfigModalStore.close();
    LinkModalStore.close();
    break;
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
});

AddModalStore.onClearResult( () => {
  modalLayout(AddModal, { 'mode': 'search', 'getFilters': AddModalStore.getFilters.bind(AddModalStore) });
});

ConfigModalStore.onShow( () => {
  modalLayout(ConfigModal, {
    'onClickSwitch':       ConfigModalStore.onClickSwitch.bind(ConfigModalStore),
    'removeOnClickSwitch': ConfigModalStore.RemoveOnClickSwitch.bind(ConfigModalStore),
    'switches':            ConfigModalStore.getSwitches()
  });
  $('#blackBG').removeClass('visibility-hidden');
});

LinkModalStore.onShow( () => {
  modalLayout(LinkModal, {
    'userName': 'xgnid',
    'fbName':   '雷'
  });
  $('#blackBG').removeClass('visibility-hidden');
});

[AddModalStore, ConfigModalStore, LinkModalStore].forEach( (e) => {
  e.onClose( () => {
    modalLayout.unmount();
    $('#blackBG').addClass('visibility-hidden');
  });
});

// will replace by GlobalDispatcher, implement later
$('#blackBG').on('click', (e) => {
  ModalDispatcher.dispatch({ 'actionType': 'close' });
});

CurriculumStore.load();

let Index = React.createClass({
  'render': function () {
    return (
      <div id="container">
        <Curriculum onLoad={CurriculumStore.onLoad.bind(CurriculumStore)} getCourses={CurriculumStore.getCourses.bind(CurriculumStore)} />
        <SideBtns />
      </div>
    );
  }
});

mainLayout(Index);
