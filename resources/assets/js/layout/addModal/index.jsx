import React from 'react';
import FilterContent from './filterContent';
import ResultContent from './resultContent';
import ModalDispatcher from '../../dispatchers/modals';

let AddModal = React.createClass({
  'closeModal': function () {
    ModalDispatcher.dispatch({ 'actionType': 'close' });
  },

  'render': function () {
    return (
      <div id="add-modal" className="pinkModal mod">
        <img src="/Curr/img/close.png" className="closeBtn cursor-pointer" onClick={this.closeModal} />
        <div className="mod-content">
          <div className="mod-title">
            <h4 className="mod-title-text">搜尋課程</h4>
          </div>

          {
            this.props.mode === 'search' ?
              <FilterContent getFilters={this.props.getFilters} /> :
              <ResultContent onGetResult={this.props.onGetResult} />
          }

        </div>
      </div>
    );
  }
});

export default AddModal;
