import axios from 'axios'
import {apiURL} from "../../config";
import {isEmpty} from "../../helpers";

const LOGIN = 'auth/LOGIN';
const LOGOUT = 'auth/LOGOUT';
const SET_USER = 'auth/SET_USER';

export default {

    state: {
        logged: !!localStorage.getItem('token'),
        user: {}
    },

    mutations: {
        [LOGIN](state) {
            state.logged = true
        },
        [LOGOUT](state) {
            localStorage.removeItem('token');
            state.logged = false
        },
        [SET_USER](state, user) {
            state.user = user
        }
    },

    actions: {

        async login({commit}, {user}) {
            return axios({
                method: 'POST',
                url: apiURL + 'login',
                params: {
                    email: user.email,
                    password: user.password,
                }
            }).then(response => {
                localStorage.setItem('token', response.data.data.token);
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.token;
                commit(LOGIN);
                commit(SET_USER, {user: response.data.data});
            })
        },

        async logout({commit}) {
            return axios({
                method: 'POST',
                url: apiURL + 'logout',
            }).then(response => {
                commit(LOGOUT);
                commit(SET_USER, {});
            }).catch(error => {
                console.log(error)
            })
        },

        async checkLogged({commit, state}) {
            if (state.logged === false) return;
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.token;
            if (isEmpty(state.user)) {
                return axios({
                    method: 'GET',
                    url: apiURL + 'profile'
                }).then(response => {
                    commit(SET_USER, {user: response.data.data});
                }).catch(error => {
                    commit(LOGOUT);
                    commit(SET_USER, {});
                })
            }
        },

        setUser({commit}, {user}) {
            commit(SET_USER, user)
        }
    },

    getters: {
        isLogged: state => state.logged,
        getUser: state => state.user
    }
}