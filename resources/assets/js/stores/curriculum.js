import {EventEmitter} from 'events';
import CurriculumDispatcher from '../dispatchers/curriculum';

let CurriculumStore = new class extends EventEmitter {
  constructor() {
    super();
    this.courses = [];
    this.loadRequest = undefined;
  }

  load() {
    this.loadRequest = new Promise( (resolve, reject) => {
      setTimeout( () => {
        resolve([
          {
            'schedule': [ [1, 1], [2, 1], [3, 1] ],
            'course_name': '演算法',
            'course_id': 123,
            'className': 'blueClass'
          },
          {
            'schedule': [ [6, 4], [7, 4], [2, 5] ],
            'course_name': '微積分（一）',
            'course_id': 456,
            'className': 'blueClass'
          }
        ]);
      }, 2000);
    });

    this.loadRequest.then( (data) => {
      this.courses = data;
      this.emit('load');
    });
  }

  onLoad(callback) {
    this.on('load', callback);
  }

  removeOnLoad(callback) {
    this.removeListener('load', callback);
  }

  getCourses(callback) {
    return this.courses;
  }

  courseDetail(courseId) {
    console.log(courseId);
  }
};

CurriculumDispatcher.register( (payload) => {
  switch (payload.actionType) {
  case 'course-detail':
    CurriculumStore.courseDetail(payload.data);
    break;
  }
});

export default CurriculumStore;
