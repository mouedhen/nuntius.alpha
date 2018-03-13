<template>
    <div class="main">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ name: 'customers:index' }">Gestion des clients</el-breadcrumb-item>
            <el-breadcrumb-item :to="{ name: 'customers:create' }">Liste des clients</el-breadcrumb-item>
        </el-breadcrumb>
        <div class="margin-top">
            <customers-table :customers="customers"/>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import {Row as ElRow, Col as ElCol} from 'element-ui'
    import CustomersSideBar from './../components/CustomersSideBar.vue'
    import CustomersTable from './../components/CustomersTable.vue'

    export default {
        components: {ElRow, ElCol, CustomersSideBar, CustomersTable},
        data() {
            return {
                index: '0-2'
            }
        },
        computed: {
            ...mapGetters({
                customers: 'getCustomers',
            }),
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
