<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Berita;
use App\Models\Jabatan;
use App\Models\Pengurus;
use App\Models\Periode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // ADMIN
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('admin')
        ]);

        // PETUGAS
        User::create([
            'name' => 'Petugas',
            'username' => 'petugas',
            'email' => 'petugas@gmail.com',
            'role' => 'petugas',
            'password' => bcrypt('petugas')
        ]);

        // AUTHOR
        User::create([
            'name' => 'Author 1',
            'username' => 'author1',
            'email' => 'author1@gmail.com',
            'role' => 'author',
            'password' => bcrypt('author1')
        ]);
        User::create([
            'name' => 'Author 2',
            'username' => 'author2',
            'email' => 'author2@gmail.com',
            'role' => 'author',
            'password' => bcrypt('author2')
        ]);
        User::create([
            'name' => 'Author 3',
            'username' => 'author3',
            'email' => 'author3@gmail.com',
            'role' => 'author',
            'password' => bcrypt('author3')
        ]);

        // Pengguna
        User::create([
            'name' => 'Pengguna 1',
            'username' => 'pengguna1',
            'email' => 'pengguna1@gmail.com',
            'role' => 'author',
            'password' => bcrypt('pengguna1')
        ]);
        User::create([
            'name' => 'Pengguna 2',
            'username' => 'pengguna2',
            'email' => 'pengguna2@gmail.com',
            'role' => 'author',
            'password' => bcrypt('pengguna2')
        ]);
        User::create([
            'name' => 'Pengguna 3',
            'username' => 'pengguna3',
            'email' => 'pengguna3@gmail.com',
            'role' => 'author',
            'password' => bcrypt('pengguna3')
        ]);
        User::create([
            'name' => 'Pengguna 4',
            'username' => 'pengguna4',
            'email' => 'pengguna4@gmail.com',
            'role' => 'author',
            'password' => bcrypt('pengguna4')
        ]);

        Berita::factory(10)->create();

        // Periode::factory(1)->create();
        Periode::create([
            'masa_periode' => '2021-2022'
        ]);
        Periode::create([
            'masa_periode' => '2022-2023'
        ]);

        // Jabatan::factory(3)->create();
        Jabatan::create([
            'nama_jabatan' => 'Ketua'
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Sekretaris'
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Anggota'
        ]);

        // Pengurus::factory(9)->create();
        Pengurus::create([
            'nama_pengurus' => fake()->name(),
            'latar_belakang' => fake()->randomElement([
                'Dosen FH',
                'Mahasiswa FH',
                'Tendik',
                'Dosen Psikologi',
                'Mahasiswa Psikologi'
            ]),
            'jabatan_id' => '1',
            'periode_id' => '1'
        ]);
        Pengurus::create([
            'nama_pengurus' => fake()->name(),
            'latar_belakang' => fake()->randomElement([
                'Dosen FH',
                'Mahasiswa FH',
                'Tendik',
                'Dosen Psikologi',
                'Mahasiswa Psikologi'
            ]),
            'jabatan_id' => '2',
            'periode_id' => '1'
        ]);
        Pengurus::create([
            'nama_pengurus' => fake()->name(),
            'latar_belakang' => fake()->randomElement([
                'Dosen FH',
                'Mahasiswa FH',
                'Tendik',
                'Dosen Psikologi',
                'Mahasiswa Psikologi'
            ]),
            'jabatan_id' => '3',
            'periode_id' => '1'
        ]);
        Pengurus::create([
            'nama_pengurus' => fake()->name(),
            'latar_belakang' => fake()->randomElement([
                'Dosen FH',
                'Mahasiswa FH',
                'Tendik',
                'Dosen Psikologi',
                'Mahasiswa Psikologi'
            ]),
            'jabatan_id' => '3',
            'periode_id' => '1'
        ]);
    }
}
