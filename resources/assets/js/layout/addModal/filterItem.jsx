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
    this.props.changeKey(e.target.value);
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
  'deList': [
    '國語文',
    '英文初級',
    '英文中級',
    '英文中高級',
    '英文高級',
    '運動與健康',
    '興趣選修',
    '通識教育',
    '應用性課程',
    '普通物理小組',
    '跨院（通）',
    '跨院（文）',
    '跨院（理）',
    '跨院（工）',
    '跨院（管）',
    '跨院（海）',
    '跨院（社）',
    '服務學習',
    '中文系（CL）',
    '外文系（DFLL）',
    '文學院（LIBA）',
    '音樂系（MUSI）',
    '哲學碩（PHIL）',
    '劇藝系（TA）',
    '生科系（BIOS）',
    '生醫碩（IMBS）',
    '化學系（CHE）',
    '物理系（PHYS）',
    '應數系（MATH）',
    '電機系（EE）',
    '電力碩（IMPE）',
    '通訊碩（ICE）',
    '機電系（MEME）',
    '資工系（CSE）',
    '光電系（EO）',
    '材光系（MOES）',
    '環工碩（ENVE）',
    '企管系（BM）',
    '資管系（MIS）',
    '財管系（FM）',
    '人管所（HRM）',
    '傳管所（ICM）',
    '政經系（PE）',
    '公事碩（PAM）',
    '政治碩（IPS）',
    '經濟碩（ECON）',
    '社會系（SOC）',
    '教育碩（IOE）',
    '亞太碩（CAPS）',
    '社科院（CSS）',
    '海工系（MAEV）',
    '海資系（MBR）',
    '（MRBI）',
    '海地化碩（IMGC）',
    '海事碩（MA）',
    '海下物碩（UTAO）',
    'BPM',
    'STP',
    '醫管學程（IHCM）',
    'IB',
    '海科系（OO）'
  ],

  'ti1List': [ 'Mon', 'Tue' ,'Wed', 'Thu', 'Fri', 'Sat', 'Sun' ],

  'ti2List': [ 'A', '1' ,'2', '3', '4', 'B', '5', '6', '7', '8', '9', 'C', 'D', 'E', 'F' ],

  'grList': [ '一年級', '二年級', '三年級', '四年級', '研究所' ],

  'plList': [
    '社SS',
    '管CM',
    '理SC',
    '理BI',
    '理PH',
    '理CH',
    '工EN',
    '工MS',
    '工EV',
    '工EC',
    '通GE',
    '海ME',
    '海MA',
    '海MB',
    '文FA',
    '文LA'
  ],

  'diList': [ '向度一', '向度二', '向度三', '向度四', '向度五', '向度六' ],

  'getInitialState': function () {
    return { 'value': this.props.value };
  },

  'componentWillMount': function () {
    this.deList =  this.deList.map(  (e, i) => <option value={i} key={i}>{e}</option> );
    this.ti1List = this.ti1List.map(    (e) => <option value={e} key={e}>{e}</option> );
    this.ti2List = this.ti2List.map(    (e) => <option value={e} key={e}>{e}</option> );
    this.grList =  this.grList.map(  (e, i) => <option value={i + 1} key={i + 1}>{e}</option> );
    this.plList =  this.plList.map(     (e) => <option value={e} key={e}>{e}</option> );
    this.diList =  this.diList.map(  (e, i) => <option value={i + 1} key={i+ 1}>{e}</option> );
  },

  'handleChange': function (e) {
    this.setState({ 'value': e.target.value });
    ModalDispatcher.dispatch({
      'actionType': 'add-update-filter',
      'data': [this.props.id, 'searchValue', e.target.value]
    });
  },

  'render': function () {
    let options;
    switch (this.props.searchKey) {
    case 'de':  options = this.deList;  break;
    case 'ti1': options = this.ti1List; break;
    case 'ti2': options = this.ti2List; break;
    case 'gr':  options = this.grList;  break;
    case 'pl':  options = this.plList;  break;
    case 'di':  options = this.diList;  break;
    }

    return (
      <select
        className="form-control mod-add-input mod-add-input-text filter-search-value"
        value={this.state.value}
        onChange={this.handleChange}
      >
        <option value=""></option>
        {options}
      </select>
    );
  }
});

let FilterItem = React.createClass({
  'getInitialState': function () {
    return { 'searchKey': this.props.searchKey };
  },

  'onClickRemoveFilter': function () {
    this.props.removeFilter(this.props.id);
  },

  'onChangeKey' : function (newKey) {
    this.setState({ 'searchKey': newKey });
  },

  'render': function () {
    return (
      <div className="mod-add-inputGroup course-filter">
        <span className="mod-text mod-add-text">條件</span>
        <div className="mod-add-inputBlock">

          <SearchKey value={this.props.searchKey} id={this.props.id} changeKey={this.onChangeKey} />
          <SearchValue value={this.props.searchValue} id={this.props.id} searchKey={this.state.searchKey} />

          <span className="mod-add-icon glyphicon glyphicon-minus-sign cursor-pointer" aria-hidden="true" onClick={this.onClickRemoveFilter}></span>
        </div>
      </div>
    );
  }
});

export default FilterItem;
