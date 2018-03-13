<template>
    <div class="main">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ name: 'dashboard:users:index' }">Gestion des utilisateurs</el-breadcrumb-item>
            <el-breadcrumb-item>Liste des utilisateurs</el-breadcrumb-item>
        </el-breadcrumb>
        <div class="margin-top">
            <users-table :users="users"/>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import UsersTable from '../../../../components/users/UsersTable'

    export default {
        components: {
            UsersTable,
        },
        computed: {
            ...mapGetters({
                users: 'getUsers',
            }),
        },
        mounted() {
            this.$store.dispatch('fetchUsers')
                .catch(error => {
                    this.$notify.error({
                        title: 'Erreur',
                        message: 'Erreur lors de lecture des données...'
                    });
                });
        },
        beforeRouteLeave(to, from, next) {
            this.$store.dispatch('reinitUsers')
                .catch(error => {
                    this.$notify.error({
                        title: 'Erreur',
                        message: 'Une erreur inattendue est survenue, merci de contacter votre administrateur...'
                    });
                });
            next()
        }
    }
</script>