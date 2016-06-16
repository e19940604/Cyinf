import React from 'react';
import CourseDetailPartial from '../layout/courseDetailPartial';
import mainLayout from '../layout/mainLayout';

import CourseDetailDispatcher from '../dispatchers/courseDetail';
import CourseDetailStore from '../stores/courseDetail';

let courseId = location.pathname.match(/\/(\d+)\/?$/);
if (courseId) courseId = courseId[1];

CourseDetailStore.load(courseId);

let CourseDetail = React.createClass({
  'render': function () {
    return (
      <div id="container">
        <CourseDetailPartial
          onLoad={CourseDetailStore.onLoad.bind(CourseDetailStore)}
          removeOnLoad={CourseDetailStore.removeOnLoad.bind(CourseDetailStore)}
          onCreateNotify={CourseDetailStore.onCreateNotify.bind(CourseDetailStore)}
          removeOnCreateNotify={CourseDetailStore.removeOnCreateNotify.bind(CourseDetailStore)}
        />
      </div>
    );
  }
});

mainLayout(CourseDetail);
