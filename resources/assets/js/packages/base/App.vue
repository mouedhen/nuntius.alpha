<template>
    <el-container>
        <el-aside width="250px" v-if="!isFullMain" class="noprint">
            <admin-sidebar/>
        </el-aside>
        <el-container class="is-vertical">
            <el-header v-if="!isFullMain" style="padding: 0" class="noprint">
                <el-menu
                        background-color="#27ae60"
                        text-color="#f2f2f2"
                        active-text-color="#f2f2f2"
                        class="navbar" mode="horizontal">
                    <el-menu-item index="4" @click="logout">Se déconnecter</a>
                    </el-menu-item>
                </el-menu>
            </el-header>
            <el-main style="padding: 0">
                <transition name="fade">
                    <router-view/>
                </transition>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>

    import Logo from '../../components/base/Logo'
    import AdminSidebar from '../../components/base/AdminSidebar'
    import {mapGetters} from 'vuex'

    export default {
        components: {
            Logo,
            AdminSidebar,
        },
        computed: {
            ...mapGetters({
                isLogged: 'isLogged'
            }),
            isFullMain() {
                return (!this.isLogged) || (this.$route.name === 'index')
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/')
                    })
            }
        },
        mounted() {
            this.$store.dispatch('checkLogged');
        }
    }
</script>

<style lang="scss">
    .avatar {
        // background: orange;
        height: 60px;
        display: flex;
        padding: 1rem;
        justify-content: center;
        align-content: center;
        text-align: center;
    }
</style>