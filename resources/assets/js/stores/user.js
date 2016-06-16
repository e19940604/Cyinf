import {EventEmitter} from 'events';
import UserDispatcher from '../dispatchers/user';

let UserStore = new class extends EventEmitter {
  constructor() {
    super();
    this.login = false;
    this.userName = '';
    this.fbName = '';
    this.linkFacebook = false;
    this.imageUrl = '';
  }

  load() {
    let UserStatusRequest = Promise.all([
      fetch('/curriculum/user',     { 'credentials': 'include' }).then( (res) => res.json() ),
      fetch('/curriculum/facebook-status', { 'credentials': 'include' }).then( (res) => res.json() )
    ])
      .then( (res) => {
        let userStatus = res[0];
        let fbStatus = res[1];
        if (userStatus.status === 'success') {
          this.login = true;
          this.userName = userStatus.data;
          if (fbStatus.status === 'success') {
            this.linkFacebook = true;
            this.fbName = fbStatus.data.name;
            this.imageUrl = fbStatus.data.imageUrl;
          }
        }

        if (userStatus.status === 'failure') console.log(`user-status: ${userStatus.error}`);
        if (fbStatus.status   === 'failure' && fbStatus.error !== 'Not connect Facebook') console.log(`facebook-status: ${fbStatus.error}`);
      })
      .catch( (err) => { console.log(`User status error: ${err}`, err); })
      .then( () => { this.emit('load'); }); // Yes, this `.then()` will always execute
  }

  onLoad(callback) {
    this.on('load', callback);
  }

  removeOnLoad(callback) {
    this.removeListener('load', callback);
  }

  isLogin() {
    return this.login;
  }

  isLinkFacebook() {
    return this.linkFacebook;
  }

  getUserName(callback) {
    return this.userName;
  }

  getFbName(callback) {
    return this.fbName;
  }

  getImageUrl(callback) {
    return this.imageUrl;
  }
};

UserDispatcher.register( (payload) => {
  switch (payload.actionType) {
  case 'check-status':
    UserStore.load();
    break;
  }
});

export default UserStore;
