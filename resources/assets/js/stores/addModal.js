import {EventEmitter} from 'events';
import ModalDispatcher from '../dispatchers/modals';

let AddModalStore = new class extends EventEmitter {
  constructor() {
    super();
    this.active = false;
    this.mode = 'search';
    this.searchRequest = undefined;
    this.filterKey = 2;

    this.filters = new Map();
    this.filters.set(0, { 'searchKey': 'de',  'searchValue': '資訊工程' });
    this.filters.set(1, { 'searchKey': 'ti1', 'searchValue': 'Tue'      });
    this.result = [];
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
      setTimeout( () => {
        resolve([
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
            'remove': true
          }
        ]);
      }, 1000);
    });
    this.emit('search');
  }

  onSearch(callback) {
    this.on('search', callback);
  }

  onGetResult(callback) {
    this.searchRequest.then(callback);
  }

  clearResult() {
    this.mode = 'search';
    this.result = [];
    this.searchRequest = undefined;
    this.emit('clear-result');
  }

  onClearResult(callback) {
    this.on('clear-result', callback);
  }

  getMode() {
    return this.mode;
  }

  getFilters() {
    return this.filters;
  }

  addFilter() {
    this.filters.set(this.filterKey, { 'searchKey': '', 'searchValue': '' });
    ++this.filterKey;
  }

  updateFilter(key, type, value) {
    let filter = this.filters.get(key);
    if (!filter) return;

    let newFilter = Object.assign({}, filter);
    newFilter[type] = value;
    this.filters.set(key, newFilter);
  }

  removeFilter(key) {
    if (!this.filters.has(key)) return;

    this.filters.delete(key);
  }
}

ModalDispatcher.register( (payload) => {
  switch (payload.actionType) {
  case 'add-add-filter':
    AddModalStore.addFilter();
    break;

  case 'add-update-filter':
    AddModalStore.updateFilter.apply(AddModalStore, payload.data);
    break;

  case 'add-remove-filter':
    AddModalStore.removeFilter(payload.data);
    break;

  case 'add-search':
    AddModalStore.search();
    break;

  case 'add-clear-result':
    AddModalStore.clearResult();
    break;
  };
});

export default AddModalStore;
