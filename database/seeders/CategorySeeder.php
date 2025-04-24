<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Du lịch',
            'Ẩm thực',
            'Công nghệ',
            'Sức khỏe',
            'Giáo dục',
            'Thể thao',
            'Giải trí',
            'Kinh doanh',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);
        }
    }
}
