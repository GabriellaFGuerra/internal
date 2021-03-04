<?php

namespace App\Traits;

use App\Models\Category;

trait CategoryTrait
{
    public function showCategories()
    {
        $categories = Category::orderBy('category')->get();
        return $categories;
    }
}
