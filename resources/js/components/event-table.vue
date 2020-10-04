<template>
    <div class="container">
        <button @click="getData" v-if="!this.dat.isEmpty">Ajax список всех Event</button>
        <button @click="this.dat.delete" v-if="this.dat.isEmpty">Скрить список</button>
        <table class="table table-responsive" v-cloak>
            <thead>
            <tr>
                <th>Name</th>
                <th>Cost</th>
                <th>Type</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="event in this.dat">
                <td>{{event.name}}</td>
                <td>{{event.cost}}</td>
                <td>{{event.type}}</td>
                <td>{{event.date}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "event-table",
        data: function () {
            return {
                dat: [],
                date: new Date(),
            }
        },

        methods: {
            getData: function () {
                axios.get('/api/getdata').then((response) => {
                    console.log(response);
                    this.dat = response.data
                });
            },
            getDate: function (shift) {
                return this.date.getDate() + shift-1 + '.' + this.date.getMonth() + '.' + this.date.getFullYear();
            }
        }
    }
</script>

<style scoped>

</style>
