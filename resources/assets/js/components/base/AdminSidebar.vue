<template>
    <el-menu :router="true"
            style="height: 100vh"
            class="sidebar">
        <div class="avatar">
            <h1>Nuntius</h1>
            <!-- <logo /> -->
        </div>

        <el-menu-item index="100" :route="{name: 'dashboard'}">
            <i class="material-icons">&#xE871;</i>
            <span>Tableau de bord</span>
        </el-menu-item>

        <el-submenu index="0" >
            <template slot="title">
                <i class="material-icons">&#xE85D;</i>
                <span>Gestion des Missions</span>
            </template>
            <el-menu-item index="0-0" :route="{name: 'missions:index'}">Tableau de bord</el-menu-item>
            <el-menu-item index="0-1" :route="{name: 'missions:create'}">Nouvelle Mission</el-menu-item>
            <el-menu-item index="0-2" :route="{name: 'missions:list'}">Liste des Missions</el-menu-item>
        </el-submenu>

        <el-submenu index="1" >
            <template slot="title">
                <i class="material-icons">&#xE85E;</i>
                <span>Gestion des clients</span>
            </template>
            <el-menu-item index="1-0" :route="{name: 'customers:index'}">Tableau de bord</el-menu-item>
            <el-menu-item index="1-1" :route="{name: 'customers:create'}">Nouveau client</el-menu-item>
            <el-menu-item index="1-2" :route="{name: 'customers:list'}">Liste des clients</el-menu-item>
        </el-submenu>

        <el-submenu index="2">
            <template slot="title">
                <i class="material-icons">&#xE853;</i>
                <span>Gestion des utilisateurs</span>
            </template>
            <el-menu-item-group title="Utilisateurs">
                <el-menu-item index="2-0" :route="{name: 'users:index'}">Tableau de bord</el-menu-item>
                <el-menu-item index="2-1" :route="{name: 'users:create'}">Ajouter des utilisateurs</el-menu-item>
                <el-menu-item index="2-2" :route="{name: 'users:list'}">Liste des utilisateurs</el-menu-item>
            </el-menu-item-group>
        </el-submenu>

        <el-submenu index="3" >
            <template slot="title">
                <i class="material-icons">&#xE869;</i>
                <span>Configuration</span>
            </template>
            <el-menu-item index="1-0" :route="{name: 'conductors:index'}">Chauffeurs</el-menu-item>
            <el-menu-item index="1-1" :route="{name: 'tractors:index'}">Tracteurs</el-menu-item>
            <el-menu-item index="1-2" :route="{name: 'tools:index'}">Outils</el-menu-item>
        </el-submenu>

    </el-menu>
</template>

<script>
    export default {
        //
    }
</script>