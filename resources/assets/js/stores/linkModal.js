import {EventEmitter} from 'events';
import ModalDispatcher from '../dispatchers/modals';

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

  login() {
    location.reload();
  }

  logout() {
    location.reload();
  }

  link() {
    location.reload();
  }

  unlink() {
    location.reload();
  }
}

ModalDispatcher.register( (payload) => {
  if (payload.actionType === 'link-login') {
    LinkModalStore.login();
    return;
  }
  if (payload.actionType === 'link-logout') {
    LinkModalStore.logout();
    return;
  }
  if (payload.actionType === 'link-link') {
    LinkModalStore.link();
    return;
  }
  if (payload.actionType === 'link-unlink') {
    LinkModalStore.unlink();
    return;
  }
});

export default LinkModalStore;
