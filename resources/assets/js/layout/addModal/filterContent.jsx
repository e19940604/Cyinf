import React from 'react';
import ModalDispatcher from '../../dispatchers/modals';
import FilterItem from './filterItem';

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
