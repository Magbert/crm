import API from "@/API";

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
        fetchProject(context, project_id) {
            API.fetchProject(project_id)
            .then(respose => {
                context.commit("setProject", respose.data.data);
            });
        },
        updateProject({ getters }) {
            return API.updateProject(getters.project.id, getters.project);
        },
        removeProject({ getters }) {
            return API.removeProject(getters.project.id);
        }
    },
    getters: {
        project: state => state.project
    }
};
