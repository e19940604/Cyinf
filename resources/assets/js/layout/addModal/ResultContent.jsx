import React from 'react';
import ModalDispatcher from '../../dispatchers/modals';

let ResultItem = React.createClass({
  'onClickAction': function () {
    ModalDispatcher.dispatch({
      'actionType': this.props.add ? 'add-course' : 'remove-course',
      'data': this.props.course_id
    });
  },
  'render': function () {
    return (
      <tr>
        <td data-title="課程名稱">{this.props.courseName}</td>
        <td data-title="授課教師">{this.props.teacher}</td>
        <td data-title="開課系所">{this.props.department}</td>
        <td data-title="上課星期">{this.props.weekday}</td>
        <td data-title="上課時間">{this.props.time}</td>
        <td data-title="上課地點">{this.props.place}</td>
        <td onClick={this.onClickAction}>
          <span
            className={
              'desk-only mod-result-icon glyphicon cursor-pointer' +
              (this.props.add    ? ' glyphicon-plus-sign'     : '') +
              (this.props.remove ? ' glyphicon-remove-circle' : '')
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
      'result': []
    };
  },
  'componentWillMount': function () {
    this.props.onGetResult( (result) => {
      this.setState({ 'result': result });
    });
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

          {this.state.result.map( (e, i) => <ResultItem {...e} index={i} /> )}

          </tbody>
        </table>
      </div>
    );
  }
});

export default ResultContent;
