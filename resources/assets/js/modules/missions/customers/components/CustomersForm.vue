<template>
    <el-form :model="customer" :rules="rules" ref="customerForm">
        <el-form-item label="Nom" prop="name">
            <el-input type="text" v-model="customer.name"/>
        </el-form-item>

        <el-form-item label="Catégorie" prop="category">
            <el-select v-model="customer.category"
                       style="width: 100%"
                       placeholder="Veuillez choisir la catégorie du client">
                <el-option label="Company" value="company"/>
                <el-option label="Particular" value="particular"/>
            </el-select>
        </el-form-item>

        <el-form-item label="CIN / Passeport" prop="cin_passport" v-if="customer.category === 'particular'">
            <el-input type="url" v-model="customer.cin_passport"/>
        </el-form-item>

        <el-form-item label="Matricule fiscal" prop="tax_registration_number" v-if="customer.category === 'company'">
            <el-input type="url" v-model="customer.tax_registration_number"/>
        </el-form-item>

        <el-form-item label="Email" prop="email">
            <el-input type="email" v-model="customer.email"/>
        </el-form-item>

        <el-form-item label="Numéro de téléphone" prop="phone_number">
            <el-input type="text" v-model="customer.phone_number"/>
        </el-form-item>

        <el-form-item label="Adresse postale" prop="address">
            <el-input type="textarea" v-model="customer.address"/>
        </el-form-item>

        <el-form-item>
            <el-button type="primary" @click="onSubmit('customerForm')">Sauvegarder</el-button>
            <el-button @click="resetForm('customerForm')">Annuler</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    // @TODO add validation rules
    import { Loading } from 'element-ui';

    export default {
        props: ['customer'],
        data() {
            return {
                rules: {
                    name: [
                        {required: true, message: 'Le nom est obligatoire', trigger: 'blur'},
                        {min: 3, max: 100, message: 'Length should be 3 to 5', trigger: 'blur'}
                    ],
                    category: [
                        {required: true, message: 'La catégorie est obligatoire', trigger: 'blur'},
                    ],
                },
            }
        },
        methods: {
            onSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$emit('submit', this.customer);
                        return true
                    } else {
                        this.$message.error('Errors, please check your form input.');
                        return false
                    }
                })
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
        },
    }
</script>
