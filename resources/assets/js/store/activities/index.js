import axios from 'axios'
import {apiURL} from "../../config";

const FETCH_ACTIVITIES = 'activities/FETCH_ACTIVITIES';
const REINIT_ACTIVITIES = 'activities/REINIT_ACTIVITIES';

export default {

    state: {
        activities: []
    },

    mutations: {
        [FETCH_ACTIVITIES](state, activities) {
            state.activities = state.activities.concat(activities)
        },

        [REINIT_ACTIVITIES](state) {
            state.activities = []
        }
    },

    actions: {
        fetchActivities({commit}) {
            this.dispatch('loadActivities', {url: apiURL + 'activities'})
        },

        reinitActivities({commit}) {
            commit(REINIT_ACTIVITIES)
        },

        async loadActivities({commit}, {url}) {
            return axios(
                {
                    method: 'GET',
                    url: url,
                })
                .then(response => {
                    commit(FETCH_ACTIVITIES, response.data.data);
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