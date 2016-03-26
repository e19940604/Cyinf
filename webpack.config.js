var path = require( 'path' );

module.exports = {
    entry: "./resources/assets/js/index.js",
    output: {
        path: path.resolve( __dirname, './public/build' ),
        publicPath: './public/build/',
        filename: "bundle.js"
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
