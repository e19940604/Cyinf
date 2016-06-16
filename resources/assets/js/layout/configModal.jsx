import React from 'react';
import ModalDispatcher from '../dispatchers/modals';

let ConfigModal = React.createClass({
  'getInitialState': function () {
    return {
      'switches': this.props.switches,
      'lock': [false, false, false]
    };
  },

  'updateSwitches': function (switches) {
    this.setState({ 'switches': switches });
  },

  'unlockSwitch': function (switchName) {
    let lockIndex = ['classNote', 'rollCallNote', 'testNote'].indexOf(switchName);
    let lock = Array.from(this.state.lock);
    lock[lockIndex] = false;

    this.setState({ 'lock': lock });
  },

  'closeModal': function () {
    ModalDispatcher.dispatch({ 'actionType': 'close' });
  },

  'handleClickSwitch': function (switchName, index) {
    if (this.state.lock[index]) return;
    this.state.lock[index] = true;
    ModalDispatcher.dispatch({ 'actionType': 'config-click-switch', 'data': switchName });
  },

  'componentWillMount': function () {
    this.props.onUpdate(this.updateSwitches);
    this.props.onSend(this.unlockSwitch);
  },

  'componentWillUnmount': function () {
    this.props.removeOnUpdate(this.updateSwitches);
    this.props.removeOnSend(this.unlockSwitch);
  },

  'render': function () {
    return (
      <div id="config-modal" className="blueModal mod">
        <img src="/Curr/img/close.png" className="closeBtn cursor-pointer" onClick={this.closeModal} />
        <div className="mod-content">
          <div className="mod-title">
            <h4 className="mod-title-text">通知設定</h4>
          </div>

          <div className="mod-config mod-item">
            <span className="mod-text mod-config-text">上課通知</span>
            <div className="switch mod-config-text">
              <div className="onoffswitch mod-switch">
                <input type="checkbox" name="onoffswitch" className="onoffswitch-checkbox" id="switch1" checked={this.state.switches.classNote} readOnly />
                <label className="onoffswitch-label" htmlFor="switch1" onClick={this.handleClickSwitch.bind(this, 'classNote', 0)}>
                  <span className="onoffswitch-inner"></span>
                  <span className="onoffswitch-switch"></span>
                </label>
              </div>
            </div>
          </div>

          <div className="mod-config mod-item">
            <span className="mod-text mod-config-text">點名通知</span>
            <div className="switch mod-config-text">
              <div className="onoffswitch mod-switch">
                <input type="checkbox" name="onoffswitch" className="onoffswitch-checkbox" id="switch2" checked={this.state.switches.rollCallNote} readOnly />
                <label className="onoffswitch-label" htmlFor="switch2" onClick={this.handleClickSwitch.bind(this, 'rollCallNote', 1)}>
                  <span className="onoffswitch-inner"></span>
                  <span className="onoffswitch-switch"></span>
                </label>
              </div>
            </div>
          </div>

          <div className="mod-config mod-item">
            <span className="mod-text mod-config-text">考試通知</span>
            <div className="switch mod-config-text">
              <div className="onoffswitch mod-switch">
                <input type="checkbox" name="onoffswitch" className="onoffswitch-checkbox" id="switch3" checked={this.state.switches.testNote} readOnly />
                <label className="onoffswitch-label" htmlFor="switch3" onClick={this.handleClickSwitch.bind(this, 'testNote', 2)}>
                  <span className="onoffswitch-inner"></span>
                  <span className="onoffswitch-switch"></span>
                </label>
              </div>
            </div>
          </div>


          <div className="mod-bg m-only">
            <img src="/Cyinf/img/CyinfLogo.png" />
          </div>
        </div>
      </div>
    );
  }
});

export default ConfigModal;
