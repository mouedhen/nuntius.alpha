<template>
    <div class="main">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ name: 'customers:index' }">Gestion des clients</el-breadcrumb-item>
            <el-breadcrumb-item :to="{ name: 'customers:create' }">Nouveau client</el-breadcrumb-item>
        </el-breadcrumb>
        <div class="margin-top">
            <customers-form :customer="customer" v-on:submit="submitCustomer"/>
        </div>
    </div>
</template>

<script>
    import CustomersForm from './../components/CustomersForm.vue'
    import {initialCustomerData} from './../config'

    export default {
        components: {CustomersForm},
        data() {
            return {
                index: '0-1',
                customer: initialCustomerData(),
            }
        },
        methods: {
            submitCustomer(customer) {
                this.$store.dispatch('saveCustomer', {customer: this.customer})
                    .then((customer) => {
                        this.$message.success('Success, customer' + customer.name + ' created.');
                        this.customer = initialCustomerData();
                        this.$router.push({name: 'customers:details', params: {id: customer.id}})
                    })
                    .catch(error => {
                        this.$message.error('Error, Record already exit!');
                    })
            }
        }
    }
</script>
