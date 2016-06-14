import {EventEmitter} from 'events';
import NotificationDispatcher from '../dispatchers/notification';

let NotificationStore = new class extends EventEmitter {
  constructor() {
    super();
    this.notifications = [];
    this.latestId = undefined;
    this.updateInterval = 5000;
    this.updateTimeoutId = undefined;
    this.updateRequest = undefined;
    this.loadRequest = undefined;
  }

  load() {
    this.loadRequest = new Promise( (resolve, reject) => {
      setTimeout( () =>{
        resolve([
          {
            'item_id': 9,
            'imageUrl': '/curr/img/icon_c.svg',
            'content': '上課通知 - 9: 00 C程式設計(二) 工EC 5012',
            'create_at': '2016-04-27'
          },
          {
            'item_id': 8,
            'imageUrl': '/curr/img/icon_c.svg',
            'content': 'test123',
            'create_at': '2016-04-26'
          },
          {
            'item_id': 7,
            'imageUrl': '/curr/img/icon_c.svg',
            'content': '測試',
            'create_at': '2016-04-25'
          }
        ]);
      }, 1000);
    });

    this.loadRequest.then( (data) => {
      let noti = this.notifications;
      noti = noti.concat(data.sort( (a, b) => a.item_id > b.item_id));
      this.latestId = noti[noti.length - 1].item_id;
      this.notifications = noti;

      setTimeout(this.update.bind(this), this.updateInterval);

      this.emit('load');
      this.emit('update');
    });
  }

  onLoad(callback) {
    this.on('load', callback);
  }

  removeOnLoad(callback) {
    this.removeListener('load', callback);
  }

  update() {
    clearTimeout(this.updateTimeoutId);

    this.updateRequest = new Promise( (resolve, reject) => {
      setTimeout( () => {
        resolve([
          {
            'item_id': this.latestId + 1,
            'imageUrl': '/curr/img/icon_c.svg',
            'content': '上課通知 - 9: 00 C程式設計(二) 工EC 5012' + (this.latestId + 1),
            'create_at': '2016-04-27'
          }
        ]);
      }, 1000);
    });

    this.updateRequest.then( (data) => {
      let noti = this.notifications;
      noti = noti.concat(data.sort( (a, b) => a.item_id > b.item_id));
      this.latestId = noti[noti.length - 1].item_id;
      this.notifications = noti;

      this.emit('update');
    });

    setTimeout(this.update.bind(this), this.updateInterval);
  }

  onUpdate(callback) {
    this.on('update', callback);
  }

  removeOnUpdate(callback) {
    this.removeListener('update', callback);
  }

  getNotifications() {
    return this.notifications;
  }

  create() {

  }

  readAll() {

  }
};

NotificationDispatcher.register( (payload) => {
  switch (payload.actionType) {
  case 'create-notification':
    NotificationStore.create(payload.data);
    break;
  case 'read-all':
    NotificationStore.readAll();
  }
});

export default NotificationStore;
