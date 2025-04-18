<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public $products = [
        [
            'code'                  => 'NonBox',
            'name'                  => 'n2 PACKAGE FOC travel size n5 n7 n8',
            'description'           => 'n2 PACKAGE FOC travel size n5 n7 n8',
            'price'                 => 1594,
            'category_id'           => 8,
            'shipping_quantity'     => 4,
            'image_1'               => 'Package.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'NonBox2',
            'name'                  => 'n4 PACKAGE FOC travel size n5 n7 n8',
            'description'           => 'n4 PACKAGE FOC travel size n5 n7 n8',
            'price'                 => 1594,
            'category_id'           => 8,
            'shipping_quantity'     => 4,
            'image_1'               => '01.png',
            'status'                => 'Active',
            'remarks'               => 'testing'
            
        ],
        [
            'code'                  => 'R001',
            'name'                  => 'n1 - D.A.F CRYSTAL SERUM I',
            'description'           => 'A bioactive essence that penetrates deeply into the skin, while providing a high amount of moisture to repair damaged cells effectively. It stimulates cell regeneration and reduces the appearance of wrinkles, leaving skin smooth and radiant.',
            'price'                 => 390,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '06.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing'
            
        ],
        [
            'code'                  => 'R002',
            'name'                  => 'n2 - P.A.C ESSENCE II',
            'description'           => "An intensive conditioning, pore repairing essence that rebalances the skin's pH levels, regulates sebum production, reduces skin inflammation, eliminates acnes and scars, while providing firming effects.",
            'price'                 => 332,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '07.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing'
            
        ],
        [
            'code'                  => 'R003',
            'name'                  => 'n3 - P.R.E WHITENING III',
            'description'           => "Contains natural whitening and anti-oxidant properties to prevent the production of dark spots, while improving skin's elasticity and firmness; It repairs and moisturizes the skin, providing a fast and safe way to achieve whitening effects.",
            'price'                 => 413,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '08.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'R004',
            'name'                  => 'n4 - 3R BOOSTER IV',
            'description'           => "A bioactive essence that penetrates deeply into the skin, while providing a high amount of moisture to repair damaged cells effectively. It stimulates cell regeneration and reduces the appearance of wrinkles, leaving skin smooth and radiant.",
            'price'                 => 332,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '09.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'R005',
            'name'                  => 'n5 - 3 IN 1 CLEANSING MILK',
            'description'           => "Highly moisturizing cleansing milk that delicately clean out pores while still nourishes the skin. It rebalances and soothes the skin. Can also be used as a make-up remover. Suitable for all skin types.",
            'price'                 => 217,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '10.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'R007',
            'name'                  => 'n7 - BIO-MIST',
            'description'           => "An anti-oxidant formula for cell restructuring and anti-aging conditions. It speed up the regeneration of cells, and stimulates the production of collagen while providing firming effects, leaving skin healthy and radiant.",
            'price'                 => 252,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '11.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'R008',
            'name'                  => 'n8 - UV DEFENCE SPF 45',
            'description'           => "Protects skin from sun and harsh UVA/ UVB rays. It soothes and re-hydrates the skin, while covering up blemishes and brightens skin tone.",
            'price'                 => 263,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '12.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'R009',
            'name'                  => 'nE - EVERGLOW CARE',
            'description'           => "Able to effectively nourish and condition the skin to keep it moisturized. Meanwhile, it can repair damaged cells and improve the cell's immunity. After application, skin will look bright, moisturized and radiant",
            'price'                 => 459,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '13.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'R012',
            'name'                  => 'Miracle Anti-Oxidant Rose Oil (30ml)',
            'description'           => 'Miracle Anti-Oxidant Rose Oil (30ml)',
            'price'                 => 339,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '02.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'R011',
            'name'                  => 'The Lab Soothing Mask (4pcs)',
            'description'           => 'The Lab Soothing Mask (4pcs)',
            'price'                 => 168,
            'discount'              => 0,
            'category_id'           => 5,
            'shipping_quantity'     => 1,
            'image_1'               => '04.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'N001',
            'name'                  => 'nRose (15 sachet)',
            'description'           => 'This is nRose (15 sachet)',
            'price'                 => 194,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '03.png',
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'Br1',
            'name'                  => 'Brush (short)',
            'description'           => 'Brush (short)',
            'price'                 => 58,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => null,
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'Br2',
            'name'                  => 'Brush (Long)',
            'description'           => 'Brush (Long)',
            'price'                 => 68,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => null,
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'Travel',
            'name'                  => '7-Piece Travel Set',
            'description'           => '7-Piece Travel Set',
            'price'                 => 868,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => null,
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'N002',
            'name'                  => 'nSlims (15 sachet)',
            'description'           => 'nSlims (15 sachet)',
            'price'                 => 238,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => null,
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
        [
            'code'                  => 'novset2',
            'name'                  => 'Essential Set (n1, n7, n8)',
            'description'           => 'Essential Set (n1, n7, n8)',
            'price'                 => 711,
            'category_id'           => 7,
            'shipping_quantity'     => 3,
            'image_1'               => null,
            'status'                => 'Active',
            'remarks'               => 'testing'
        ],
    ];

    public function run()
    {
        foreach ($this->products as $product) {
            Product::create($product);
        }
    }
}
