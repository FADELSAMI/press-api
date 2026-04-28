<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Load menu items from the CSV file
        $menuItems = $this->getMenuItems();

        // Share the menu items with all views
        View::share('menuItems', $menuItems);
    }

    /**
     * Load menu items from the CSV file.
     */
    private function getMenuItems()
    {
        $menuItems = [];
        if (($handle = fopen(public_path('menu.csv'), 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $menuItems[] = [
                    'label' => $data[0],
                    'url' => $data[1],
                    'page blade' => $data[2],
                ];
            }
            fclose($handle);
        }
        return $menuItems;
    }
}
