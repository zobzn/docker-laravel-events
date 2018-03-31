require('babel-polyfill');
require('bootstrap-sass');
require('fullcalendar');

(() => {
    const axios = require('axios');
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }
})();

[...document.querySelectorAll('.fullcalendar[data-events]')].forEach(element => {
    const calendar = $(element);
    const events = calendar.data('events').map(item => {
        return {
            id: item.id,
            title: item.title,
            start: item.date,
        };
    });

    calendar.fullCalendar({
        events: events,
    });
});
