import React from 'react';
import mainLayout from '../layout/mainLayout';

let CourseDetail = React.createClass({
  render: function () {
    return (
      <div id="container">
        <div className="courseDetail-container">
          <div className="content">
            <p className="title">Nana Mizuki Live Adventure</p>
            <span className="list">
              <span className="icon"><i className="fa fa-microphone" aria-hidden="true"></i></span>
              <span className="desc">授課教師</span>
              <span className="content">水樹奈奈</span>
            </span>
            <span className="list">
              <span className="icon"><i className="fa fa-map-marker" aria-hidden="true"></i></span>
              <span className="desc">教室位置</span>
              <span className="content">工EC 5012</span>
            </span>
            <span className="list">
              <span className="icon"><i className="fa fa-clock-o" aria-hidden="true"></i></span>
              <span className="desc">上課時間</span>
              <span className="content">一 67, 二 8</span>
            </span>
            <span className="list">
              <span className="icon"><i className="fa fa-university" aria-hidden="true"></i></span>
              <span className="desc">開課系所</span>
              <span className="content">音樂系</span>
            </span>
            <span className="list">
              <span className="icon"><i className="fa fa-money" aria-hidden="true"></i></span>
              <span className="desc">課程學分</span>
              <span className="content">10</span>
            </span>
            <div className="btn-collect">
              <span className="btn-list blue-btn">課程評鑑</span>
              <span className="btn-list pink-btn">發送點名通知</span>
              <span className="btn-list mi-btn">發送考試通知</span>
            </div>
          </div>
        </div>
      </div>
    );
  }
});

mainLayout(CourseDetail);
