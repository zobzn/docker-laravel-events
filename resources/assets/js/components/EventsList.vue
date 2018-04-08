<template>
    <div>
        <p v-if="!events.length">
            You have no events yet.
        </p>
        <table class="table" v-if="events.length > 0">
            <colgroup>
                <col />
                <col />
                <col width="180" />
                <col width="190" />
            </colgroup>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Title</td>
                    <td>Date</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="event in events" :key="event.id">
                    <td>
                        {{ event.id }}
                    </td>
                    <td>
                        {{ event.title }}
                    </td>
                    <td>
                        {{ event.date }}
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" :href="`/events/${event.id}/show`">Show</a>
                        <a class="btn btn-sm btn-success" :href="`/events/${event.id}/edit`">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger" @click="deleteEventHandler(event.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "EventsList",

        props: ['events'],

        data() {
            return {};
        },

        methods: {
            deleteEventHandler: function (id) {
                this.events = this.events.filter(event => event.id != id);
                axios.delete(`/events/${id}`);
            }
        },

        mounted() {
            false && axios('/events').then(res => {
                this.events = res.data.map(event => {
                    return Object.assign({}, event, {
                        date: moment(event.date, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm'),
                    })
                });
            });
        }
    }
</script>

<style scoped>

</style>
