import axios from 'axios'
import {apiURL} from "../../config";

import {
    REINIT_USERS,
    FETCH_USERS,
    FETCH_USER,
    CREATE_USER,
    UPDATE_USER,
    DELETE_USER
} from './mutation-types'

export function reinitUsers({commit}) {
    commit(REINIT_USERS, [])
}

export async function fetchUsers({commit}) {
    return axios(
        {
            method: 'GET',
            url: apiURL + 'users',
        })
        .then(response => {
            commit(FETCH_USERS, response.data.data);
            return response.data.data
        })
        .catch(error => {
            throw error
        })
}

export async function fetchUser({commit}, {userID}) {
    return axios(
        {
            method: 'GET',
            url: apiURL + 'users/' + userID,
        })
        .then(response => {
            commit(FETCH_USER, response.data.data);
            return response.data.data
        })
        .catch(error => {
            throw error
        })
}

export async function createUser({commit}, {user}) {
    return axios(
        {
            method: 'POST',
            url: apiURL + 'users',
            data: user
        })
        .then(response => {
            commit(CREATE_USER, response.data.data);
            return response.data.data
        })
        .catch(error => {
            throw error
        })
}

export async function updateUser({commit}, {user}) {
    return axios(
        {
            method: 'PUT',
            url: apiURL + 'users/' + user.id,
            data: user
        })
        .then(response => {
            commit(UPDATE_USER, response.data.data);
            return response.data.data
        })
        .catch(error => {
            throw error
        })
}

export async function deleteUser({commit}, { userID }) {
    return axios(
        {
            method: 'DELETE',
            url: apiURL + 'users/' + userID
        })
        .then(response => {
            commit(DELETE_USER, userID);
            return response.data.data
        })
        .catch(error => {
            throw error
        })
}

export async function saveUser({commit, state}, { user }) {
    const index = state.all.findIndex((x) => x.id === user.id);
    if (index !== -1 ) {
        return updateUser({commit}, {user})
    }
    return createUser({commit}, {user})
}
