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
import UserStore from '../stores/user';

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

let SearchModal = () => {
  modalLayout(AddModal, {
    'mode': 'search',
    'getFilters': AddModalStore.getFilters.bind(AddModalStore)
  });
};

let ResultModal = () => {
  modalLayout(AddModal, {
    'mode': 'result',
    'onGetResults': AddModalStore.onGetResults.bind(AddModalStore),
    'removeOnGetResults': AddModalStore.removeOnGetResults.bind(AddModalStore),
    'getResults': AddModalStore.getResults.bind(AddModalStore)
  });
};

AddModalStore.onShow( () => {
  if (AddModalStore.getMode() === 'search') SearchModal();
  else ResultModal();

  $('#blackBG').removeClass('visibility-hidden');
});

AddModalStore.onSearch( () => {
  ResultModal();
});

AddModalStore.onClearResults( () => {
  SearchModal();
});

ConfigModalStore.onShow( () => {
  ConfigModalStore.load();
  modalLayout(ConfigModal, {
    'onUpdate':       ConfigModalStore.onUpdate.bind(ConfigModalStore),
    'removeOnUpdate': ConfigModalStore.removeOnUpdate.bind(ConfigModalStore),
    'onSend':         ConfigModalStore.onSend.bind(ConfigModalStore),
    'removeOnSend':   ConfigModalStore.removeOnSend.bind(ConfigModalStore),
    'switches':       ConfigModalStore.getSwitches()
  });
  $('#blackBG').removeClass('visibility-hidden');
});

let loadLinkModal = () => {
  let props = { 'isLogin': false };
  if (UserStore.isLogin()) {
    props.isLogin = true;
    props.userName = UserStore.getUserName();
    if (UserStore.isLinkFacebook()) {
      props.isLinkFacebook = true;
      props.fbName = UserStore.getFbName();
    }
  }

  modalLayout(LinkModal, props);
};

LinkModalStore.onShow( () => {
  loadLinkModal();
  UserStore.onLoad(loadLinkModal);
  $('#blackBG').removeClass('visibility-hidden');
});

LinkModalStore.onClose( () => {
  UserStore.removeOnLoad(loadLinkModal);
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
ConfigModalStore.load();

let Index = React.createClass({
  'render': function () {
    return (
      <div id="container">
        <Curriculum onUpdate={CurriculumStore.onUpdate.bind(CurriculumStore)} />
        <SideBtns />
      </div>
    );
  }
});

mainLayout(Index);
