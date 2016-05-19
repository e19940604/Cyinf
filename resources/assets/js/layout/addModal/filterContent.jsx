import React from 'react';
import ReactDOM from 'react-dom';

let FilterItem = React.createClass({
  'onClickRemove': function () {
    this.props.remove(this.props.index);
  },

  'onChangeKey': function () {
    // nop
  },

  'onChangeValue': function () {
    // nop
  },

  'render': function () {
    console.log(this.props);
    return (
      <div className="mod-add-inputGroup course-filter">
        <span className="mod-text mod-add-text">條件</span>
        <div className="mod-add-inputBlock" >
          <select className="form-control mod-add-input mod-add-select course-filter-key" onChange={this.onChangeKey}>
            <option value=""></option>
            <option value="de">系所</option>
            <option value="ti1">星期</option>
            <option value="ti2">節次</option>
            <option value="gr">年級</option>
            <option value="pl">教室(大樓) </option>
            <option value="di">向度(通識教育) </option>
          </select>
          <input type="text" className="form-control mod-add-input mod-add-input-text course-filter-value" onChange={this.onChangeValue} />
          <span className="mod-add-icon glyphicon glyphicon-minus-sign cursor-pointer" aria-hidden="true" onClick={this.onClickRemove}></span>
        </div>
      </div>
    );
  }
});

let FilterContent = React.createClass({
  'filterKeyStart': 3,

  'getInitialState': function () {
    return {
      'filterKeys': [0, 1, 2]
    };
  },

  'remove': function (index) {
    let newFilterKeys = this.state.filterKeys.slice();
    newFilterKeys.splice(index, 1);
    this.setState({'filterKeys': newFilterKeys});
  },

  'onClickSearch': function () {
    this.props.search();
  },

  'onClickAddFilter': function () {
    ++this.filterKeyStart;
    let newFilterKeys = this.state.filterKeys.slice();
    newFilterKeys.push(this.filterKeyStart);
    this.setState({'filterKeys': newFilterKeys});
  },

  'render': function () {
    return (
      <div className="mod-add mod-item">

        {this.state.filterKeys.map( (key, index) => <FilterItem key={key} index={index} remove={this.remove} /> )}

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
