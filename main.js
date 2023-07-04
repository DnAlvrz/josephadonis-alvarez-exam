const app = Vue.createApp({
    data() {
        return {
          channel: null,
          videos: null,
          channelName: 'NBA',
        }
    },
    methods: {
      async updateChannel (newChannel) {
        this.channelName = newChannel;
        console.log('load channel:', newChannel);
        const res = await axios.get('youtube_channel_json.php/?action=save&channelName='+this.channelName);
      },
      async loadChannel (newChannel) {
        this.channelName = newChannel;
        const res = await axios.get('youtube_channel_json.php/?action=get&channelName='+this.channelName);
        this.channel = res.data.channel[0]
        this.videos = res.data.videos.videos
      }
    },
    beforeMount(){ 
      this.updateChannel(this.channelName);
      this.loadChannel(this.channelName);
    }
  })
  