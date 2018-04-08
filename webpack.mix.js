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
            // @see https://github.com/moment/moment/issues/2416
            new webpack.ContextReplacementPlugin(/moment[\/\\]locale$/, /en/),
            new webpack.ProvidePlugin({
                '$': 'jquery',
                'jQuery': 'jquery',
                'moment': 'moment',
                'window.jQuery': 'jquery',
                'window.moment': 'moment',
            })
        ]
    };
});

mix
    .sass('resources/assets/sass/app.scss', 'public/css')
    .js('resources/assets/js/app.js', 'public/js')
    .extract([
        'tempusdominus-bootstrap-4',
        'babel-polyfill',
        'fullcalendar',
        'bootstrap',
        'popper.js',
        'moment-timezone',
        'moment',
        'jquery',
        'axios',
        'vue',
    ]);

mix.inProduction() && mix.version();
