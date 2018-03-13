<template>
    <div class="main">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ name: 'dashboard:users:index' }">Gestion des utilisateurs</el-breadcrumb-item>
            <el-breadcrumb-item>Modifier un utilisateur</el-breadcrumb-item>
        </el-breadcrumb>
        <div class="margin-top">
            <users-form
                    v-on:submitForm="addUser"
                    v-on:resetForm="resetUser"
                    :validationError="validationError"
                    :user="user"
                    :roles="roles"/>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import UsersForm from '../../../../components/users/UsersForm'

    const initialValidation = function () {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            role: '',
        }
    };

    const initialUserDetails = function () {
        return {
            id: -1,
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            created_at: null,
        }
    };

    export default {
        components: {
            UsersForm,
        },
        data() {
            return {
                user: initialUserDetails(),
                validationError: initialValidation(),
            }
        },
        computed: {
            ...mapGetters({
                roles: 'getRoles',
            }),
        },
        methods: {
            addUser() {
                this.validationError = initialValidation();
                this.$store.dispatch('saveUser', {user: this.user})
                    .then(user => {
                        this.$message.success('Utilisateur ' + user.name + ' créé avec succès.');
                        this.$router.push({name: 'users:list'});
                    })
                    .catch((error) => {
                        this.$message.error('Erreur lors de l\'ajout d\'un nouvel utilisateur, merci de vérifier vos paramètres.');
                        if (error.response !== undefined) {
                            if (error.response.status === 422) {
                                let errorData = error.response.data[1];
                                if (errorData['name'] !== undefined) {this.validationError.name = errorData['name'][0]}
                                if (errorData['email'] !== undefined) {this.validationError.email = errorData['email'][0]}
                                if (errorData['password'] !== undefined) {this.validationError.password = errorData['password'][0]}
                                if (errorData['password_confirmation'] !== undefined) {this.validationError.password_confirmation = errorData['password_confirmation'][0]}
                            }
                        }
                    })
            },
            resetUser() {
                this.user = initialUserDetails();
            }
        },
        mounted() {
            this.$store.dispatch('fetchRoles')
                .catch(error => {
                    this.$notify.error({
                        title: 'Erreur',
                        message: 'Erreur lors de lecture des données...'
                    });
                });

            this.$store.dispatch('fetchUser', {userID: this.$route.params.id})
                .then(user => {
                    this.user = Object.assign({}, user);
                })
        },
        beforeRouteLeave(to, from, next) {
            this.$store.dispatch('reinitRoles')
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