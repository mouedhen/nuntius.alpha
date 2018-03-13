import axios from 'axios'
import {apiURL} from "../../config";
import {FETCH_USERS} from "../users/mutation-types";

const FETCH_ACTIVITES = 'activities/FETCH_ACTIVITES';

export default {

    state: {
        activities: []
    },

    mutations: {
        [FETCH_ACTIVITES](state, activities) {
            state.activities = state.activities.concat(activities)
        },
    },

    actions: {
        fetchActivities({commit}) {
            this.dispatch('loadActivities', {url: apiURL + 'activities'})
        },

        async loadActivities({commit}, {url}) {
            return axios(
                {
                    method: 'GET',
                    url: url,
                })
                .then(response => {
                    commit(FETCH_ACTIVITES, response.data.data);
                    if (response.data.links.next !== null) {
                        this.dispatch('loadActivities', {url: response.data.links.next})
                    }
                    return response.data.data
                })
                .catch(error => {
                    throw error
                })
        }
    },

    getters: {
        getActivities: state => state.activities,
    }
}