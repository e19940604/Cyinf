import {EventEmitter} from 'events';
import ModalDispatcher from '../dispatchers/modals';
import CurriculumDispatcher from '../dispatchers/curriculum';

let AddModalStore = new class extends EventEmitter {
  constructor() {
    super();
    this.active = false;
    this.mode = 'search';

    this.filters = new Map();
    this.filterKey = 2;
    this.filters.set(0, { 'searchKey': 'de',  'searchValue': '' });
    this.filters.set(1, { 'searchKey': 'ti1', 'searchValue': 'Tue'      });

    this.results = [];
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

    let filters = [...this.filters.values()]
      .filter( (e) => e.searchKey.trim() && e.searchValue.trim() )
      .reduce( (p, c) => {
        let value = ['de', 'gr', 'di'].some( (e) => (e === c.searchKey) ) ? parseInt(c.searchValue, 10) : c.searchValue;
        if (p[c.searchKey]) p[c.searchKey].push(value);
        else p[c.searchKey] = [value];
        return p;
      }, {});

    let data = new FormData();
    data.append('rule', JSON.stringify(filters));

    let searchRequest = fetch('/curriculum/search', { 'method': 'POST', 'body': data, 'credentials': 'include' })
      .then( (res) => res.json() )
      .then( (res) => ( res.status === 'success' ? Promise.resolve(res.data) : Promise.reject(res.error) ) );

    searchRequest.then( (data) => {
      this.results = data;
      this.emit('result', data);
    });

    this.emit('search');
  }

  onSearch(callback) {
    this.on('search', callback);
  }

  onGetResults(callback) {
    this.on('result', callback);
  }

  removeOnGetResults(callback) {
    this.removeListener('result', callback);
  }

  clearResults() {
    this.mode = 'search';
    this.results = [];
    this.emit('clear-results');
  }

  onClearResults(callback) {
    this.on('clear-results', callback);
  }

  getMode() {
    return this.mode;
  }

  getFilters() {
    return this.filters;
  }

  getResults() {
    return this.results;
  }

  addFilter() {
    this.filters.set(this.filterKey, { 'searchKey': '', 'searchValue': '' });
    ++this.filterKey;
  }

  updateFilter(key, type, value) {
    let filter = this.filters.get(key);
    if (!filter) return;

    if (type === 'searchKey' && filter.searchKey !== value) {
      let newFilter = { 'searchKey': value, 'searchValue': '' };
      this.filters.set(key, newFilter);
    }
    else if (type === 'searchValue' && filter.searchValue !== value) {
      let newFilter = { 'searchKey': filter.searchKey, 'searchValue': value };
      this.filters.set(key, newFilter);
    }
  }

  removeFilter(key) {
    if (!this.filters.has(key)) return;

    this.filters.delete(key);
  }

  addCourse(index) {
    let result = this.results[index];
    result.add = false;
    result.remove = true;
    CurriculumDispatcher.dispatch({ 'actionType': 'add-course', 'data': result.course_id });
  }

  removeCourse(index) {
    let result = this.results[index];
    result.add = true;
    result.remove = false;
    CurriculumDispatcher.dispatch({ 'actionType': 'remove-course', 'data': result.course_id });
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

  case 'add-add-course':
    AddModalStore.addCourse(payload.data);
    break;

  case 'add-remove-course':
    AddModalStore.removeCourse(payload.data);
    break;

  case 'add-clear-result':
    AddModalStore.clearResults();
    break;

  };
});

export default AddModalStore;
