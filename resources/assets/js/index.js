var React = require('react');
var ReactDOM = require('react-dom');



/*
 * Layout.blade component
 */
var SideBar = React.createClass({
    render: function() {
        return (
            <div id="profile">
                <ul>
                    <li id="note" >
                        <i className="fa fa-bell-o"></i>
                    </li>
                    <li id="m-sidebtn" className="m-only" >
                        <i className="fa fa-bars"></i>
                    </li>
                    <li className="desk-only"> | </li>
                    <li id="fb-icon" className="desk-only">
                        <a href="#"><img src={ this.props.pic } /></a>
                    </li>
                    <li className="desk-only"> | </li>
                    <li id="fb-name" className="desk-only">
                        <a href="#">{ this.props.name }</a>
                    </li>
                </ul>
            </div>
        );
    }
});

var Header = React.createClass({

    getInitialState: function() {
        return {
            profile_pic : "./img/no-user-image.gif" ,
            profile_name : "連結 FB"
        };
    },

    render: function() {
        return (
            <div id="hd-container" >
                <div id="title-wrap">
                    <img id="logo" src="./curr/img/icon_c.svg" />
                    <h3>urriculum</h3>
                </div>
                <SideBar pic={this.state.profile_pic} name={ this.state.profile_name }/>
            </div>
        );
    }
});

var Footer = React.createClass({
    render: function() {
        return (
            <div className="container">
                <h5>Copyright &copy; Cyinf Studio 2015 <p className="desk-only"> |  <a href="#" className="desk-only footer-link"><i className="fa fa-commenting-o"></i> 意見與反饋</a>  | <a href="#" className="desk-only footer-link"><i className="fa fa-question"></i> 使用教學</a></p></h5>
            </div>
        );
    }
});



/*
 * every page content component
 */


/*
 * modal up component
 */

ReactDOM.render( <Header /> , document.getElementById("header") );
ReactDOM.render( <Footer /> , document.getElementById("footer") );