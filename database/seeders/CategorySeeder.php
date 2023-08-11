<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public $categories = [
        [
            'name_en'               => 'Furniture',
            'name_cn'               => '家具',
            'status'                => 'Inactive',
            'created_by'            => 1,
            'updated_by'            => 1,
        ],
        [
            'name_en'               => 'Shirt',
            'name_cn'               => '衣服',
            'status'                => 'Inactive',
            'created_by'            => 1,
            'updated_by'            => 1,
        ],
        [
            'name_en'               => 'Gadget',
            'name_cn'               => '电子产品',
            'status'                => 'Inactive',
            'created_by'            => 1,
            'updated_by'            => 1,
        ],
        [
            'name_en'               => 'Care',
            'name_cn'               => '产品',
            'status'                => 'Inactive',
            'created_by'            => 1,
            'updated_by'            => 1,
        ],
        [
            'name_en'               => 'Masks',
            'name_cn'               => '面膜',
            'status'                => 'Inactive',
            'created_by'            => 1,
            'updated_by'            => 1,
        ],
        [
            'name_en'               => 'Set',
            'name_cn'               => '配套',
            'status'                => 'Inactive',
            'created_by'            => 1,
            'updated_by'            => 1,
        ],
        [
            'name_en'               => 'Retail Products',
            'name_cn'               => 'Retail Products',
            'status'                => 'Active',
            'created_by'            => 1,
            'updated_by'            => 1,
        ],
        [
            'name_en'               => 'Package',
            'name_cn'               => 'Package',
            'status'                => 'Active',
            'created_by'            => 1,
            'updated_by'            => 1,
        ],
    ];

    public function run()
    {
        foreach ($this->categories as $category) {
            Category::create($category);
        }
    }
}
