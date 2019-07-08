export default {
    state: {
        header: {
            show: true,
            title: "",
            nav: []
        },
    },
    mutations: {
        setHeader: (state, header) => (state.header = Object.assign(state.header, header)),
        setHeaderTitle: (state, title) => (state.header.title = title),
        setHeaderNav: (state, links) => (state.header.nav = links),
        setHeaderShow: (state, show) => (state.header.show = show),
        resetHeader: (state) => {
            state.header.title = "";
            state.header.nav = [];
            state.header.show = true
        },
    },
    actions: {},
    getters: {
        header: state => state.header
    }
}