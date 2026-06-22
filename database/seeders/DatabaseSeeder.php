public function run(): void
{
    $this->call([
        UserSeeder::class,
        AdminSeeder::class,
    ]);
}