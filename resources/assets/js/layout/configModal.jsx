import React from 'react';

let ConfigModal = React.createClass({
  'closeModal': function () {
    this.props.unmount();
    $('#blackBG').addClass('visibility-hidden');
  },

  'onClickSwitch': function (e) {
    let checkbox = $('#' + $(e.target).parent('label').attr('for'));
    checkbox.prop('checked', !checkbox.prop('checked'));
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
                <input type="checkbox" name="onoffswitch" className="onoffswitch-checkbox" id="switch1" defaultChecked={this.props.classNote} />
                <label className="onoffswitch-label" htmlFor="switch1">
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
                <input type="checkbox" name="onoffswitch" className="onoffswitch-checkbox" id="switch2" defaultChecked={this.props.goClassNote} />
                <label className="onoffswitch-label" htmlFor="switch2">
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
                <input type="checkbox" name="onoffswitch" className="onoffswitch-checkbox" id="switch3" defaultChecked={this.props.testNote} />
                <label className="onoffswitch-label" htmlFor="switch3">
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
