<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        \App\Models\Auth\Role::truncate();
        DB::statement("SET foreign_key_checks=1");

        $admin = [
            'name' => 'admin',
            'display_name' => 'Administrateur',
            'description' => 'A le contrôle totale sur toute l\'application'
        ];
        $manager = [
            'name' => 'manager',
            'display_name' => 'Gestionnaire',
            'description' => 'Responsable de la gestion des employées, de la flotte et de la planification des missions.'
        ];
        $supervisor = [
            'name' => 'supervisor',
            'display_name' => 'Responsable terrain',
            'description' => 'A accès à la liste des missions, peut démarrer toutes mission confirmée.'
        ];
        $employee = [
            'name' => 'employee',
            'display_name' => 'Employé standard',
            'description' => 'Peut lancer des tâches pour chaque mission sur laquelle il a été affectée.'
        ];
        \App\Models\Auth\Role::create($admin);
        \App\Models\Auth\Role::create($manager);
        \App\Models\Auth\Role::create($supervisor);
        \App\Models\Auth\Role::create($employee);
    }
}
