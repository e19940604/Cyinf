import React from 'react';

let ScheduleItem = React.createClass({
  'render': function () {
    return (
      <tr>
        <td>{this.props.scheduleName}</td>
        <td className={this.props.courses[0].className}>{this.props.courses[0].name}</td>
        <td className={this.props.courses[1].className}>{this.props.courses[1].name}</td>
        <td className={this.props.courses[2].className}>{this.props.courses[2].name}</td>
        <td className={this.props.courses[3].className}>{this.props.courses[3].name}</td>
        <td className={this.props.courses[4].className}>{this.props.courses[4].name}</td>
        <td className={this.props.courses[5].className}>{this.props.courses[5].name}</td>
        <td className={this.props.courses[6].className}>{this.props.courses[6].name}</td>
      </tr>
    )}
})

let Curriculum = React.createClass({

  'getInitialState': function () {
    return {
      'courses': [
        {
          'schedule': [ [1, 1], [2, 1], [3, 1] ],
          'name': '跨領域文',
          'className': 'blueClass'
        }
      ]
    };
  },

  'render': function () {
    let courseSchedule = Array(14).fill().map( () => {
      return Array(7).fill().map( () => ({'name': '', 'className': ''}) );
    });

    this.state.courses.forEach( (course) => {
      course.schedule.forEach( (e) => {
        courseSchedule[ e[0] ][ e[1] ].name = course.name;
        courseSchedule[ e[0] ][ e[1] ].className = course.className;
      });
    });

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
