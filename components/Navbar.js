app.component('navbar', {
    template:
    /*html*/
    `
    <div class="container segment navbar">
        <input @change="onChange($event)" :value="searchText" placeholder="Search" type="search">
        <button @click="saveChannel" class="searchBtn"> Save </button>
        <button @click="loadChannel" class="searchBtn"> Load </button>
    </div>
    `,
    data() {
        return {
            searchText: ""
        }
    },
    methods: {
        onChange(event) {
            this.searchText = event.target.value
        },
        saveChannel() {
            console.log("test: ",this.searchText)
            this.$emit('save-channel', this.searchText)
            this.searchText ="";
        },
        loadChannel () {
            this.$emit('load-channel', this.searchText)
            this.searchText ="";
        }
    }
})