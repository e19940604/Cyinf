import React from 'react';
import ModalDispatcher from '../../dispatchers/modals';

let ResultItem = React.createClass({
  'getInitialState': function () {
    return { 'add': this.props.add, 'remove': this.props.remove };
  },

  'onClickAction': function () {
    ModalDispatcher.dispatch({
      'actionType': this.props.add ? 'add-add-course' : 'add-remove-course',
      'data': this.props.index
    });

    this.setState({ 'add': !this.state.add, 'remove': !this.state.remove });
  },

  'render': function () {
    return (
      <tr>
        <td data-title="課程名稱">{this.props.course_name}</td>
        <td data-title="授課教師">{this.props.professor}</td>
        <td data-title="開課系所">{this.props.course_department}</td>
        <td data-title="上課星期">{this.props.week_day}</td>
        <td data-title="上課時間">{this.props.time}</td>
        <td data-title="上課地點">{this.props.place}</td>
        <td onClick={this.onClickAction}>
          <span
            className={
              'desk-only mod-result-icon glyphicon cursor-pointer' +
              (this.state.add    ? ' glyphicon-plus-sign'     : '') +
              (this.state.remove ? ' glyphicon-remove-circle' : '')
            }
            aria-hidden="true"
          ></span>
          <button className="m-only add-result-btn">刪除課程</button>
        </td>
      </tr>
    );
  }
});

let ResultContent = React.createClass({
  'getInitialState': function () {
    return {
      'results': this.props.getResults()
    };
  },

  'onGetResults': function (results) {
    this.setState({ 'results': results });
  },

  'componentWillMount': function () {
    this.props.onGetResults(this.onGetResults);
  },

  'componentWillUnmount': function () {
    this.props.removeOnGetResults(this.onGetResults);
  },

  'render': function () {
    return (
      <div className="mod-add-result">
        <table id="mod-add-table">
          <thead>
            <tr>
              <th className="col">課程名稱</th>
              <th className="col">授課教師</th>
              <th className="col">開課系所</th>
              <th className="col">上課時間</th>
              <th className="col">上課星期</th>
              <th className="col">上課地點</th>
              <th className="col">加入課程</th>
            </tr>
          </thead>
          <tbody>

          {this.state.results.map( (e, i) => <ResultItem {...e} index={i} key={e.course_id} /> )}

          </tbody>
        </table>
      </div>
    );
  }
});

export default ResultContent;
