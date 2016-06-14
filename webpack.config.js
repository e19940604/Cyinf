var path = require( 'path' );

module.exports = {
    entry: {
        index: "./resources/assets/js/views/index.jsx",
        courseDetail: "./resources/assets/js/views/courseDetail.jsx",
        notification: "./resources/assets/js/views/notification.jsx"
    },
    output: {
        path: path.resolve( __dirname, './public/Curr/js/views' ),
        publicPath: './public/Curr/js/views',
        filename: "[name].js"
    },
    resolve: {
        extensions: [ '', '.js', '.jsx' ]
    },
    module: {
        loaders: [
            {
                test: /\.jsx?$/,
                exclude: /node_modules/,
                loader: 'babel',
                query:{
                    "presets": ["es2015", "react"]
                }
            },{
                test: /\.scss$/,
                loader: 'style!css!sass?sourceMap'//loaders: ['style-loader', 'css-loader', /*'sass-loader',*/ 'postcss-loader']
            }
        ]
    }
}
