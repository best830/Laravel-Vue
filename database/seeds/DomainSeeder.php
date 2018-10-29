<?php

use Illuminate\Database\Seeder;
use App\Domain;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;



class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       

        Domain::create([
            'name' => 'mathematics',            
        ]);

        Domain::create([
            'name' => 'english',            
        ]);

        Domain::create([
            'name' => 'science',            
        ]);

        Domain::create([
            'name' => 'history',            
        ]);

        Domain::create([
            'name' => 'physics',            
        ]);
        
    }
}
