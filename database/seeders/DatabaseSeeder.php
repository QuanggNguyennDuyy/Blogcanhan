<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
        ]);

        // User::factory(10)->create();

        // Tạo thư mục posts trong storage nếu chưa có
        if (!Storage::exists('public/posts')) {
            Storage::makeDirectory('public/posts');
        }

        // Tạo user admin
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Tạo các bài viết mẫu
        $categories = Category::all();
        $sampleImages = [
            'du-lich' => 'travel.jpg',
            'am-thuc' => 'food.jpg',
            'cong-nghe' => 'technology.jpg',
            'suc-khoe' => 'health.jpg',
            'giao-duc' => 'education.jpg',
            'the-thao' => 'sports.jpg',
            'giai-tri' => 'entertainment.jpg',
            'kinh-doanh' => 'business.jpg',
        ];

        $sampleContent = [
            'du-lich' => 'Khám phá những điểm đến tuyệt vời tại Việt Nam. Từ những bãi biển đẹp như tranh vẽ ở Phú Quốc đến những dãy núi hùng vĩ ở Sapa, từ phố cổ Hội An đến vịnh Hạ Long, mỗi nơi đều mang một vẻ đẹp riêng đang chờ bạn khám phá.',
            'am-thuc' => 'Hành trình khám phá ẩm thực Việt Nam với những món ăn đặc sắc. Phở, bánh mì, bún chả... không chỉ là món ăn mà còn là niềm tự hào của ẩm thực Việt Nam trên bản đồ ẩm thực thế giới.',
            'cong-nghe' => 'Cập nhật những xu hướng công nghệ mới nhất trên thế giới. Từ smartphone, laptop đến AI và xe điện, những công nghệ này đang thay đổi cách chúng ta sống và làm việc.',
            'suc-khoe' => 'Những bí quyết sống khỏe mỗi ngày. Tập luyện, dinh dưỡng và nghỉ ngơi hợp lý là chìa khóa để có một sức khỏe tốt và cuộc sống hạnh phúc.',
            'giao-duc' => 'Khám phá những phương pháp giáo dục hiện đại. Cách giúp con phát triển toàn diện về thể chất, trí tuệ và tình cảm trong thời đại số.',
            'the-thao' => 'Tin tức thể thao nóng hổi và phân tích chuyên sâu. Từ bóng đá, tennis đến các môn thể thao khác, cập nhật những thông tin mới nhất từ làng thể thao.',
            'giai-tri' => 'Những xu hướng giải trí mới nhất. Phim ảnh, âm nhạc, nghệ thuật và những câu chuyện thú vị từ giới giải trí trong và ngoài nước.',
            'kinh-doanh' => 'Phân tích thị trường và chiến lược kinh doanh. Những bài học từ các doanh nghiệp thành công và xu hướng kinh doanh mới trong thời đại số.',
        ];

        foreach ($categories as $category) {
            // Tạo tên file ảnh
            $thumbnailName = 'posts/' . $category->slug . '.jpg';

            // Copy ảnh mẫu tương ứng vào storage
            $sampleImage = $sampleImages[$category->slug] ?? 'default.jpg';
            $sourcePath = public_path('images/' . $sampleImage);

            if (File::exists($sourcePath)) {
                Storage::disk('public')->put($thumbnailName, File::get($sourcePath));
            }

            Post::create([
                'title' => "Khám phá thế giới {$category->name}",
                'content' => $sampleContent[$category->slug] ?? "Đây là nội dung bài viết mẫu về {$category->name}. Bài viết này được tạo tự động để kiểm tra giao diện của blog.",
                'category_id' => $category->id,
                'user_id' => $user->id,
                'thumbnail' => $thumbnailName,
                'slug' => Str::slug("Khám phá thế giới {$category->name}"),
                'status' => 'published'
            ]);
        }
    }
}
