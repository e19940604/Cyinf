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
    console.log(`load course id: ${id}`);
    this.courseId = id;
    this.loadRequest = new Promise( (resolve, reject) => {
      setTimeout( () => {
        resolve({
          'course_id': 123,
          'course_name': 'Nana Mizuki Live Adventure',
          'course_department': '音樂系',
          'professor': '水樹奈奈',
          'place': '工EC 5012',
          'unit': 10,
          'add': true,
          'week_day': ['Mon', 'Tue'],
          'time': ['67', '8']
        });
      }, 1000);
    });

    this.loadRequest.then( (data) => {
      this.course = data;
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

  create(type) {
    console.log(`create ${type === 1 ? 'roll call' : 'test'} notify for ${this.courseId}`);
  }

  onCreate(callback) {
    this.on('create', callback);
  }
};

CourseDetailDispatcher.register( (payload) => {
  switch (payload.actionType) {
  case 'create-notify':
    CourseDetailStore.create(payload.data);
    break;
  };
});

export default CourseDetailStore;
