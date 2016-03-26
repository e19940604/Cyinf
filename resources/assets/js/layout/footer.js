var React = require('react');

var Footer = React.createClass({
    render: function() {
        return (
            <div className="container">
                <h5>Copyright &copy; Cyinf Studio 2015 <p className="desk-only"> |  <a href="#" className="desk-only footer-link"><i className="fa fa-commenting-o"></i> 意見與反饋</a>  | <a href="#" className="desk-only footer-link"><i className="fa fa-question"></i> 使用教學</a></p></h5>
            </div>
        );
    }
});

module.exports = Footer;