import Axios from "axios";

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
            axios.get(`/users/users`).then(respose => {
                commit("users", respose.data.data);
            });
        }
    },
    getters: {
        users: state => state.users
    }
};
