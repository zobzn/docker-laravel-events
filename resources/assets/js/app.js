import 'babel-polyfill';
import 'moment-timezone';
import 'fullcalendar';
import 'bootstrap';
import 'tempusdominus-bootstrap-4';

import axios from 'axios';
import $ from 'jquery';
import Vue from 'vue';

(() => {
    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
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

[...document.querySelectorAll('.vue-app')].forEach(root => {
    new Vue({
        el: root,
        components: {
            'events-list': require('./components/EventsList.vue'),
        }
    });
});
