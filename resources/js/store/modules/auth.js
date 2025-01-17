import API from "@/API";

export default {
    state: {
        token: localStorage.getItem("access_token") || null
    },
    mutations: {
        setToken(state, token) {
            state.token = token;
        },
        destroyToken(state) {
            state.token = null;
        }
    },
    actions: {
        destroyToken(context) {
            if (context.getters.loggedIn) {
                return new Promise((resolve, reject) => {
                    API.logout()
                        .then(response => {
                            localStorage.removeItem("access_token");
                            context.commit("destroyToken");
                            resolve(response);
                        })
                        .catch(error => {
                            localStorage.removeItem("access_token");
                            context.commit("destroyToken");
                            reject(error);
                        });
                });
            }
        },
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                API.login({
                    username: credentials.username,
                    password: credentials.password
                })
                .then(response => {
                        const token = response.data.access_token;

                        localStorage.setItem("access_token", token);
                        context.commit("setToken", token);
                        axios.defaults.headers.common[
                            "Authorization"
                        ] = `Bearer ${token}`;

                        resolve(response);
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error);
                    });
            });
        }
    },
    getters: {
        loggedIn: state => state.token !== null
    }
};
