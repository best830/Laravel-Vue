<?php

use Illuminate\Database\Seeder;
use App\DomainUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;



class DomainUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       

        DomainUser::create([
            'user_id' => 3,            
            'domain_id' => 5,            
        ]);

        DomainUser::create([
            'user_id' => 4, 
            'domain_id' => 4,            
        ]);

        DomainUser::create([
            'user_id' => 3, 
            'domain_id' => 3,            
        ]);

        DomainUser::create([
            'user_id' => 4,
            'domain_id' => 2,           
        ]);

        DomainUser::create([
            'user_id' => 3,  
            'domain_id' => 1,          
        ]);
        
    }
}
