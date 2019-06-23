<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <div id="player"></div>
            </div>
            <div class="col">
                <h2 v-if="this.currentTrack">{{ this.currentTrack.artist }} - {{ this.currentTrack.title }}</h2>
                <a class="btn-primary btn" @click.prevent="playTrack" href=""><font-awesome-icon icon="play" /></a>
                <a class="btn-primary btn" @click.prevent="pauseTrack" href=""><font-awesome-icon icon="pause" /></a>
                <a class="btn-primary btn" @click.prevent="stopTrack" href=""><font-awesome-icon icon="stop" /></a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['current-track'],
        mounted: function() {
            this.$nextTick(function() {
                setTimeout(() => {
                    player = new YT.Player('player', {
                        height: '80',
                        width: '80',
                        playerVars: { 'controls': 0 , 'showinfo': 0, 'modestbranding': 1, 'iv_load_policy': 3, 'playsinline': 1, 'autoplay': 0},
                        events: {
                            'onReady': this.preSelectSong,
                            'onStateChange': this.onPlayerStateChange
                        }
                    })

                },1000)
            })
        },
        methods: {
            preSelectSong: function() {
                if(this.currentTrack !== null) {
                    player.loadVideoById(this.currentTrack.youtube_id)
                    player.stopVideo()
                }
            },
            onPlayerStateChange: function(event) {
                if (event.data == YT.PlayerState.ENDED) {
                    this.$emit('playback-ended', this.currentTrack)
                }
            },
            playTrack: function() {
                player.playVideo()
            },
            pauseTrack: function() {
                player.pauseVideo()
            },
            stopTrack: function() {
                player.stopVideo()
            },
        },
        watch: {
            currentTrack: function (track) {
                if(track !== null) {
                    if (player.loadVideoById !== undefined) {
                        player.loadVideoById(track.youtube_id)
                        player.playVideo()
                    }
                }
            },
        }
    }
</script>
