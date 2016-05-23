import React from 'react';
import NotifyPartial from '../layout/notifyPartial';
import mainLayout from '../layout/mainLayout';

let Notify = React.createClass({
  'getInitialState': function () {
    return {
      'notifications': [
        {
          'id': 10,
          'imageUrl': '/curr/img/icon_c.svg',
          'content': '上課通知 - 9: 00 C程式設計(二) 工EC 5012',
          'create_at': '2016-04-27'
        },
        {
          'id': 9,
          'imageUrl': '/curr/img/icon_c.svg',
          'content': '上課通知 - 9: 00 C程式設計(二) 工EC 5012',
          'create_at': '2016-04-27'
        },
        {
          'id': 8,
          'imageUrl': '/curr/img/icon_c.svg',
          'content': 'test123',
          'create_at': '2016-04-26'
        },
        {
          'id': 7,
          'imageUrl': '/curr/img/icon_c.svg',
          'content': '測試',
          'create_at': '2016-04-25'
        }
      ]
    };
  },
  'render': function () {
    return (
      <div id="container" className="notify-container">
        <NotifyPartial notifications={this.state.notifications} />
      </div>
    );
  }
});

mainLayout(Notify);
