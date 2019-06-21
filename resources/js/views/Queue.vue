<template>
    <div>
        <div class="card">
            <div class="card-header">Queue</div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Artist</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                    <tr v-for="item in queue">
                        <td>{{ item.order }}</td>
                        <td>{{ item.track.artist }}</td>
                        <td>{{ item.track.title }}</td>
                        <td>
                            <a class="btn-primary btn-sm" @click.prevent="$emit('play-track', item.track)" href=""> play </a>
                            <a class="btn-danger btn-sm" @click.prevent="$emit('un-queue-track', item)" href=""> remove </a>
                        </td>
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
                
            })
        },
        methods: {
            
        },
    }
</script>