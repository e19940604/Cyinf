import {EventEmitter} from 'events';
import ModalDispatcher from '../dispatchers/modals';

let AddModalStore = new class extends EventEmitter {
  constructor() {
    super();
    this.active = false;
    this.mode = 'search';
    this.searchRequest = undefined;
    this.filters = [
      { 'searchKey': 'de',  'searchValue': '資訊工程' },
      { 'searchKey': 'ti1', 'searchValue': 'Tue'     }
    ];
    this.result = [
      {
        'course_id': 123,
        'courseName': '服務學習（三）：萬安部落原住民學童課輔服務',
        'teacher': '梁慧玫',
        'department': '服務學習',
        'weekday': 'Tue, Fri',
        'time': '34, 23',
        'place': '理SC 2001',
        'add': true
      },
      {
        'course_id': 321,
        'courseName': '服務學習（三）：萬安部落原住民學童課輔服務',
        'teacher': '梁慧玫',
        'department': '服務學習',
        'weekday': 'Tue, Fri',
        'time': '34, 23',
        'place': '理SC 2001',
        'remove': true
      },
      {
        'course_id': 1234567,
        'courseName': '服務學習（三）：萬安部落原住民學童課輔服務',
        'teacher': '梁慧玫',
        'department': '服務學習',
        'weekday': 'Tue, Fri',
        'time': '34, 23',
        'place': '理SC 2001',
        'action': 'remove'
      }
    ];
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

  search() {
    this.mode = 'result';

    this.searchRequest = new Promise( (resolve, reject) => {
      setTimeout(resolve.bind(null, this.result), 1000);
    });
    this.emit('search');
  }

  onSearch(callback) {
    this.on('search', callback);
  }

  onGetResult(callback) {
    this.searchRequest.then(callback);
  }

  getMode() {
    return this.mode;
  }

  getFilters() {
    return this.filters;
  }

  addFilter() {
    this.filters.push({ 'searchKey': '', 'searchValue': '' });
  }

  updateFilter(type, index, value) {
    this.filters[index][type] = value;
  }

  removeFilter(index) {
    this.filters[index] = null;
    this.filters.splice(index, 1);
  }
}

ModalDispatcher.register( (payload) => {
  switch (payload.actionType) {
  case 'add-add-filter':
    AddModalStore.addFilter();
    break;

  case 'add-update-filter':
    AddModalStore.updateFilter(payload.data[0], payload.data[1], payload.data[2]);
    break;

  case 'add-remove-filter':
    AddModalStore.removeFilter(payload.data[0]);
    break;

  case 'add-search':
    AddModalStore.search();
    break;
  };
});

export default AddModalStore;
