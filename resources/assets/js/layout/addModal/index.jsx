import React from 'react';
import FilterContent from './filterContent';
import ResultContent from './resultContent';
import ModalDispatcher from '../../dispatchers/modals';

let AddModal = React.createClass({
  'closeModal': function () {
    ModalDispatcher.dispatch({ 'actionType': 'close' });
  },

  'onClickReturn': function () {
    ModalDispatcher.dispatch({ 'actionType': 'add-clear-result' });
  },

  'render': function () {
    return (
      <div id="add-modal" className="pinkModal mod">
        <img src="/Curr/img/close.png" className="closeBtn cursor-pointer" onClick={this.closeModal} />
        <div className="mod-content">
          <div className="mod-title">
            {
              this.props.mode === 'result' ?
                <div className="cursor-pointer" style={{'float': 'left', 'fontSize': '30px', 'margin': '20px', 'lineHeight': '1.1', 'color': '#fbfbfb' }} onClick={this.onClickReturn}><i className="fa fa-chevron-circle-left" aria-hidden="true"></i></div> :
                ''
            }
            <h4 className="mod-title-text">搜尋課程</h4>
          </div>

          {
            this.props.mode === 'search' ?
              <FilterContent {...this.props} /> :
              <ResultContent {...this.props} />
          }

        </div>
      </div>
    );
  }
});

export default AddModal;
