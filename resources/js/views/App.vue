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
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer mt-auto py-3">
          <div id="player"></div>
            sticky foot
        </footer>
    </div>
</template>
<script>
    export default {
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
                console.log('preselecting song!')
                player.loadVideoById('Glabf3Oeoi4')
            },
            onPlayerStateChange: function() {
                console.log('state is changing')
            }
        },
    }
</script>
