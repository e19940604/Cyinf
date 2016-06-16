import {EventEmitter} from 'events';
import CourseDetailDispatcher from '../dispatchers/courseDetail';

let CourseDetailStore = new class extends EventEmitter {
  constructor() {
    super();
    this.courseId = undefined;
    this.course = undefined;
    this.loadRequest = undefined;
  }

  load(id) {
    if (typeof id !== 'undefined') this.courseId = id;

    let loadRequest = fetch(`/curriculum/course/${this.courseId}`, { 'credentials': 'include' })
      .then( (res) => res.json() )
      .then( (res) => ( res.status === 'success' ? Promise.resolve(res.data) : Promise.reject(res.error) ) )
      .then( (data) => {
        this.course = data;
      })
      .catch( (err) => { console.log(`courseDetail error: ${err}`, err); })
      .then( () => {
        this.emit('load', this.course);
      });
  }

  onLoad(callback) {
    this.on('load', callback);
  }

  removeOnLoad(callback) {
    this.removeListener('load', callback);
  }

  getCourse() {
    return this.course;
  }

  createNotify(type) {
    if (type !== 1 && type !== 2) return;

    let data = new URLSearchParams();
    data.append('course_id', this.courseId);
    data.append('type', type);
    let notifyRequest = fetch('/curriculum/notify', {
      'method': 'POST',
      'body': data,
      'credentials': 'include'
    })
      .then( (res) => res.json() )
      .then( (res) => ( res.status === 'success' ? Promise.resolve() : Promise.reject(res.error) ) )
      .then( () => {
        this.emit('create-notify', undefined, type);
      })
      .catch( (err) => {
        console.log(`create notify error: ${err}`, err);
        this.emit('create-notify', err, type);
      });
  }

  onCreateNotify(callback) {
    this.on('create-notify', callback);
  }

  removeOnCreateNotify(callback) {
    this.removeListener('create-notify', callback);
  }

  add() {
    let data = new URLSearchParams();
    data.append('course_id', this.courseId);

    let loadRequest = fetch('/curriculum/add', {
      'method': 'POST',
      'body': data,
      'credentials': 'include'
    })
      .then( (res) => res.json() )
      .then( (res) => ( res.status === 'success' ? Promise.resolve() : Promise.reject(res.error) ) )
      .then( () => {
        this.load();
      })
      .catch( (err) => { console.log(`course detail add error: ${err}`, err); });
  }

  remove() {
    let data = new URLSearchParams();
    data.append('course_id', this.courseId);

    let loadRequest = fetch('/curriculum/remove', {
      'method': 'POST',
      'body': data,
      'credentials': 'include'
    })
      .then( (res) => res.json() )
      .then( (res) => ( res.status === 'success' ? Promise.resolve() : Promise.reject(res.error) ) )
      .then( () => {
        this.load();
      })
      .catch( (err) => { console.log(`course detail add error: ${err}`, err); });
  }
};

CourseDetailDispatcher.register( (payload) => {
  switch (payload.actionType) {
  case 'create-notify':
    CourseDetailStore.createNotify(payload.data);
    break;

  case 'add-course':
    CourseDetailStore.add();
    break;

  case 'remove-course':
    CourseDetailStore.remove();
    break;
  };
});

export default CourseDetailStore;
