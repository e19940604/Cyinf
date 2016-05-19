import React from 'react';
import FilterContent from './filterContent';
import ResultContent from './resultContent';

let AddModal = React.createClass({
  'getInitialState': function () {
    return {
      'mode': 'search'
    };
  },
  'search': function () {
    this.setState({ 'mode': 'result' });
  },
  'closeModal': function () {
    this.props.unmount();
    $('#blackBG').addClass('visibility-hidden');
  },
  'render': function () {
    return (
      <div id="add-modal" className="pinkModal mod">
        <img src="/Curr/img/close.png" className="closeBtn cursor-pointer" onClick={this.closeModal} />
        <div className="mod-content">
          <div className="mod-title">
            <h4 className="mod-title-text">搜尋課程</h4>
          </div>

          { this.state.mode === 'search' ? <FilterContent search={this.search} /> : <ResultContent /> }

        </div>
      </div>
    );
  }
});

export default AddModal;
