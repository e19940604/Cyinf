import React from 'react';

let NotifyItem = React.createClass({
  'render': function () {
    return (
      <span className="list">
        <img src={this.props.imageUrl} className="icon" />
        <span className="desc">{this.props.content}</span>
      </span>
    );
  }
});

let NotifyPartial = React.createClass({
  'updateNotify': function () {
    this.forceUpdate();
  },

  'componentWillMount': function () {
    this.props.onUpdate(this.updateNotify);
  },

  'componentWillUnmount': function () {
    this.props.removeOnUpdate(this.updateNotify);
  },

  'render': function () {
    let notificationGroup = this.props.getNotifications().reduce( (p, c) => {
      if (!p[c.created_at]) p[c.created_at] = [<NotifyItem {...c} key={c.id} />];
      else p[c.created_at].push(<NotifyItem {...c} key={c.id} />);
      return p;
    }, {});

    let notifications = [];
    for (let key of Object.keys(notificationGroup)) {
      notifications.push(
        <div key={key}>
          <div className="date">{key}</div>
          {notificationGroup[key].reverse()}
        </div>
      );
    }

    return (
      <div className="content">
        <p className="title"><a href="/curriculum/notification">所有通知</a></p>

        {notifications.reverse()}

      </div>
    );
  }
});

export default NotifyPartial;
