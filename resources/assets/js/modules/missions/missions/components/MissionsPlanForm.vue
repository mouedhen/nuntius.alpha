<template>
    <el-form :model="mission" :rules="rules" ref="missionForm">

        <el-form-item label="Date estimée de début" prop="estimated_start_date">
            <el-date-picker type="date" placeholder="choisir une date"
                            v-model="mission.estimated_start_date" style="width: 100%;"/>
        </el-form-item>

        <el-form-item label="Date estimé de fin" prop="estimated_end_date">
            <el-date-picker type="date" placeholder="choisir une date"
                            v-model="mission.estimated_end_date" style="width: 100%;"/>
        </el-form-item>

        <el-form-item label="Client" prop="customer_id">
            <el-select v-model="mission.customer_id" style="width: 100%;"
                       filterable placeholder="merci de sélectionner le client">
                <el-option
                        v-for="customer in customers"
                        :key="customer.id"
                        :label="customer.name"
                        :value="customer.id">
                </el-option>
            </el-select>
        </el-form-item>

        <el-form-item>
            <el-button type="primary" @click="onSubmit('missionForm')">Ajouter</el-button>
            <el-button @click="resetForm('missionForm')">Annuler</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    import Inputmask from "inputmask";
    import * as moment from 'moment'

    export default {
        props: ['mission', 'customers'],
        data() {
            let validateEndDate = (rule, value, callback) => {
                let start = moment(this.mission.estimated_start_date);
                let end = moment(this.mission.estimated_end_date);
                if (end.isBefore(start)) {
                    callback(new Error('La date de fin doit être supérieure à la date de début.'));
                } else {
                    callback();
                }
            };

            return {
                start_counter_time: null,
                end_counter_time: null,
                rules: {
                    estimated_start_date: [
                        {required: true, message: 'Le champ est obligatoire.', trigger: 'blur'},
                        {validator: validateEndDate, trigger: 'blur'}
                    ],
                    estimated_end_date: [
                        {required: true, message: 'Le champ est obligatoire.', trigger: 'blur'},
                        {validator: validateEndDate, trigger: 'blur'}
                    ],
                    customer_id: [
                        {required: true, message: 'Le champ est obligatoire.', trigger: 'blur'},
                    ],
                    start_counter: [
                        {required: true, message: 'Le champ est obligatoire.', trigger: 'blur'},
                    ],
                    fuel_unit_price: [
                        {required: true, message: 'Le champ est obligatoire.', trigger: 'blur'},
                    ],
                },
            }
        },
        methods: {
            onSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$emit('submit', this.mission);
                        return true
                    } else {
                        this.$message.error('Merci de vérifier les données saisies.');
                        return false
                    }
                })
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
        },
        mounted() {
            Inputmask().mask(document.querySelectorAll("input"));
        }
    }
</script>
