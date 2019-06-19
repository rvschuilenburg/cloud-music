<template>
    <div>
        <div class="card">
            <div class="card-header">Queue</div>
            <div class="card-body">
                <table>
                    <tr>
                        <th>Track</th>
                        <th>Action</th>
                    </tr>
                    <tr v-for="track in queue">
                        <td>{{ track.title }}</td>
                        <td><a @click.prevent="$emit('play-track', track)" href=""> play </a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['queue'],
        mounted: function() {
            this.$nextTick(function() {
                console.log(this.queue)
            })
        },
        methods: {
            
        },
    }
</script>