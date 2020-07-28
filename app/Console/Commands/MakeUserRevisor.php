<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class MakeUserRevisor extends Command
{
  
    protected $signature = 'wallapop_sava:makeUserRevisor';
    protected $description = 'hace un usuario revisor';

    public function __construct()
    {
        parent::__construct();
    }

  
    public function handle()
    {
        $email = $this->ask('Introducir el correo del usuario que quires hacer como revisor');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error('Usuario no encontrado');
        return;
        }

        $user->is_revisor = true;
        $user->save();
        $this->info("El usuario {$user->name} ahora es un revisor");
    }
}
