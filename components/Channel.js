app.component('channel-info', {
    props: {
        channel: {
            type: Object,
            required: true
        }
    },
    template:
    /*html*/
    `
    <div class="container channel-info segment">
        
        <div class="image">
            <img class="avatar" :src="channel.thumbnail" >
        </div>
        <div class="description">
            <h1 class="channel-title">{{channel.name}}</h1>
            <h4>Description</h4>
            <p>
                {{channel.description}}
            </p>
        </div>
    </div>
    `,
})