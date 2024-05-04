<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Creador;


class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creación de usuario administrador
        $user = User::create([
            'name' => 'Academico2023',
            'email' => 'academico2023@hotmail.com',
            'password' => Hash::make('uaslp'),
        ])->assignRole(['creador', 'admin']);

        $creador = Creador::create([
            'nombre' => 'Profesor Ramón',
            'correo_contacto' => 'profRamon@gmail.com',
            'user_id' => $user->id,
        ]);
    }
}
