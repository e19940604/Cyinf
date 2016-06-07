import React from 'react';
import ModalDispatcher from '../../dispatchers/modals';

let SearchKey = React.createClass({
  'getInitialState': function () {
    return { 'value': this.props.value };
  },

  'handleChange': function (e) {
    this.setState({ 'value': e.target.value });
    ModalDispatcher.dispatch({
      'actionType': 'add-update-filter',
      'data': [this.props.id, 'searchKey', e.target.value]
    });
  },

  'render': function () {
    return (
      <select
        className="form-control mod-add-input mod-add-select filter-search-key"
        value={this.state.value}
        onChange={this.handleChange}
      >
        <option value=""></option>
        <option value="de">系所</option>
        <option value="ti1">星期</option>
        <option value="ti2">節次</option>
        <option value="gr">年級</option>
        <option value="pl">教室(大樓) </option>
        <option value="di">向度(通識教育) </option>
      </select>
    );
  }
});

let SearchValue = React.createClass({
  'getInitialState': function () {
    return { 'value': this.props.value };
  },

  'handleChange': function (e) {
    this.setState({ 'value': e.target.value });
    ModalDispatcher.dispatch({
      'actionType': 'add-update-filter',
      'data': [this.props.id, 'searchValue', e.target.value]
    });
  },

  'render': function () {
    return (
      <input
        type="text"
        className="form-control mod-add-input mod-add-input-text filter-search-value"
        value={this.state.value}
        onChange={this.handleChange}
      />
    );
  }
});

let FilterItem = React.createClass({
  'onClickRemoveFilter': function () {
    this.props.removeFilter(this.props.id);
  },

  'render': function () {
    return (
      <div className="mod-add-inputGroup course-filter">
        <span className="mod-text mod-add-text">條件</span>
        <div className="mod-add-inputBlock">

          <SearchKey value={this.props.searchKey} id={this.props.id} />
          <SearchValue value={this.props.searchValue} id={this.props.id} />

          <span className="mod-add-icon glyphicon glyphicon-minus-sign cursor-pointer" aria-hidden="true" onClick={this.onClickRemoveFilter}></span>
        </div>
      </div>
    );
  }
});

let FilterContent = React.createClass({
  'filterKeyStart': 0,

  'initialFilters': undefined,


  'onClickSearch': function () {
    ModalDispatcher.dispatch({ 'actionType': 'add-search' });
  },

  'onClickAddFilter': function () {
    ModalDispatcher.dispatch({
      'actionType': 'add-add-filter'
    });
    this.forceUpdate();
  },

  'onClickRemoveFilter': function (key) {
    ModalDispatcher.dispatch({
      'actionType': 'add-remove-filter',
      'data': key
    });
    this.forceUpdate();
  },

  'render': function () {
    let filters = this.props.getFilters();
    let entries = filters.entries();
    let items = Array(filters.size).fill().map( () => {
      let [key, filter] = entries.next().value;

      return (
        <FilterItem
          key={key}
          id={key}
          removeFilter={this.onClickRemoveFilter}
          searchKey={filter.searchKey}
          searchValue={filter.searchValue}
        />
      );
    });

    return (
      <div className="mod-add mod-item">

        {items}

        <div className="mod-add-inputGroup">
          <div className="mod-add-inputBlock" onClick={this.onClickAddFilter}>
            <span className="mod-add-icon glyphicon glyphicon-plus-sign cursor-pointer" aria-hidden="true"></span>
          </div>
        </div>

        <div className="mod-add-inputGroup">
          <div className="mod-add-inputBlock" onClick={this.onClickSearch}>
            <i className="mod-add-icon mod-add-btn fa fa-arrow-circle-right cursor-pointer" aria-hidden="true"></i>
          </div>
        </div>

      </div>
    );
  }
});

export default FilterContent;
