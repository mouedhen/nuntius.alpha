<template>
    <div class="main">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ name: 'dashboard:users:index' }">Gestion des utilisateurs</el-breadcrumb-item>
            <el-breadcrumb-item>Tableau de bord</el-breadcrumb-item>
        </el-breadcrumb>

        <div class="margin-top">
            <div>
                <h3>Activité des utilisateurs</h3>
            </div>
            <div class="margin-top">
                <el-card class="margin-top" v-for="activity in activities" :key="activity.id" style="padding-bottom: 1rem">
                    <div style="text-align: right">
                        <time style="color: #999" class="time">{{ formatDate(activity.subject.updated_at) }}</time>
                    </div>
                    <div class="margin-top">
                        <p>The user <b v-if="activity.causer === null">undefined</b> have <b>{{activity.description}}</b>
                            the object <b>{{activity.subject_type}}</b> ({{activity.subject.name}})</p>
                    </div>
                </el-card>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import * as moment from 'moment';

    export default {
        methods: {
            formatDate(date) {
                return moment(date).format("dddd, Do MMMM YYYY, HH:mm")
            }
        },
        computed: {
            ...mapGetters({
                activities: 'getActivities'
            })
        },
        mounted() {
            this.$store.dispatch('fetchActivities')
        }
    }
</script>