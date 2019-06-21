<template>
    <div>
        <div class="card">
            <div class="card-header">Library</div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Artist</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                    <tr v-for="track in tracks">
                        <td>{{ track.artist }}</td>
                        <td>{{ track.title }}</td>
                        <td>
                            <a class="btn-primary btn-sm" @click.prevent="$emit('play-track', track)" href=""><font-awesome-icon icon="play" /></a>
                            <a class="btn-primary btn-sm" @click.prevent="$emit('queue-track', track)" href=""><font-awesome-icon icon="list" /></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function() {
            return {
                tracks: []
            }
        },
        mounted: function() {
            this.$nextTick(function() {
                axios.get('/tracks').then(response => {
                    this.tracks = response.data
                })
            })
        },
        methods: {
            
        },
    }
</script>