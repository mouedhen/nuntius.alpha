<template>
    <data-tables
            :data="customers"
            :table-props="tableProps"
            :checkbox-filter-def="checkboxFilterDef"
            :action-col-def="actionColDef">
        <el-table-column
                v-for="title in titles"
                :prop="title.prop"
                :label="title.label"
                :key="title.prop"
                sortable="custom">
        </el-table-column>
    </data-tables>
</template>

<script>
    export default {
        props: ['customers'],
        data() {
            return {
                titles: [
                    {prop: 'name', label: 'Nom'},
                    {prop: 'email', label: 'Email'},
                    {prop: 'phone_number', label: 'Numéro de téléphone'},
                    {prop: 'category', label: 'Catégorie'},
                ],
                tableProps: {
                    defaultSort: {
                        prop: 'name',
                    }
                },
                checkboxFilterDef: {
                    colProps: {
                        span: 19
                    },
                    props: 'category',
                    def: [{
                        'code': 'particular',
                        'name': 'Particuliers'
                    }, {
                        'code': 'company',
                        'name': 'Entreprises'
                    }]
                },
                actionColDef: {
                    label: 'Actions',
                    tableColProps: {
                        align: 'center'
                    },
                    def: [{
                        name: 'détails',
                        handler: row => {
                            this.$router.push({name: 'customers:details', params: {id: row.id}})
                        }
                    },{
                        name: 'modifier',
                        handler: row => {
                            this.$router.push({name: 'customers:update', params: {id: row.id}})
                        }
                    }, {
                        name: 'supprimer',
                        handler: row => {
                            this.$store.dispatch('deleteCustomer', {customerID: row.id}).then(() => {
                                this.fetchCustomers();
                            })
                        }
                    }]
                }
            }
        }
    }
</script>
