<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user 
                            {--name=       : Name of the User}
                            {--email=      : Email address of the User}
                            {--u|username= : Desired username} 
                            {--p|password= : Desired password}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->fullname();
        $email = $this->email();
        $uname = $this->username();
        $upass = $this->password();


        $this->createTheUser([
            'name' => $name,
            'email' => $email,
            'username' => $uname,
            'password' => Hash::make($upass),
        ]);
    }

    public function createTheUser($user)
    {
        $this->info('Creating the user.');

        try {
            factory(User::class)->create($user);
            
            $this->info('User created.');
        } catch(Exception $e) {
            $this->error('Error in creating user.');
        } 
    }

    private function fullname()
    {
        return $this->option('name') ?? $this->ask('Name of the User');
    }

    private function email()
    {
        return $this->option('email') ?? $this->ask('Email');
    }

    private function username () 
    {
        return $this->option('username') ?? $this->ask('Desired Username');
    }

    private function password()
    {
        return $this->option('password') ?? $this->secret('Desired Password');
    }
}
