<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Get seller users
        $fashionStore = User::where('email', 'fashion@rewear.com')->first();
        $vintageShop = User::where('email', 'vintage@rewear.com')->first();
        $kidsFashion = User::where('email', 'kids@rewear.com')->first();
        $sportyStyle = User::where('email', 'sporty@rewear.com')->first();
        $beautyStore = User::where('email', 'beauty@rewear.com')->first();
        $luxuryBoutique = User::where('email', 'luxury@rewear.com')->first();

        // Get categories
        $womensCategory = Category::where('name', 'Women\'s')->first();
        $mensCategory = Category::where('name', 'Men\'s')->first();
        $luxuryCategory = Category::where('name', 'Luxury')->first();
        $healthBeautyCategory = Category::where('name', 'Health & Beauty')->first();
        $babiesKidsCategory = Category::where('name', 'Babies & Kids')->first();
        $electronicsCategory = Category::where('name', 'Electronics')->first();

        // Women's Category Products
        Product::create([
            'name' => 'Zara Summer Floral Dress',
            'description' => 'Beautiful floral dress from Zara, perfect for summer. Size M, never worn.',
            'price' => 299000,
            'stock' => 1,
            'category_id' => $womensCategory->id,
            'user_id' => $fashionStore->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567205/products/x6taalscjo4gajaugtxh.jpg',
            'condition' => 'new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:06:46'
        ]);

        Product::create([
            'name' => 'Nike Dri-FIT Running Shorts',
            'description' => 'Lightweight running shorts with built-in liner. Size S, excellent condition.',
            'price' => 199000,
            'stock' => 1,
            'category_id' => $womensCategory->id,
            'user_id' => $sportyStyle->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748571940/products/ui66wrpluujtvay6iwko.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 19:25:42'
        ]);

        Product::create([
            'name' => 'H&M Blazer',
            'description' => 'Classic black blazer, perfect for office wear. Size S, like new condition.',
            'price' => 249000,
            'stock' => 1,
            'category_id' => $womensCategory->id,
            'user_id' => $fashionStore->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567426/products/o95ahqh0vrmvu8hitwrk.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:10:27'
        ]);

        Product::create([
            'name' => 'Adidas Yoga Pants',
            'description' => 'High-waisted yoga pants with pockets. Size M, excellent condition.',
            'price' => 179000,
            'stock' => 1,
            'category_id' => $womensCategory->id,
            'user_id' => $sportyStyle->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567141/products/fwjmkzedmjl5gx84nbn1.jpg',
            'condition' => 'good',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:05:42'
        ]);

        Product::create([
            'name' => 'Uniqlo Cardigan',
            'description' => 'Soft knit cardigan in beige. Size L, good condition.',
            'price' => 159000,
            'stock' => 1,
            'category_id' => $womensCategory->id,
            'user_id' => $fashionStore->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567483/products/wz6poladotysfziz6vb0.avif',
            'condition' => 'good',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:11:24'
        ]);

        // Men's Category Products
        Product::create([
            'name' => 'Uniqlo Slim Fit Jeans',
            'description' => 'Classic slim fit jeans from Uniqlo. Size 32, excellent condition.',
            'price' => 199000,
            'stock' => 1,
            'category_id' => $mensCategory->id,
            'user_id' => $fashionStore->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567532/products/wlhracgn895oiwxaacqc.avif',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:12:13'
        ]);

        Product::create([
            'name' => 'Adidas Originals T-Shirt',
            'description' => 'Classic Adidas Originals t-shirt. Size L, good condition.',
            'price' => 149000,
            'stock' => 1,
            'category_id' => $mensCategory->id,
            'user_id' => $sportyStyle->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748547602/products/rulow2lzw5gizqfgm6xs.jpg',
            'condition' => 'good',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 12:40:03'
        ]);

        Product::create([
            'name' => 'Nike Air Jordan T-Shirt',
            'description' => 'Limited edition Air Jordan graphic tee. Size XL, new with tags.',
            'price' => 299000,
            'stock' => 1,
            'category_id' => $mensCategory->id,
            'user_id' => $sportyStyle->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567575/products/yc5nyd1ertebgdyrvrfj.avif',
            'condition' => 'new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:12:56'
        ]);

        Product::create([
            'name' => 'Zara Formal Shirt',
            'description' => 'Crisp white formal shirt. Size M, like new condition.',
            'price' => 229000,
            'stock' => 1,
            'category_id' => $mensCategory->id,
            'user_id' => $fashionStore->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567616/products/kyd6v8y9nczvovphng3m.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:13:38'
        ]);

        Product::create([
            'name' => 'H&M Chino Pants',
            'description' => 'Classic khaki chino pants. Size 34, good condition.',
            'price' => 179000,
            'stock' => 1,
            'category_id' => $mensCategory->id,
            'user_id' => $fashionStore->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567716/products/lspnld0c20862tlpl5zr.jpg',
            'condition' => 'good',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:15:16'
        ]);

        // Luxury Category Products
        Product::create([
            'name' => 'Louis Vuitton Neverfull MM',
            'description' => 'Authentic LV Neverfull MM in Damier Ebene. Comes with dust bag and receipt.',
            'price' => 15990000,
            'stock' => 1,
            'category_id' => $luxuryCategory->id,
            'user_id' => $luxuryBoutique->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567847/products/o199k2pu9eefc4oeh7dn.avif',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:17:30'
        ]);

        Product::create([
            'name' => 'Gucci Marmont Mini Bag',
            'description' => 'Authentic Gucci Marmont Mini in Black. Includes dust bag and authenticity card.',
            'price' => 12990000,
            'stock' => 1,
            'category_id' => $luxuryCategory->id,
            'user_id' => $luxuryBoutique->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567899/products/uju95meitr4klbby9oyg.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:18:20'
        ]);

        Product::create([
            'name' => 'Chanel Classic Flap Bag',
            'description' => 'Authentic Chanel Classic Flap in Black. Includes authenticity card and box.',
            'price' => 89900000,
            'stock' => 1,
            'category_id' => $luxuryCategory->id,
            'user_id' => $luxuryBoutique->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748572032/products/gdfafnh1tfh6lk9xbhnu.webp',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 19:27:14'
        ]);

        Product::create([
            'name' => 'Hermes Birkin 30',
            'description' => 'Authentic Hermes Birkin 30 in Togo leather. Includes dust bag and receipt.',
            'price' => 199900000,
            'stock' => 1,
            'category_id' => $luxuryCategory->id,
            'user_id' => $luxuryBoutique->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748572090/products/rd10nrmqv1zfq7mzsuuw.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 19:28:10'
        ]);

        Product::create([
            'name' => 'Prada Re-Edition 2005',
            'description' => 'Authentic Prada Re-Edition 2005 in Black. Includes dust bag and authenticity card.',
            'price' => 8990000,
            'stock' => 1,
            'category_id' => $luxuryCategory->id,
            'user_id' => $luxuryBoutique->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568072/products/eo7r5l8purunvur9ji6p.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:21:13'
        ]);

        // Health & Beauty Products
        Product::create([
            'name' => 'SK-II Facial Treatment Essence',
            'description' => 'Original SK-II Facial Treatment Essence 230ml. Unopened, sealed.',
            'price' => 1899000,
            'stock' => 1,
            'category_id' => $healthBeautyCategory->id,
            'user_id' => $beautyStore->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568105/products/vdakzgkougdehlt6hl97.jpg',
            'condition' => 'new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:21:46'
        ]);

        Product::create([
            'name' => 'Estee Lauder Advanced Night Repair',
            'description' => 'Estee Lauder ANR Serum 50ml. 80% remaining, purchased 2 months ago.',
            'price' => 1299000,
            'stock' => 1,
            'category_id' => $healthBeautyCategory->id,
            'user_id' => $beautyStore->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568135/products/sll75fu1amasiqqo3pa8.jpg',
            'condition' => 'good',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:22:16'
        ]);

        Product::create([
            'name' => 'La Mer Moisturizing Cream',
            'description' => 'La Mer Moisturizing Cream 60ml. Unopened, sealed.',
            'price' => 4999000,
            'stock' => 1,
            'category_id' => $healthBeautyCategory->id,
            'user_id' => $beautyStore->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568168/products/rrv84y1xkemykhvsqipd.jpg',
            'condition' => 'new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:22:48'
        ]);

        Product::create([
            'name' => 'Chanel Chance Eau Tendre',
            'description' => 'Chanel Chance Eau Tendre EDP 100ml. 90% remaining.',
            'price' => 1999000,
            'stock' => 1,
            'category_id' => $healthBeautyCategory->id,
            'user_id' => $beautyStore->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568192/products/xmfleyozpo33ee5ch4mc.jpg',
            'condition' => 'good',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:23:13'
        ]);

        Product::create([
            'name' => 'Dior Forever Foundation',
            'description' => 'Dior Forever Foundation in 2N. Used once, like new condition.',
            'price' => 899000,
            'stock' => 1,
            'category_id' => $healthBeautyCategory->id,
            'user_id' => $beautyStore->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568214/products/lkc1imtt0zh4yusucdaw.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:23:35'
        ]);

        // Babies & Kids Products
        Product::create([
            'name' => 'H&M Kids Winter Jacket',
            'description' => 'Warm winter jacket for kids age 4-5 years. Lightly used, excellent condition.',
            'price' => 149000,
            'stock' => 1,
            'category_id' => $babiesKidsCategory->id,
            'user_id' => $kidsFashion->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748567790/products/vmgfl2tfrchdd7rpulc3.jpg',
            'condition' => 'good',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:16:31'
        ]);

        Product::create([
            'name' => 'Gap Kids Denim Overalls',
            'description' => 'Cute denim overalls for kids age 3-4 years. Like new condition.',
            'price' => 199000,
            'stock' => 1,
            'category_id' => $babiesKidsCategory->id,
            'user_id' => $kidsFashion->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568248/products/kzlfha8pypywvhnvxqcs.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:24:09'
        ]);

        Product::create([
            'name' => 'Nike Kids Air Force 1',
            'description' => 'Nike Kids Air Force 1 in white. Size EU 30, new with box.',
            'price' => 799000,
            'stock' => 1,
            'category_id' => $babiesKidsCategory->id,
            'user_id' => $kidsFashion->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568279/products/l17d8vaur83cuqaptgnn.jpg',
            'condition' => 'new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:24:40'
        ]);

        Product::create([
            'name' => 'Zara Kids Summer Dress',
            'description' => 'Floral summer dress for girls age 5-6 years. New with tags.',
            'price' => 249000,
            'stock' => 1,
            'category_id' => $babiesKidsCategory->id,
            'user_id' => $kidsFashion->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568308/products/aip4vrxydttopanttpeh.jpg',
            'condition' => 'new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:25:09'
        ]);

        Product::create([
            'name' => 'Uniqlo Kids Pajama Set',
            'description' => 'Cotton pajama set for kids age 4-5 years. Good condition.',
            'price' => 129000,
            'stock' => 1,
            'category_id' => $babiesKidsCategory->id,
            'user_id' => $kidsFashion->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568339/products/cu4zxhhut6umfj1dovgr.jpg',
            'condition' => 'good',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:25:40'
        ]);

        // Electronics Products
        Product::create([
            'name' => 'Apple AirPods Pro 2',
            'description' => 'Apple AirPods Pro 2nd Generation. Includes charging case and all accessories.',
            'price' => 2499000,
            'stock' => 1,
            'category_id' => $electronicsCategory->id,
            'user_id' => $luxuryBoutique->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568366/products/hai2ipdthohvhfyy2o7j.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:26:07'
        ]);

        Product::create([
            'name' => 'Samsung Galaxy Watch 5',
            'description' => 'Samsung Galaxy Watch 5 40mm. Includes original box and charger.',
            'price' => 2999000,
            'stock' => 1,
            'category_id' => $electronicsCategory->id,
            'user_id' => $luxuryBoutique->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568405/products/mpcn7ac6yvpn7owtietd.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:26:46'
        ]);

        Product::create([
            'name' => 'iPad Pro 11" 2022',
            'description' => 'iPad Pro 11" 2022 128GB WiFi. Includes original box and accessories.',
            'price' => 9999000,
            'stock' => 1,
            'category_id' => $electronicsCategory->id,
            'user_id' => $luxuryBoutique->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568430/products/nppk89aggqc53go7ubpl.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:27:10'
        ]);

        Product::create([
            'name' => 'Sony WH-1000XM4',
            'description' => 'Sony WH-1000XM4 Wireless Headphones. Includes carrying case and cables.',
            'price' => 3499000,
            'stock' => 1,
            'category_id' => $electronicsCategory->id,
            'user_id' => $luxuryBoutique->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568454/products/mvckg4jmvsqiavdxl8fe.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:27:35'
        ]);

        Product::create([
            'name' => 'DJI Mini 3 Pro',
            'description' => 'DJI Mini 3 Pro Drone. Includes controller, batteries, and carrying case.',
            'price' => 8999000,
            'stock' => 1,
            'category_id' => $electronicsCategory->id,
            'user_id' => $luxuryBoutique->id,
            'image' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748568483/products/tlwbrjrt1ubcaphk8pso.jpg',
            'condition' => 'like_new',
            'status' => 'active',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 18:28:04'
        ]);
    }
} 