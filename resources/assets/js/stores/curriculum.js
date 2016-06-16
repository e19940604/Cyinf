import {EventEmitter} from 'events';
import CurriculumDispatcher from '../dispatchers/curriculum';

let CurriculumStore = new class extends EventEmitter {
  constructor() {
    super();
    this.courses = [];
  }

  load() {
    let loadRequest = fetch('/curriculum/schedule', { 'credentials': 'include' })
      .then( (res) => res.json() )
      .then( (res) => ( res.status === 'success' ? Promise.resolve(res.data) : Promise.reject(res.error) ) );

    loadRequest.then( (data) => {
      this.update(data);
      this.emit('load');
    });
  }

  onLoad(callback) {
    this.on('load', callback);
  }

  update(courses) {
    this.courses = courses;
    this.emit('update', this.courses);
  }

  onUpdate(callback) {
    this.on('update', callback);
  }

  add(courseId) {
    let data = new URLSearchParams();
    data.append('course_id', courseId);

    let loadRequest = fetch('/curriculum/add', {
      'method': 'POST',
      'body': data,
      'credentials': 'include'
    })
      .then( (res) => res.json() )
      .then( (res) => ( res.status === 'success' ? Promise.resolve(res.data) : Promise.reject(res.error) ) );

    loadRequest.then( (data) => {
      this.update(data);
    });
  }

  remove(courseId) {
    let data = new URLSearchParams();
    data.append('course_id', courseId);

    let loadRequest = fetch('/curriculum/remove', {
      'method': 'POST',
      'body': data,
      'credentials': 'include'
    })
      .then( (res) => res.json() )
      .then( (res) => ( res.status === 'success' ? Promise.resolve(res.data) : Promise.reject(res.error) ) );

    loadRequest.then( (data) => {
      this.update(data);
    });
  }

  removeOnLoad(callback) {
    this.removeListener('load', callback);
  }

  removeOnUpdate(callback) {
    this.removeListener('update', callback);
  }

  getCourses(callback) {
    return this.courses;
  }
};

CurriculumDispatcher.register( (payload) => {
  switch (payload.actionType) {
  case 'course-detail':
    // CurriculumStore.courseDetail(payload.data);
    break;

  case 'add-course':
    CurriculumStore.add(payload.data);
    break;

  case 'remove-course':
    CurriculumStore.remove(payload.data);
    break;
  }
});

export default CurriculumStore;
