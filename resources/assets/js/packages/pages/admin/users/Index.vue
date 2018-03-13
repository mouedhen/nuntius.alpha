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
                        <time style="color: #999" class="time">{{ formatDate(activity.updated_at) }}</time>
                    </div>
                    <div class="margin-top">
                        <p v-if="activity.description === 'created'">
                            Création de l'objet <b>{{activity.subject_type}}</b> par l'utilisateur <b v-if="!activity.causer">undefined</b> <b v-if="activity.causer">{{activity.causer.name}}</b>
                        </p>
                        <p v-if="activity.description === 'updated'">
                            Mise-à-jour de l'objet <b>{{activity.subject_type}}</b> par l'utilisateur <b v-if="!activity.causer">undefined</b> <b v-if="activity.causer">{{activity.causer.name}}</b>
                        </p>
                        <p v-if="activity.description === 'deleted'">
                            Suppression de l'objet <b>{{activity.subject_type}}</b> par l'utilisateur <b v-if="!activity.causer">undefined</b> <b v-if="activity.causer">{{activity.causer.name}}</b>
                        </p>
                    </div>
                    <div class="margin-top">
                        <small>({{activity.properties}})</small>
                    </div>
                </el-card>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import * as moment from 'moment';
    import 'moment/locale/fr';
    moment.locale('fr');

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
        },
        beforeRouteLeave(to, from, next) {
            this.$store.dispatch('reinitActivities');
            next()
        }
    }
</script>