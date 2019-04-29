const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css",
    {
        import: ["resources/sass/_variables.scss"]
    }
);
mix.browserSync("crm.loc");

mix.webpackConfig({
    resolve: {
        extensions: [".js", ".vue", ".json"],
        alias: {
            //'vue$': 'vue/dist/vue.esm.js',
            sass: path.resolve(__dirname, "./resources/sass"),
            "@": __dirname + "/resources/js"
        }
    }
});
