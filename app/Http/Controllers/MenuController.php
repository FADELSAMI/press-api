<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public static function getMenuItems()
    {
        $menuItems = [];
        if (($handle = fopen(public_path('menu.csv'), 'r')) !== false) {
            // Read each line of the CSV
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $menuItems[] = [
                    'label' => $data[0],
                    'url' => $data[1]
                ];
            }
            fclose($handle);
        }
        return $menuItems;
    }
}
