<template>
    <div>
        <div id="player"></div>
        <a @click.prevent="playTrack" href=""> play </a>
        <a @click.prevent="pauseTrack" href=""> pause </a>
        <a @click.prevent="stopTrack" href=""> stop </a>
    </div>
</template>
<script>
    export default {
        props: ['current-track'],
        mounted: function() {
            this.$nextTick(function() {
                setTimeout(() => {
                    player = new YT.Player('player', {
                        height: '70',
                        width: '70',
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
                if(this.currentTrack !== {}) {
                    player.loadVideoById(this.currentTrack.id)
                    player.stopVideo()
                }
            },
            onPlayerStateChange: function(event) {
                if (event.data == YT.PlayerState.ENDED) {
                    $emit('playback-ended', track)
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
                if (player.loadVideoById !== undefined) {
                    player.loadVideoById(track.id)
                }
            },
        }
    }
</script>