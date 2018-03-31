const {mix} = require('laravel-mix');

// mix.config.fileLoaderDirs.images = 'assets/images';
// mix.config.fileLoaderDirs.fonts = 'assets/fonts';

mix.options({
    processCssUrls: true,
    autoprefixer: {
        options: {
            browsers: ['> 10%', 'last 6 versions', 'ff ESR', 'opera >= 12', 'safari >= 5', 'ios >= 8', 'ie >= 8'],
        }
    }
});

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.ProvidePlugin({
                '$': 'jquery',
                'jQuery': 'jquery',
                'window.jQuery': 'jquery',
            })
        ]
    };
});

mix
    .sass('resources/assets/sass/app.scss', 'public/css')
    .js('resources/assets/js/app.js', 'public/js')
    .extract([
        'babel-polyfill',
        'fullcalendar',
        'bootstrap',
        'popper.js',
        'jquery',
        'axios',
    ]);

mix.inProduction() && mix.version();
