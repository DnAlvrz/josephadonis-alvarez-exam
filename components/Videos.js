app.component('video-list', {
    props: {
        videos: {
            type: Array,
            required: true
        }
    },
    template:
    /*html*/
    `
    <div class="container">
        <div class='text-center'>
            <h1>Videos</h1>
        </div>
        <div class="container video-list">

            <div v-for="(video, index) in videos" class="card" :key="'v'+index">
                <img class="card-img" :src="video.thumbnail" >
                <div class="video-info">
                    <h3  class="video-title"> {{video.title}}</h3>
                    <div class="video-description "> 
                        <p class="empty-description" v-if="video['description'].length === 0"  >
                            No description.
                        </p>
                        <p v-else> 
                            {{video.description}}
                        </p>
                    </div>
                    <button @click="viewVideo(video['uid'])" class=" button">
                        Click to view
                    </button>
                </div>
            </div>
        </div>
    </div>
    `,
    methods : {
        viewVideo(videoId) {
            window.open("https://www.youtube.com/watch?v="+videoId, '_blank');
        }
    }
})