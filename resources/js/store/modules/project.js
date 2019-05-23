import Axios from "axios";

export default {
    state: {
        project: null
    },
    mutations: {
        setProject(state, project) {
            state.project = Object.assign({}, state.project, project);
        }
    },
    actions: {
        fetchProject(context, project) {
            axios.get(`/projects/${project.id}`).then(respose => {
                context.commit("setProject", respose.data.data);
            });
        },
        updateProject({ context, commit, getters }) {
            return axios
                .put(`/projects/${getters.project.id}`, getters.project)
                .then(respose => {
                    //console.log(respose);
                });
        },
        removeProject({ context, commit, getters }) {
            return axios
                .delete(`/projects/${getters.project.id}`)
                .then(respose => {
                    //console.log(respose);
                });
        }
    },
    getters: {
        project: state => state.project
    }
};
