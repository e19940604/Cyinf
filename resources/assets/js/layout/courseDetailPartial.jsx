import React from 'react';
import CourseDetailDispatcher from '../dispatchers/courseDetail';

let CourseDetailPartial = React.createClass({
  'getInitialState': function () {
    return {};
  },

  'onClickCallNotify': function () {
    if (this.state.lockCall) return;

    this.setState({ 'lockCall': true });
    CourseDetailDispatcher.dispatch({ 'actionType': 'create-notify', 'data': 1 });
  },

  'onClickTestNotify': function () {
    if (this.state.lockTest) return;

    this.setState({ 'lockTest': true });
    CourseDetailDispatcher.dispatch({ 'actionType': 'create-notify', 'data': 2 });
  },

  'onClickAddRemove': function () {
    if (this.state.lockAddRemove) return;

    this.setState({ 'lockAddRemove': true });
    CourseDetailDispatcher.dispatch({ 'actionType': `${this.state.add ? 'add' : 'remove'}-course` });
  },

  'onLoadCourse': function (data) {
    this.replaceState(data);
  },

  'onCreateNotify': function (err, type) {
    if (err) {
      alert(`發送${type === 1 ? '點名' : '考試'}通知失敗：\n${err}`);
      console.log(`發送${type === 1 ? '點名' : '考試'}通知失敗：\n${err}`, err);

      if (type === 1) this.setState({ 'createCallFail': true });
      else this.setState({ 'createTestFail': true });
    }
    else {
      if (type === 1) this.setState({ 'createCallSuccess': true });
      else this.setState({ 'createTestSuccess': true });
    }
  },

  'componentWillMount': function () {
    this.props.onLoad(this.onLoadCourse);
    this.props.onCreateNotify(this.onCreateNotify);
  },

  'componentWillUnmount': function () {
    this.props.removeOnLoad(this.onLoadCourse);
    this.props.removeOnCreateNotify(this.onCreateNotify);
  },

  'render': function () {
    return (
      <div className="courseDetail-container">
        <div className="content">
          <p className="title">{this.state.course_name}</p>
          <span className="list">
            <span className="icon"><i className="fa fa-microphone" aria-hidden="true"></i></span>
            <span className="desc">授課教師</span>
            <span className="content">{this.state.professor}</span>
          </span>
          <span className="list">
            <span className="icon"><i className="fa fa-map-marker" aria-hidden="true"></i></span>
            <span className="desc">教室位置</span>
            <span className="content">{this.state.place}</span>
          </span>
          <span className="list">
            <span className="icon"><i className="fa fa-clock-o" aria-hidden="true"></i></span>
            <span className="desc">上課時間</span>
            <span className="content">{this.state.week_day && this.state.week_day.map( (e, i) => e + ' ' + this.state.time[i] ).join(', ')}</span>
          </span>
          <span className="list">
            <span className="icon"><i className="fa fa-university" aria-hidden="true"></i></span>
            <span className="desc">開課系所</span>
            <span className="content">{this.state.course_department}</span>
          </span>
          <span className="list">
            <span className="icon"><i className="fa fa-money" aria-hidden="true"></i></span>
            <span className="desc">課程學分</span>
            <span className="content">{this.state.unit}</span>
          </span>
          <div className="btn-collect">
            <a href={`/course/${this.state.course_id}`}><span className="btn-list blue-btn">課程評鑑</span></a>
            <span className="btn-list pink-btn" onClick={this.onClickCallNotify}>發送點名通知
            {
              this.state.createCallFail ?
                '失敗' :
                (this.state.createCallSuccess ?
                  '成功' :
                    (this.state.lockCall ? '中...' : '') )
            }
            </span>
            <span className="btn-list mi-btn" onClick={this.onClickTestNotify}>發送考試通知
            {
              this.state.createTestFail ?
                '失敗' :
                (this.state.createTestSuccess ?
                  '成功' :
                    (this.state.lockTest ? '中...' : '') )
            }
            </span>
            <span className="btn-list mi-btn" onClick={this.onClickAddRemove}>
            {
              this.state.add ?
                (this.state.lockAddRemove ? '新增中...' : '新增至課表') :
                (this.state.lockAddRemove ? '移除中...' : '從課表移除')
            }
            </span>
          </div>
        </div>
      </div>
    );
  }
});

export default CourseDetailPartial;
