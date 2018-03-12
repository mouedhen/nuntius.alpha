<template>
    <el-row>
        <el-col :span="12">
            <section class="container">
                <div>
                    <logo/>
                    <h1 class="title">
                        Nuntius
                    </h1>
                    <h2 class="subtitle">
                        Système de gestion pour prestataires de services agricoles
                    </h2>
                </div>
            </section>
        </el-col>
        <el-col :span="12" class="form-container">
            <div class="container">
                <el-form :model="user" v-if="!isLogged">

                    <el-form-item label="Adresse email" prop="email">
                        <el-input type="email" v-model="user.email"/>
                    </el-form-item>

                    <el-form-item label="Mot de passe" prop="password">
                        <el-input type="password" v-model="user.password"/>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" @click="login">Se connecter</el-button>
                    </el-form-item>

                </el-form>

                <div v-if="isLogged">
                    <el-button type="primary" @click="logout">Se déconnecter</el-button>
                </div>
            </div>
        </el-col>
    </el-row>
</template>

<script>
    import * as axios from "axios";
    import {apiURL} from '../../../config'

    import {mapGetters} from 'vuex'

    import Logo from '../../../components/base/Logo'

    export default {
        components: {
            Logo
        },
        data() {
            return {
                user: {
                    email: null,
                    password: null,
                }
            }
        },
        computed: {
            ...mapGetters({
                isLogged: 'isLogged'
            })
        },
        methods: {
            async login() {
                this.$store.dispatch('login', {user: this.user})
                    .catch(error => {
                        this.$message.error('Merci de vérifier vos paramètres de connexion.');
                        console.log(error)
                    })
            },
            async logout() {
                this.$store.dispatch('logout');
            }
        },
        mounted() {
            this.$store.dispatch('checkLogged');
        }
    }
</script>


<style lang="scss" scoped>

    .form-container {
        background: #f2f2f2;
        * {
            width: 100%;
        }
    }

    .container {
        min-height: 100vh;
        display: flex;
        padding: 1rem;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .title {
        font-family: "Quicksand", "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; /* 1 */
        display: block;
        font-weight: bold;
        font-size: 3rem;
        text-transform: uppercase;
        color: #222222;
    }

    .subtitle {
        font-weight: 300;
        font-size: 2rem;
        color: #7b7b7b;
        word-spacing: 5px;
        padding-bottom: 15px;
    }

    .links {
        padding-top: 15px;
    }
</style>
