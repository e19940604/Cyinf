import React from 'react';
import mainLayout from '../layout/mainLayout';

let Curriculum = React.createClass({
    render: function () {
        return (
          <div id="curriculum">
              <div id="table-scroll">
                  <table >
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
                          <tr>
                              <td>A</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>1</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>2</td>
                              <td></td>
                              <td className="blueClass">跨領域文</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>3</td>
                              <td></td>
                              <td className="blueClass">跨領域文</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>4</td>
                              <td></td>
                              <td className="blueClass">跨領域文</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>B</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>5</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>6</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>7</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>8</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>9</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>C</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>D</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>E</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
        );
    }
});

let SideBtns = React.createClass({
  render: function () {
    return (
      <div id="sideBtns" className="desk-only">
          <div id="addCourseBtn" className="sideBtn pinkBtn">
              <span>新增</span>
          </div>
          <div id="configBtn" className="sideBtn blueBtn">
              <span>設定</span>
          </div>
          <div id="connectBtn" className="sideBtn orangeBtn">
              <span>連結</span>
          </div>
      </div>
    );
  }
});

let index = React.createClass({
  render: function () {
    return (
      <div id="container">
          <Curriculum />
          <SideBtns />
      </div>
    );
  }
});

mainLayout(index);
