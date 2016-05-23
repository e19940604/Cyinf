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
  'render': function () {
    let notificationGroup = this.props.notifications
      .reduce( (p, c) => {
        if (!p[c.create_at]) p[c.create_at] = [<NotifyItem {...c} key={c.id} />];
        else p[c.create_at].push(<NotifyItem {...c} key={c.id} />);
        return p;
      }, {});

    let notifications = [];
    for (let key of Object.keys(notificationGroup)) {
      notifications.push(
        <div key={key}>
          <div className="date">{key}</div>
          {notificationGroup[key]}
        </div>
      );
    }

    return (
      <div className="content">
        <p className="title">所有通知</p>

        {notifications}

      </div>
    );
  }
});

export default NotifyPartial;
