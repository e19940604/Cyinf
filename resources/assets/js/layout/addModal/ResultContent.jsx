import React from 'react';

let ResultItem = React.createClass({
  'onClickAction': function () {
    // nop
  },
  'render': function () {
    return (
      <tr>
        <td data-title="課程名稱">{this.props.courseName}</td>
        <td data-title="授課教師">{this.props.teacher}</td>
        <td data-title="開課系所">{this.props.department}</td>
        <td data-title="上課星期">{this.props.weekday}</td>
        <td data-title="上課時間">{this.props.time}</td>
        <td data-title="上課地點">{this.props.place}</td>
        <td onClick={this.onClickAction}>
          <span className={'desk-only mod-result-icon glyphicon cursor-pointer glyphicon-' + (this.props.action === 'add' ? 'plus-sign' : 'remove-circle')} aria-hidden="true"></span>
          <button className="m-only add-result-btn">刪除課程</button>
        </td>
      </tr>
    );
  }
});

let ResultContent = React.createClass({
  'getInitialState': function () {
    return {
      'resultStore': [
        {
          'courseName': '服務學習（三）：萬安部落原住民學童課輔服務',
          'teacher': '梁慧玫',
          'department': '服務學習',
          'weekday': 'Tue, Fri',
          'time': '34, 23',
          'place': '理SC 2001',
          'action': 'add'
        },
        {
          'courseName': '服務學習（三）：萬安部落原住民學童課輔服務',
          'teacher': '梁慧玫',
          'department': '服務學習',
          'weekday': 'Tue, Fri',
          'time': '34, 23',
          'place': '理SC 2001',
          'action': 'add'
        },
        {
          'courseName': '服務學習（三）：萬安部落原住民學童課輔服務',
          'teacher': '梁慧玫',
          'department': '服務學習',
          'weekday': 'Tue, Fri',
          'time': '34, 23',
          'place': '理SC 2001',
          'action': 'remove'
        }
      ]
    };
  },
  'render': function () {
    return (
      <div className="mod-add-result">
        <table id="mod-add-table">
          <thead>
            <tr>
              <th className="col">課程名稱</th>
              <th className="col">授課教師</th>
              <th className="col">開課系所</th>
              <th className="col">上課時間</th>
              <th className="col">上課星期</th>
              <th className="col">上課地點</th>
              <th className="col">加入課程</th>
            </tr>
          </thead>
          <tbody>

          {this.state.resultStore.map( (e, i) => <ResultItem {...e} index={i} /> )}

          </tbody>
        </table>
      </div>
    );
  }
});

export default ResultContent;
