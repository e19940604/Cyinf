import {EventEmitter} from 'events';
import ModalDispatcher from '../dispatchers/modals';
import UserDispatcher from '../dispatchers/user';

let LinkModalStore = new class extends EventEmitter {
  constructor() {
    super();
    this.active = false;
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

  unlink() {
    let unlinkRequest = fetch('/curriculum/fbconnect', { 'method': 'DELETE', 'credentials': 'include' })
      .then( (res) => res.json() )
      .then( (res) => (res.status === 'success' ? Promise.resolve() : Promise.reject(res.error)) )
      .then( () => { UserDispatcher.dispatch({ 'actionType': 'check-status' }); })
      .catch( (err) => { console.log(`link modal error: ${err}`, err); });
  }
}

ModalDispatcher.register( (payload) => {
  switch (payload.actionType) {
  case 'link-unlink':
    LinkModalStore.unlink();
    break;
  }
});

export default LinkModalStore;
