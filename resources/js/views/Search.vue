<template>
    <div>
        <div class="card">
            <div class="card-header">Search</div>
            <div class="card-body">
                <form v-on:submit.prevent="submitSearch">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" v-model="query" placeholder="Search Query">
                        </div>
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-primary btn-block" value="Search">
                        </div>
                    </div>
                </form>
                <br />
                <table>
                    <tr v-for="result in results">
                        <td><img v-bind:src="result.snippet.thumbnails.default.url" /></td>
                        <td><b>{{ result.snippet.title }}</b><br />{{ result.snippet.description }}</td>
                        <td>
                            <a class="btn-primary btn-sm" @click.prevent="previewTrack(result)" href="">preview</a><br />
                            <a class="btn-primary btn-sm" @click.prevent="previewTrack(result)" href="">queue</a>
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
                query: '',
                results: []
            }
        },
        mounted: function() {
            this.$nextTick(function() {
                console.log(this.queue)
            })
        },
        methods: {
            submitSearch: function() {
                axios.get('https://www.googleapis.com/youtube/v3/search', {
                    params: {
                        part: 'snippet',
                        order: 'relevance',
                        q: this.query,
                        type: 'video',
                        videoDefinition: 'high',
                        key: process.env.MIX_YOUTUBE_API_KEY,
                        videoEmbeddable: 'true',
                        maxResults: 20
                    }
                })
                .then((response) => {
                    this.results = response.data.items
                });  
            },
            previewTrack: function(result) {
                var track = { title: result.snippet.title, id: result.id.videoId }
                this.$emit('play-track', track)
            }
        },
    }
</script>