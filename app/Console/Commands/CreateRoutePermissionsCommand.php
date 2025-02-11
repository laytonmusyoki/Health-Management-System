<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class CreateRoutePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create-permission-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a permission routes.';

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
     * @return int
     */
    public function handle()
    {
        $routes = Route::getRoutes()->getRoutes();

        foreach ($routes as $route) {
            // Ensure the route has a name
            if (empty($route->getName())) {
                continue;
            }

            // Get the route's action middleware
            $middleware = $route->getAction('middleware');

            // Skip if middleware is not defined or not an array
            if (empty($middleware) || !is_array($middleware)) {
                continue;
            }

            // Check if the route uses the 'web' middleware
            if (in_array('web', $middleware)) {
                $permission = Permission::where('name', $route->getName())->first();

                // Create the permission if it doesn't exist
                if (is_null($permission)) {
                    Permission::create(['name' => $route->getName()]);
                }
            }
        }

        $this->info('Permission routes added successfully.');
        return 0; // Indicate success
    }
}