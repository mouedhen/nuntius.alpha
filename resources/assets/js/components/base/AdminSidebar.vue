<template>
    <el-menu :router="true"
            style="height: 100vh"
            class="sidebar">
        <div class="avatar">
            <h1>Nuntius</h1>
            <!-- <logo /> -->
        </div>

        <el-menu-item index="0" :route="{name: 'dashboard'}">
            <i class="el-icon-menu"></i>
            <span>Tableau de bord</span>
        </el-menu-item>

        <el-submenu index="1">
            <template slot="title">
                <i class="material-icons">&#xE853;</i>
                <span>Gestion des utilisateurs</span>
            </template>
            <el-menu-item-group title="Utilisateurs">
                <el-menu-item index="1-0" :route="{name: 'users:index'}">Tableau de bord</el-menu-item>
                <el-menu-item index="1-1">Ajouter des utilisateurs</el-menu-item>
                <el-menu-item index="1-2" :route="{name: 'users:list'}">Liste des utilisateurs</el-menu-item>
            </el-menu-item-group>
        </el-submenu>
    </el-menu>
</template>

<script>
    export default {
        //
    }
</script>