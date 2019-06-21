<template>
    <div class="d-flex flex-column h-100">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <router-link class="navbar-brand" :to="{ name: 'queue' }">Cloud-Music</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><router-link class="nav-link" :to="{ name: 'queue' }">Queue</router-link></li>
                        <li class="nav-item"><router-link class="nav-link" :to="{ name: 'library' }">Library</router-link></li>
                        <li class="nav-item"><router-link class="nav-link" :to="{ name: 'search' }">Search</router-link></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                User <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/logout">
                                    Logout
                                </a>

                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main role="main" class="flex-shrink-0 py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <router-view 
                            :queue="queue" 
                            v-on:play-track="playTrack"
                            v-on:queue-track="queueTrack"
                            v-on:un-queue-track="unQueueTrack"
                            v-on:save-track="saveTrack">
                        </router-view>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer mt-auto py-3">
            <player v-bind:current-track="track" v-on:playback-ended="playbackEnded"></player>
        </footer>
    </div>
</template>
<script>
    import Player from '../components/Player'

    export default {
        data: function() {
            return {
                queue: [],
                track: null
            }
        },
        mounted: function() {
            this.$nextTick(function() {
                this.getQueue()
                setInterval(() => { this.getQueue() }, 60000)
            })
        },
        components: { Player },
        methods: {
            getQueue: function() {
                axios.get('/queue').then(response => {
                    this.queue = response.data
                    if(this.queue.length > 0 && this.track == null) {
                        this.track = this.queue[0].track
                    }
                })
            },
            playTrack: function(track) {
                this.track = track
            },
            saveTrack: function(track) {
                axios.post('/track/store', track).then(response => {
                    alert('saved!')
                });
            },
            queueTrack: function(track) {
                axios.post('/queue/store', track).then(response => {
                    this.getQueue()
                    alert('queued!')
                });
            },
            unQueueTrack: function(track) {
                axios.get('/queue/remove/'+track.id).then(response => {
                    this.getQueue()
                })
            },
            playbackEnded: function(track) {
                if(this.queue.length > 0 && track == this.queue[0].track) {
                    axios.get('/queue/remove/'+this.queue[0].id).then(response => {
                        this.track = null
                        this.getQueue()
                    })
                }
            }
        },
    }
</script>
