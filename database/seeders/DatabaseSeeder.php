<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Detpromocione;
use App\Models\Detventa;
use App\Models\Matprima;
use App\Models\Pqr;
use App\Models\Producto;
use App\Models\Promocione;
use App\Models\Proveedore;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        // $this->call(UsuarioSeeder::class);
         $this->call(CategoriaSeeder::class);
         /*$this->call(ProductoSeeder::class);
         $this->call(VentaSeeder::class);
         $this->call(DetventaSeeder::class);
         $this->call(PromocioneSeeder::class);
         $this->call(DetpromocioneSeeder::class);
         $this->call(PqrSeeder::class);
         $this->call(MatprimaSeeder::class);
         $this->call(ProveedoreSeeder::class); */
 
         User::Factory(100)->create();
         Producto::Factory(20)->create();
         Promocione::Factory(10)->create();
         Detpromocione::Factory(40)->create();
         Venta::factory(10)->create();
         Detventa::factory(30)->create();
         Pqr::factory(10)->create();
         Matprima::factory(10)->create();
         Proveedore::factory(10)->create();
         // User::factory(10)->create();;
    }
}
