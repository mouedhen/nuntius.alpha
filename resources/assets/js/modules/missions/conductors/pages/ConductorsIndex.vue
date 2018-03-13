<template>
    <div class="main">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item>Configuration</el-breadcrumb-item>
            <el-breadcrumb-item>Chauffeurs</el-breadcrumb-item>
        </el-breadcrumb>
        <div class="margin-top">
            <div>
                <h3>Ajouter un chauffeur</h3>
                <conductor-form class="margin-top" :conductor="conductor" v-on:submit="saveConductor"/>
            </div>
            <div class="margin-top">
                <h3>Liste des chauffeurs</h3>
                <conductor-list class="margin-top" :conductors="conductors"/>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import MissionsSideBar from './../../missions/components/MissionsSideBar.vue'
    import ConductorForm from '../components/ConductorForm'
    import ConductorList from '../components/ConductorsList'
    import {initialConductorData} from "../config";

    export default {
        components: {MissionsSideBar, ConductorForm, ConductorList},
        data() {
            return {
                index: '1-0',
                conductor: initialConductorData(),
            }
        },
        computed: {
            ...mapGetters({
                conductors: 'getConductors',
            }),
        },
        mounted() {
            this.$store.dispatch('fetchConductors')
        },
        methods: {
            saveConductor() {
                this.$store.dispatch('saveConductor', {conductor: this.conductor})
                    .then((conductor) => {
                        this.$message.success('Le chauffeur ' + conductor.name + ' a été ajouter avec succès.');
                        this.conductor = initialConductorData();
                    })
                    .catch(error => {
                        this.$message.error('Une erreur innattendue est survenue, merci de contacter votre administrateur!');
                    })
            }
        }
    }
</script>
