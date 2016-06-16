import {EventEmitter} from 'events';
import NotificationDispatcher from '../dispatchers/notification';

let NotificationStore = new class extends EventEmitter {
  constructor() {
    super();
    this.notifications = [];
    this.latestId = undefined;
    this.updateInterval = 30000;
    this.updateTimeoutId = undefined;
  }

  load() {
    let loadRequest = fetch('/curriculum/notify', { 'credentials': 'include' })
      .then( (res) => res.json() )
      .then( (res) => ( res.status === 'success' ? Promise.resolve(res.data) : Promise.reject(res.error) ) )
      .then( (data) => {
        this.notifications = data;
        this.latestId = Math.max.apply(null, data.map( (e) => e.id ));
        setTimeout(this.update.bind(this), this.updateInterval);

        this.emit('load');
        this.emit('update');
      })
      .catch( (err) => { console.log(`notification load error: ${err}`, err); });
  }

  onLoad(callback) {
    this.on('load', callback);
  }

  removeOnLoad(callback) {
    this.removeListener('load', callback);
  }

  update() {
    clearTimeout(this.updateTimeoutId);

    let updateRequest = fetch(`/curriculum/notify?item_id=${this.latestId}&range=10`, { 'credentials': 'include' })
      .then( (res) => res.json() )
      .then( (res) => (res.status === 'success' ? Promise.resolve(res.data) : Promise.reject(res.error) ) )
      .then( (data) => {
        let noti = this.notifications;
        noti = noti.concat(data.sort( (a, b) => a.id > b.id));
        this.latestId = noti[noti.length - 1].id;
        this.notifications = noti;

        this.emit('update');
      })
      .catch( (err) => { console.log(`notification update error: ${err}`, err); });

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

  create(courseId, type) {

  }

  readAll() {
    let readRequest = fetch('/curriculum/readAll', {'method': 'PATCH', 'credentials': 'include' })
      .then( (res) => res.json() )
      .then( (res) => (res.status === 'success' ? Promise.resolve() : Promise.reject(res.error) ) )
      .catch( (err) => { console.log(`notification ReadAll error: ${err}`, err); });
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
