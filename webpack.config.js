const path               = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin   = require("css-minimizer-webpack-plugin");

const isProd = process.env.NODE_ENV === "production";

module.exports = {
  entry: "./src/index.js",
  mode:  isProd ? "production" : "development",
  devtool: isProd ? false : "source-map",

  output: {
    filename: "main.js",
    path:     path.resolve(__dirname, "dist"),
    clean:    true,
  },

  optimization: {
    minimizer: ["...", new CssMinimizerPlugin()],
  },

  plugins: [
    new MiniCssExtractPlugin({ filename: "main.css" }),
  ],

  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,
        use: [
          isProd ? MiniCssExtractPlugin.loader : "style-loader",
          "css-loader",
          "sass-loader",
        ],
      },
    ],
  },
};
