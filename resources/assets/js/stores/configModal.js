import {EventEmitter} from 'events';
import ModalDispatcher from '../dispatchers/modals';

let ConfigModalStore = new class extends EventEmitter {
  constructor() {
    super();
    this.active = false;
    this.switches = {
      'classNote': true,
      'rollCallNote': true,
      'testNote': true
    };
  }

  show() {
    this.active = true;
    this.emit('show');
    this.load();
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

  load() {
    let loadRequest = fetch('/curriculum/config', { 'credentials': 'include' })
      .then( (res) => res.json() )
      .then( (res) => res.status === 'success' ? Promise.resolve(res.data) : Promise.reject(res.error) )
      .then( (data) => {
        this.update({
          'classNote': data.class_note,
          'rollCallNote': data.go_class_note,
          'testNote': data.test_note
        });
      })
      .catch( (err) => { console.log(`config modal error: ${err}`, err); })
      .then( () => {
        this.emit('load', this.switches);
      });
  }

  onLoad(callback) {
    this.on('load', callback);
  }

  removeOnLoad(callback) {
    this.removeListener('load', callback);
  }

  update(data) {
    Object.assign(this.switches, data);
    this.emit('update', this.switches);
  }

  onUpdate(callback) {
    this.on('update', callback);
  }

  removeOnUpdate(callback) {
    this.removeListener('update', callback);
  }

  send(switchName) {
    if (this.switches.hasOwnProperty(switchName)) {
      let data = new URLSearchParams();
      data.append('type', ['classNote', 'rollCallNote', 'testNote'].indexOf(switchName));
      if (data.get('type') < 0) throw `unknown switch name: ${switchName}`;

      let sendRequest = fetch('/curriculum/config', { 'method': 'PATCH', 'body': data, 'credentials': 'include' })
        .then( (res) => res.json() )
        .then( (data) => (data.status === 'success' ? Promise.resolve() : Promise.reject(data.error)) )
        .then( () => {
          let newSwitches = Object.assign({}, this.switches);
          newSwitches[switchName] = !newSwitches[switchName];
          this.update(newSwitches);
        })
        .catch( (err) => { console.log(`config send server error: ${err}`, err); })
        .then( () => {
          this.emit('send', switchName);
        });
    }
  }

  onSend(callback) {
    this.on('send', callback);
  }

  removeOnSend(callback) {
    this.removeListener('send', callback);
  }

  clickSwitch(switchName) {
    if (this.switches.hasOwnProperty(switchName)) this.send(switchName);
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
