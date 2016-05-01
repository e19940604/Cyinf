import React from 'react';
import mainLayout from '../layout/mainLayout';

let CourseDetail = React.createClass({
  render: function () {
    return (
      <div className="notify-container">
        <div className="content">
          <p className="title">Nana Mizuki Live Adventure</p>
          <div className="date">2016/04/27</div>
          <span className="list">
            <img src="/curr/img/icon_c.svg" className="icon"/>
            <span className="desc">上課通知 - 9:00 C程式設計(二) 工EC 5012</span>

          </span>
          <span className="list">
            <img src="/curr/img/icon_c.svg" className="icon"/>
            <span className="desc">上課通知 - 9:00 C程式設計(二) 工EC 5012</span>
          </span>
        </div>
      </div>
    );
  }
});

mainLayout(CourseDetail);
