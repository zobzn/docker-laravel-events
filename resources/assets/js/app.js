import $ from 'jquery';

global.moment = require('moment');

require('babel-polyfill');
require('moment-timezone');
require('fullcalendar');
require('bootstrap');
require('tempusdominus-bootstrap-4');

(() => {
    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
        const axios = require('axios');
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token.content,
            },
        });
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
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek',
        },
        eventLimit: true, // allow "more" link when too many events
        events: events,
    });
});

[...document.querySelectorAll('.datetimepicker-input')].forEach(element => {
    const input = $(element);
    const format = input.attr('data-dt-format') || 'YYYY-MM-DD HH:mm:ss';
    const wrapper = $(input.attr('data-target'));

    wrapper.datetimepicker({
        format: format,
    });
});
