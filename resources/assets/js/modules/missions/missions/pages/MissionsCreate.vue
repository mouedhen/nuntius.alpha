<template>
    <div class="main">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ name: 'missions:index' }">Gestion des Missions</el-breadcrumb-item>
            <el-breadcrumb-item :to="{ name: 'missions:create' }">Nouvelle Mission</el-breadcrumb-item>
        </el-breadcrumb>
        <div class="margin-top">
            <missions-plan-form :mission="mission" :customers="customers" v-on:submit="submitMission"/>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    import MissionsSideBar from './../components/MissionsSideBar.vue'
    import MissionsForm from './../components/MissionsForm.vue'
    import MissionsPlanForm from './../components/MissionsPlanForm.vue'

    import {initialMissionData} from './../config'

    export default {
        components: {MissionsSideBar, MissionsForm, MissionsPlanForm},
        data() {
            return {
                index: '0-1',
                mission: initialMissionData(),
            }
        },
        computed: {
            ...mapGetters({
                customers: 'getCustomers',
            }),
        },
        methods: {
            submitMission(mission) {
                this.$store.dispatch('saveMission', {mission: mission})
                    .then((mission) => {
                        this.$message.success('Success, la mission' + mission.label + ' a été crée avec succèss.');
                        this.mission = initialMissionData();
                        this.$router.push({name: 'missions:details', params: {id: mission.id}})
                    })
                    .catch(error => {
                        this.$message.error('Error, Record already exit!');
                        this.mission.start_counter = start_counter;
                        this.mission.end_counter = end_counter;
                    })
            }
        },
        mounted() {
            this.$store.dispatch('fetchCustomers')
                .catch(error => {
                    this.$notify.error({
                        title: 'Error',
                        message: 'Error when reading records'
                    });
                });
        },
        beforeRouteLeave(to, from, next) {
            this.$store.dispatch('reinitCustomers')
                .catch(error => {
                    this.$notify.error({
                        title: 'Error',
                        message: 'Error when reading records'
                    });
                });
            next()
        }
    }
</script>
