<template>
    <div class="container">
        <button @click="getData" v-if="!this.dat.isEmpty">Получить информацию</button>
        <button @click="this.dat.empty" v-if="this.dat.isEmpty">Дата не емпти</button>
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Data</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="event in this.dat">
                <td>{{event.id}}</td>
                <td>{{event.name}}
                    <button @click="deleteEvent(event)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "ajax",
        data: function () {
            return {
                dat: [],

            }
        },
        methods: {
            getData: function () {
                axios.get('/api/getdata').then((response) => {
                    console.log(response);
                    this.dat = response.data
                });
            },
            deleteEvent: function (event) {
               axios.delete('/api/delete/event/' + event.id, {event: event});
               this.dat.splice(event, 1);
            }
        }
    }
</script>

<style scoped>

</style>
