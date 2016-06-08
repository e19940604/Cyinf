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
      'data': ['searchKey', this.props.index, e.target.value]
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
      'data': ['searchValue', this.props.index, this.state.value]
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
  'onClickRemove': function () {
    this.props.remove(this.props.index);
  },

  'render': function () {
    return (
      <div className="mod-add-inputGroup course-filter">
        <span className="mod-text mod-add-text">條件</span>
        <div className="mod-add-inputBlock">

          <SearchKey value={this.props.searchKey} index={this.props.index} />
          <SearchValue value={this.props.searchValue} index={this.props.index} />

          <span className="mod-add-icon glyphicon glyphicon-minus-sign cursor-pointer" aria-hidden="true" onClick={this.onClickRemove}></span>
        </div>
      </div>
    );
  }
});

let FilterContent = React.createClass({
  'filterKeyStart': 0,

  'initialFilters': undefined,

  '_removeItem': function (index) {
    let newFilterKeys = this.state.filterKeys.slice();
    newFilterKeys.splice(index, 1);
    this.setState({ 'filterKeys': newFilterKeys });

    ModalDispatcher.dispatch({
      'actionType': 'add-remove-filter',
      'data': index
    });
  },

  'onClickSearch': function () {
    ModalDispatcher.dispatch({ 'actionType': 'add-search' });
  },

  'onClickAddFilter': function () {
    ++this.filterKeyStart;
    let newFilterKeys = this.state.filterKeys.slice();
    newFilterKeys.push(this.filterKeyStart);
    this.setState({ 'filterKeys': newFilterKeys });

    ModalDispatcher.dispatch({
      'actionType': 'add-add-filter'
    });
  },

  'getInitialState': function () {
    return {
      'filterKeys': []
    };
  },

  'componentWillMount': function () {
    this.initialFilters = this.props.getFilters();
    this.setState({ 'filterKeys': Array(this.initialFilters.length).fill().map( () => ++this.filterKeyStart ) })
  },

  'render': function () {
    return (
      <div className="mod-add mod-item">

        {this.state.filterKeys.map( (key, index) => {
          return (
            <FilterItem
              key={key}
              index={index}
              remove={this._removeItem}
              searchKey={this.initialFilters[index].searchKey}
              searchValue={this.initialFilters[index].searchValue}
            />);
        }) }

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
