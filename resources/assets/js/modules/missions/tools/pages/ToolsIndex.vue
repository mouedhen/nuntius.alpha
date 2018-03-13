<template>
    <div class="main">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item>Configuration</el-breadcrumb-item>
            <el-breadcrumb-item>Outils</el-breadcrumb-item>
        </el-breadcrumb>
        <div class="margin-top">
            <h3>Ajouter un outil</h3>
            <tool-form :tool="tool" v-on:submit="save"/>
        </div>
        <div class="margin-top">
            <h3>Liste des outils</h3>
            <tools-list  class="margin-top" :tools="tools"/>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import MissionsSideBar from './../../missions/components/MissionsSideBar.vue'
    import ToolForm from '../components/ToolForm'
    import ToolsList from '../components/ToolsList'
    import {initialData} from "../config";

    export default {
        components: {MissionsSideBar, ToolForm, ToolsList},
        data() {
            return {
                index: '1-2',
                tool: initialData(),
            }
        },
        computed: {
            ...mapGetters({
                tools: 'getTools',
            }),
        },
        mounted() {
            this.$store.dispatch('fetchTools')
        },
        methods: {
            save() {
                this.$store.dispatch('saveTool', {tool: this.tool})
                    .then((tool) => {
                        this.$message.success('L\'outils ' + tool.designation + ' a été ajouter avec succès.');
                        this.tool = initialData();
                    })
                    .catch(error => {
                        this.$message.error('Une erreur innattendue est survenue, merci de contacter votre administrateur!');
                    })
            }
        }
    }
</script>
