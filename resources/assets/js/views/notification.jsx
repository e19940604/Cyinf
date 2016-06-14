import React from 'react';
import NotifyPartial from '../layout/notifyPartial';
import mainLayout from '../layout/mainLayout';
import NotificationDispatcher from '../dispatchers/notification';
import NotificationStore from '../stores/notification';

NotificationStore.load();
let Notification = React.createClass({
  'render': function () {
    return (
      <div id="container" className="notify-container">
        <NotifyPartial
          onUpdate={NotificationStore.onUpdate.bind(NotificationStore)}
          removeOnUpdate={NotificationStore.removeOnUpdate.bind(NotificationStore)}
          getNotifications={NotificationStore.getNotifications.bind(NotificationStore)}
        />
      </div>
    );
  }
});

mainLayout(Notification);
