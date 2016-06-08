import {EventEmitter} from 'events';
import ModalDispatcher from '../dispatchers/modals';

let ConfigModalStore = new class extends EventEmitter {
  constructor() {
    super();
    this.active = false;
    this.switches = [true, true, true];
  }

  show() {
    this.active = true;
    this.emit('show');
  }

  onShow(callback) {
    this.on('show', callback);
  }

  close() {
    if (this.active) {
      this.active = false;
      this.emit('close');
    }
  }

  onClose(callback) {
    this.on('close', callback);
  }

  clickSwitch(switchName) {
    switch (switchName) {
    case 'switch1': this.switches[0] = !this.switches[0]; break;
    case 'switch2': this.switches[1] = !this.switches[1]; break;
    case 'switch3': this.switches[2] = !this.switches[2]; break;
    }

    this.updateServer();
    this.emit('clickSwitch', this.switches);
  }

  onClickSwitch(callback) {
    this.on('clickSwitch', callback);
  }

  RemoveOnClickSwitch(callback) {
    this.removeListener('clickSwitch', callback);
  }

  updateServer() {
    setTimeout(() => {
      console.log(this.switches);
    }, 1000);
  }

  getSwitches() {
    return this.switches;
  }
}

ModalDispatcher.register( (payload) => {
  if (payload.actionType === 'config-click-switch') {
    ConfigModalStore.clickSwitch(payload.data);
  }
});

export default ConfigModalStore;
