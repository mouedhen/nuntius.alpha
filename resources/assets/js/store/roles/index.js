import axios from 'axios'
import {apiURL} from "../../config";

const FETCH_ROLE = 'roles/FETCH_ROLE';
const REINIT_ROLE = 'roles/REINIT_ROLE';

export default {

    state: {
        roles: []
    },

    mutations: {
        [FETCH_ROLE](state, roles) {
            state.roles = state.roles.concat(roles)
        },

        [REINIT_ROLE](state) {
            state.roles = []
        }
    },

    actions: {
        fetchRoles({commit}) {
            this.dispatch('loadRoles', {url: apiURL + 'roles'})
        },

        reinitRoles({commit}) {
            commit(REINIT_ROLE)
        },

        async loadRoles({commit}, {url}) {
            return axios(
                {
                    method: 'GET',
                    url: url,
                })
                .then(response => {
                    commit(FETCH_ROLE, response.data.data);
                    if (response.data.links.next !== null) {
                        this.dispatch('loadRoles', {url: response.data.links.next})
                    }
                    return response.data.data
                })
                .catch(error => {
                    throw error
                })
        }
    },

    getters: {
        getRoles: state => state.roles,
    }
}