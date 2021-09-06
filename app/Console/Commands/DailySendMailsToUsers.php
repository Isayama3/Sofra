<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class DailySendMailsToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:send-mails-to-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send  mails to users everyday';

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
    public function handle(Faker $faker)
    {
        DB::table('users')->insert([
            'name'=>$faker->name,
            'email'=>$faker->email,
            'password'=>Hash::make('123'),
        ]);
        $this->info("Daily insert new record in users's table");

    }
}
