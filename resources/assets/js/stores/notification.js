import {EventEmitter} from 'events';
import NotificationDispatcher from '../dispatchers/notification';

let NotificationStore = new class extends EventEmitter {
  constructor() {
    super();
    this.notifications = new Map();
    this.latestId = undefined;
    this.notRead = false;
    this.updateInterval = 5000;
    this.updateTimeoutId = undefined;
  }

  load() {
    let loadRequest = fetch('/curriculum/notify', { 'credentials': 'include' })
      .then( (res) => res.json() )
      .then( (res) => ( res.status === 'success' ? Promise.resolve(res.data) : Promise.reject(res.error) ) )
      .then( (data) => {
        this.update(data);

        setTimeout(this.updateNotification.bind(this), this.updateInterval);
      })
      .catch( (err) => { console.log(`notification load error: ${err}`, err); })
      .then( () => {
        this.emit('load');
      });
  }

  onLoad(callback) {
    this.on('load', callback);
  }

  removeOnLoad(callback) {
    this.removeListener('load', callback);
  }

  update(data) {
    data.forEach( (e) => {
      this.notifications.set(e.id, e);
    })

    let newLatestId = Math.max.apply(null, [...this.notifications.keys()]);
    if (newLatestId !== this.latestId) {
      this.latestId = newLatestId;
      this.notRead = true;
      this.emit('update');
    }
  }

  onUpdate(callback) {
    this.on('update', callback);
  }

  removeOnUpdate(callback) {
    this.removeListener('update', callback);
  }

  updateNotification() {
    clearTimeout(this.updateTimeoutId);

    let updateRequest = fetch(`/curriculum/notify?item_id=${this.latestId}&range=10`, { 'credentials': 'include' })
      .then( (res) => res.json() )
      .then( (res) => (res.status === 'success' ? Promise.resolve(res.data) : Promise.reject(res.error) ) )
      .then( (data) => {
        this.update(data);
      })
      .catch( (err) => { console.log(`notification update error: ${err}`, err); });

    setTimeout(this.updateNotification.bind(this), this.updateInterval);
  }

  getNotifications() {
    return [...this.notifications.entries()].sort( (a, b) => a[0] < b[0] ).map( (e) => e[1] );
  }

  readAll() {
    if (this.notRead) {
    let readRequest = fetch('/curriculum/readAll', {'method': 'PATCH', 'credentials': 'include' })
      .then( (res) => res.json() )
      .then( (res) => (res.status === 'success' ? Promise.resolve() : Promise.reject(res.error) ) )
      .then( () => {
        this.notRead = false;
      })
      .catch( (err) => { console.log(`notification ReadAll error: ${err}`, err); });
    }
  }
};

NotificationDispatcher.register( (payload) => {
  switch (payload.actionType) {
  case 'update-notification':
    NotificationStore.updateNotification();
    break;

  case 'read-all':
    NotificationStore.readAll();
    break;
  }
});

export default NotificationStore;
