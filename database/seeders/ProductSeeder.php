<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public $products = [
        [
            'code'                  => 'Br1',
            'name_en'               => 'Brush (short)',
            'name_cn'               => '刷子（短）',
            'desc_en'               => 'Brush (short)',
            'desc_cn'               => '刷子（短）',
            'price'                 => 58,
            'discount'              => 0,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '1.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing',
            'updated_at'            => null,
            'created_by'            => 1,
        ],
        [
            'code'                  => 'Br2',
            'name_en'               => 'Brush (Long)',
            'name_cn'               => '刷子（长）',
            'desc_en'               => 'Brush (Long)',
            'desc_cn'               => '刷子（长）',
            'price'                 => 68,
            'discount'              => 0,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '2.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing',
            'updated_at'            => null,
            'created_by'            => 1,
        ],
        [
            'code'                  => 'NonBox',
            'name_en'               => 'n2 PACKAGE FOC travel size n5 n7 n8',
            'name_cn'               => 'n2 配套 送 旅行装 n5 n7 n8',
            'desc_en'               => null,
            'desc_cn'               => null,
            'price'                 => 1594,
            'discount'              => 15,
            'category_id'           => 8,
            'shipping_quantity'     => 4,
            'image_1'               => '3.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing',
            'updated_at'            => null,
            'created_by'            => 1,
        ],
        [
            'code'                  => 'R001',
            'name_en'               => 'n1 - D.A.F CRYSTAL SERUM I',
            'name_cn'               => 'n1 - D.A.F 水晶精华露',
            'desc_en'               => 'A bioactive essence that penetrates deeply into the skin, while providing a high amount of moisture to repair damaged cells effectively. It stimulates cell regeneration and reduces the appearance of wrinkles, leaving skin smooth and radiant.',
            'desc_cn'               => '高效滋润，深层保湿，生物活性精华素，能迅速深入皮肤，为衰竭细胞补充大量水分，促进细胞再生，能明显消除皱纹，让皮肤呈现嫩滑亮丽。</p>',
            'price'                 => 390,
            'discount'              => 0,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '4.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing',
            'updated_at'            => null,
            'created_by'            => 1,
        ],
        [
            'code'                  => 'R002',
            'name_en'               => 'n2 - P.A.C ESSENCE II',
            'name_cn'               => 'n2 - P.A.C 晶萃',
            'desc_en'               => "An intensive conditioning, pore repairing essence that rebalances the skin's pH levels, regulates sebum production, reduces skin inflammation, eliminates acnes and scars, while providing firming effects.",
            'desc_cn'               => "深层调理，毛孔修复，平衡油性肤质，解脂抗炎，特效消除粉刺和暗疮，紧肤。",
            'price'                 => 332,
            'discount'              => 5,
            'category_id'           => 7,
            'shipping_quantity'     => 1,
            'image_1'               => '5.jpg',
            'status'                => 'Active',
            'remarks'               => 'testing',
            'updated_at'            => null,
            'created_by'            => 1,
        ],
    ];

    public function run()
    {
        foreach ($this->products as $product) {
            Product::create($product);
        }
    }
}
