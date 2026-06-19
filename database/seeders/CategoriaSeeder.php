<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 👈 ESTA LÍNEA ES LA QUE FALTA

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Tecnología', 'descripcion' => 'Software, hardware, IA, redes'],
            ['nombre' => 'Servicio Social', 'descripcion' => 'Proyectos comunitarios y voluntariado'],
            ['nombre' => 'Servicio Ambiental', 'descripcion' => 'Proyectos ecológicos, sostenibilidad y medio ambiente'],
            ['nombre' => 'Jurídica', 'descripcion' => 'Investigación y asesoría legal'],
            ['nombre' => 'Comunicaciones', 'descripcion' => 'Periodismo, medios, marketing digital, relaciones públicas'],
            ['nombre' => 'Administración de Empresas', 'descripcion' => 'Gestión empresarial, liderazgo, emprendimiento'],
            ['nombre' => 'Contaduría', 'descripcion' => 'Finanzas, auditoría, impuestos, contabilidad'],
            ['nombre' => 'Teología', 'descripcion' => 'Estudios religiosos, ética, filosofía cristiana'],
            ['nombre' => 'Ingeniería en Ciencias de la Computación', 'descripcion' => 'Desarrollo de software, sistemas, bases de datos, redes'],
            ['nombre' => 'Arte y Cultura', 'descripcion' => 'Literatura, música, teatro, patrimonio'],
        ]);
    }
}
