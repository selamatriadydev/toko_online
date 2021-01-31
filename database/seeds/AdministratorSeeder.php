<?php

use Illuminate\Database\Seeder;
use App\User;
class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new User;
        $administrator->username ="administrator";
        $administrator->name ="Site Administrator";
        $administrator->email ="adminstrator@larashop.net";
        $administrator->address ="adminstrator";
        $administrator->phone ="0000";
        $administrator->avatar ="0000";
        $administrator->roles = json_encode(['ADMIN']);
        $administrator->password = \Hash::make("larashop");

        $administrator->save();

        $this->command->info("user admin berhasil di input");
    }
}
