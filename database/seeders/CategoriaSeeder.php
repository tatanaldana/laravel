<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoria= new Categoria();
        $categoria->nombre_cat='Hamburguesas';
        $categoria->save();

        $categoria1= new Categoria();
        $categoria1->nombre_cat='Pizzas';
        $categoria1->save();

        $categoria2= new Categoria();
        $categoria2->nombre_cat='Salchipapa';
        $categoria2->save();

        $categoria3= new Categoria();
        $categoria3->nombre_cat='Bebidas';
        $categoria3->save();

        $categoria3= new Categoria();
        $categoria3->nombre_cat='Promociones';
        $categoria3->save();
    }
}
