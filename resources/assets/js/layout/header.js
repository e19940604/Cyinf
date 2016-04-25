var React = require('react');

var SideBar = React.createClass({
    render: function() {
        return (
            <div id="profile">
                <ul>
                    <li id="note" >
                        <i className="fa fa-bell-o"></i>
                    </li>
                    <li id="m-sidebtn" className="m-only" >
                        <i id="m-side" className="fa fa-bars"></i>
                    </li>
                    <li className="desk-only"> | </li>
                    <li id="fb-icon" className="desk-only">
                        <a href="#" ><img className="img-circle"  src={ this.props.pic } /></a>
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

module.exports = Header;