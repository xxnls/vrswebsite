const mix = require('laravel-mix');

// Compile CSS
mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
]);

// Compile JavaScript
mix.js('resources/js/app.js', 'public/js');

// Versioning (optional)
if (mix.inProduction()) {
    mix.version();
}

// Source maps (optional)
mix.sourceMaps();