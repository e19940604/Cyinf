import React from 'react';
import CurriculumDsipatcher from '../dispatchers/curriculum';

let ScheduleItem = React.createClass({
  'onClickCourse': function (course) {
    if (course.course_id) CurriculumDsipatcher.dispatch({ 'actionType': 'course-detail', 'data': course.course_id });
  },

  'render': function () {
    let courses = this.props.courses;
    return (
      <tr>
        <td>{this.props.scheduleName}</td>
        <td className={courses[0].className} onClick={this.onClickCourse.bind(this, courses[0])}>{courses[0].course_name}</td>
        <td className={courses[1].className} onClick={this.onClickCourse.bind(this, courses[1])}>{courses[1].course_name}</td>
        <td className={courses[2].className} onClick={this.onClickCourse.bind(this, courses[2])}>{courses[2].course_name}</td>
        <td className={courses[3].className} onClick={this.onClickCourse.bind(this, courses[3])}>{courses[3].course_name}</td>
        <td className={courses[4].className} onClick={this.onClickCourse.bind(this, courses[4])}>{courses[4].course_name}</td>
        <td className={courses[5].className} onClick={this.onClickCourse.bind(this, courses[5])}>{courses[5].course_name}</td>
        <td className={courses[6].className} onClick={this.onClickCourse.bind(this, courses[6])}>{courses[6].course_name}</td>
      </tr>
    )
  }
})

let Curriculum = React.createClass({
  'getInitialState': function () {
    return { 'courses': [] };
  },

  'updateCurriculum': function (data) {
    this.setState({ 'courses': data });
  },

  'componentWillMount': function () {
    this.props.onUpdate(this.updateCurriculum);
  },

  'componentWillUnmount': function () {
    this.props.removeOnUpdate(this.updateCurriculum);
  },

  'render': function () {
    let courses = this.state.courses;
    let courseSchedule = Array(14).fill().map( () => Array(7).fill().map( () => Object() ) );

    for (const course of courses) {
      course.schedule.forEach( (e) => {
        courseSchedule[ e[0] ][ e[1] ].course_name = course.course_name;
        courseSchedule[ e[0] ][ e[1] ].course_id = course.course_id;
        courseSchedule[ e[0] ][ e[1] ].className = 'blueClass';
      });
    }

    return (
      <div id="curriculum">
        <div id="table-scroll">
          <table>
            <thead>
              <tr>
                <th></th>
                <th>一</th>
                <th>二</th>
                <th>三</th>
                <th>四</th>
                <th>五</th>
                <th>六</th>
                <th>日</th>
              </tr>
            </thead>
            <tbody>
              <ScheduleItem scheduleName="A" courses={courseSchedule[0]} />
              <ScheduleItem scheduleName="1" courses={courseSchedule[1]} />
              <ScheduleItem scheduleName="2" courses={courseSchedule[2]} />
              <ScheduleItem scheduleName="3" courses={courseSchedule[3]} />
              <ScheduleItem scheduleName="4" courses={courseSchedule[4]} />
              <ScheduleItem scheduleName="B" courses={courseSchedule[5]} />
              <ScheduleItem scheduleName="5" courses={courseSchedule[6]} />
              <ScheduleItem scheduleName="6" courses={courseSchedule[7]} />
              <ScheduleItem scheduleName="7" courses={courseSchedule[8]} />
              <ScheduleItem scheduleName="8" courses={courseSchedule[9]} />
              <ScheduleItem scheduleName="9" courses={courseSchedule[10]} />
              <ScheduleItem scheduleName="C" courses={courseSchedule[11]} />
              <ScheduleItem scheduleName="D" courses={courseSchedule[12]} />
              <ScheduleItem scheduleName="E" courses={courseSchedule[13]} />
            </tbody>
          </table>
        </div>
      </div>
    );
  }
});

export default Curriculum;
