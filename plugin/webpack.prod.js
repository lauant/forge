const path = require("path");
const webpack = require("webpack");
const TerserPlugin = require("terser-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");

const pluginName = __dirname.substring(
    __dirname.lastIndexOf("/") + 1,
    __dirname.length
);

module.exports = env => {
    const system = Object.keys( env )[0];
    return {
        entry: {
            [`sba-${system}-app`]: [
                path.resolve(__dirname, `src/${system}`, "index.js"),
                path.resolve(__dirname, `src/${system}/styles`, "app.scss"),
            ],
        },
        output: {
            publicPath: `../wp-content/plugins/${pluginName}/dist/${system}/`,
            chunkFilename: "chunk.[name].js",
            path: path.resolve(__dirname, `dist/${system}/`),
        },
        module: {
            rules: [
                {
                    test: /\.(png|jp(e*)g|gif)$/,
                    use: [
                        {
                            loader: "file-loader",
                            options: {
                                name: "images/[hash]-[name].[ext]",
                            },
                        },
                    ],
                },
                {
                    test: /\.svg$/,
                    use: [ '@svgr/webpack'],
                },
                {
                    test: /\.(js|jsx)$/,
                    exclude: /node_modules/,
                    use: {
                        loader: "babel-loader",
                    },
                },
                {
                    test: /\.s[ac]ss|css$/i,
                    use: [
                        // Creates `style` nodes from JS strings
                        MiniCssExtractPlugin.loader,
                        // Translates CSS into CommonJS
                        "css-loader",
                        // Compiles Sass to CSS
                        "sass-loader",
                    ],
                },
            ],
        },
        resolve: {
            extensions: [ '.js', '.jsx' ],
        },
        performance: {
            hints: "warning",
        },
    
        optimization: {
            minimize: true,
            minimizer: [
                new TerserPlugin({
                    terserOptions: {
                        ecma: undefined,
                        parse: {},
                        extractComments: true,
                        compress: {},
                        mangle: true, // Note `mangle.properties` is `false` by default
                        // Deprecated
                    },
                }),
            ],
        },
        plugins: [
            new TerserPlugin(),
            new webpack.DefinePlugin({
                "process.env.NODE_ENV": JSON.stringify("production"),
            }),
            new webpack.optimize.ModuleConcatenationPlugin(),
            new webpack.NoEmitOnErrorsPlugin(),
            new CleanWebpackPlugin(),
            new MiniCssExtractPlugin({
                attributes: {
                    id: "target",
                    "data-target": "example",
                },
            }),
        ],
    }
};
