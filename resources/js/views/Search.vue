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
                        <div class="col-md-2">
                            <input type="submit" style="display:none;">
                            <a v-on:click.prevent="submitSearch" class="btn btn-primary btn-block" href=""><font-awesome-icon icon="search" /></a>
                        </div>
                    </div>
                </form>
                <br />
                <table>
                    <tr v-for="result in results">
                        <td><img v-bind:src="result.snippet.thumbnails.default.url" /></td>
                        <td><b>{{ result.snippet.title }}</b><br />{{ result.snippet.description }}</td>
                        <td class="col-md-2">
                            <a class="btn-primary btn" @click.prevent="previewTrack(result)" href=""><font-awesome-icon icon="play" /></a>
                            <a class="btn-success btn" @click.prevent="openTrackModal(result)" href=""><font-awesome-icon icon="save" /></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Save this track</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form v-on:submit.prevent="saveTrack">
                      <div class="form-group">
                        <label class="col-form-label">Artist:</label>
                        <input type="text" class="form-control" v-model="selected.artist">
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Title:</label>
                        <input type="text" class="form-control" v-model="selected.title">
                      </div>
                      <input type="submit" style="display:none" />
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="saveTrack">Save changes</button>
                  </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function() {
            return {
                query: '',
                results: [],
                selected: { youtube_id: '', artist: '', title: ''}
            }
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
                var track = { title: result.snippet.title, youtube_id: result.id.videoId }
                this.$emit('play-track', track)
            },
            openTrackModal: function(result) {
                var title_parts = result.snippet.title.split(" - ")
                if(title_parts.length === 2) {
                    var artist = title_parts[0]
                    var title = title_parts[1]
                } else {
                    var artist = ''
                    var title = result.snippet.title
                }
                var selected = {youtube_id: result.id.videoId, artist: artist, title: title}
                this.selected = selected
                $('#trackModal').modal('show')
            },
            saveTrack: function() {
                $('#trackModal').modal('hide')
                this.$emit('save-track', this.selected)
            }
        },
    }
</script>