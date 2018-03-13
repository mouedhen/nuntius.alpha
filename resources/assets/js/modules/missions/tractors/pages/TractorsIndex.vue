<template>
        <div class="main">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>Configuration</el-breadcrumb-item>
                <el-breadcrumb-item>Tracteurs</el-breadcrumb-item>
            </el-breadcrumb>
            <div class="margin-top">
                <h3>Ajouter un tracteur</h3>
                <tractor-form :tractor="tractor" v-on:submit="save"/>
            </div>
            <div class="margin-top">
                <h3>Liste des tracteurs</h3>
                <tractors-list class="margin-top" :tractors="tractors"/>
            </div>
        </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import MissionsSideBar from './../../missions/components/MissionsSideBar.vue'
    import TractorForm from '../components/TractorForm'
    import TractorsList from '../components/TractorsList'
    import {initialData} from "../config";

    export default {
        components: {MissionsSideBar, TractorForm, TractorsList},
        data() {
            return {
                index: '1-1',
                tractor: initialData(),
            }
        },
        computed: {
            ...mapGetters({
                tractors: 'getTractors',
            }),
        },
        mounted() {
            this.$store.dispatch('fetchTractors')
        },
        methods: {
            save() {
                this.$store.dispatch('saveTractor', {tractor: this.tractor})
                    .then((tractor) => {
                        this.$message.success('Le chauffeur ' + tractor.designation + ' a été ajouter avec succès.');
                        this.tractor = initialData();
                    })
                    .catch(error => {
                        this.$message.error('Une erreur innattendue est survenue, merci de contacter votre administrateur!');
                    })
            }
        }
    }
</script>
