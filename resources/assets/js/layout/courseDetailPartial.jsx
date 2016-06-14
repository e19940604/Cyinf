import React from 'react';
import CourseDetailDispatcher from '../dispatchers/courseDetail';

let CourseDetailPartial = React.createClass({
  'getInitialState': function () {
    return {};
  },

  'onClickFacingCourse': function () {
    CourseDetailDispatcher.dispatch({ 'actionType': 'facing-course' });
  },

  'onClickCallNotify': function () {
    CourseDetailDispatcher.dispatch({ 'actionType': 'create-notify', 'data': 1 });
  },

  'onClickTestNotify': function () {
    CourseDetailDispatcher.dispatch({ 'actionType': 'create-notify', 'data': 2 });
  },

  'onLoadCourse': function(data) {
    console.log(data);
    this.setState(data);
  },

  'componentWillMount': function () {
    this.props.onLoad(this.onLoadCourse);
  },

  'componentWillUnmount': function () {
    this.props.removeOnLoad(this.onLoadCourse);
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
            <span className="content">{this.state.week_day && this.state.week_day.map( (e, i) => e + this.state.time[i] ).join(', ')}</span>
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
            <span className="btn-list blue-btn" onClick={this.onClickFacingCourse}>課程評鑑</span>
            <span className="btn-list pink-btn" onClick={this.onClickCallNotify}>發送點名通知</span>
            <span className="btn-list mi-btn" onClick={this.onClickTestNotify}>發送考試通知</span>
          </div>
        </div>
      </div>
    );
  }
});

export default CourseDetailPartial;