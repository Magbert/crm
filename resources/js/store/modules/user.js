import API from "@/API";

export default {
    state: {
        users: null
    },
    mutations: {
        users(state, users) {
            state.users = users;
        }
    },
    actions: {
        fetchUsers({ commit }) {
            API.fetchUsers().then(respose => {
                commit("users", respose.data.data);
            });
        }
    },
    getters: {
        users: state => state.users
    }
};
