<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Create categories
        $categories = [
            [
                'name' => 'Women\'s',
                'description' => null,
                'image_url' => 'storage/categories/1747472974_pexels-castorlystock-3682293.jpg'
            ],
            [
                'name' => 'Men\'s',
                'description' => null,
                'image_url' => 'storage/categories/1747472906_pexels-solliefoto-298863.jpg'
            ],
            [
                'name' => 'Health & Beauty',
                'description' => 'Health & Beauty collection',
                'image_url' => 'storage/categories/1747472831_pexels-n-voitkevich-8468019.jpg'
            ],
            [
                'name' => 'Babies & Kids',
                'description' => null,
                'image_url' => 'storage/categories/1747472620_asmund-gimre-NrJA1TPi0P8-unsplash.jpg'
            ],
            [
                'name' => 'Luxury',
                'description' => null,
                'image_url' => 'storage/categories/1747472874_pexels-nappy-1058959.jpg'
            ],
            [
                'name' => 'Electronics',
                'description' => null,
                'image_url' => 'storage/categories/1747472684_pexels-pixabay-356056.jpg'
            ]
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }

        // Create products
        $products = [
            [
                'category_id' => 1,
                'name' => 'Stripe Knit Shirt',
                'description' => "All size\r\nNo minus \r\nLike new",
                'price' => 90000.00,
                'stock' => 2,
                'image_url' => 'products/a2CHCCFdCqC5mPQR3LCaReVq2EQcdXmlpSgN9GE3.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'ATMOSPHERE - Crop Top Tosca',
                'description' => null,
                'price' => 50000.00,
                'stock' => 1,
                'image_url' => 'products/xOewLjjf9sUieXzKs4Un1LeVSDCkatJ02TVM3Y0f.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Cardigan PLAY Abu',
                'description' => 'Minus tag bawah cutting',
                'price' => 150000.00,
                'stock' => 1,
                'image_url' => 'products/AGyEmi3I756GAwB32CAusxdrdIKXRV2qvD6EwUIX.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'UNIQLO Cardigan Shoffle Pink',
                'description' => "Uniqlo Cardigan Shoffle Pink\r\nTag tagan masih amann \r\nSize L kecil (kids section)\r\nM fit to L \r\nNego Tipis",
                'price' => 200000.00,
                'stock' => 1,
                'image_url' => 'products/rTLqbxdIP7F3f72BXJQPYRiEUHTfb58WM3Iy3Y22.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Cardigan Uniqlo Hitam Kerah O',
                'description' => "ld 110\r\np 60\r\nMINUS NODA SAMAR DIBAGIAN BELAKANG",
                'price' => 88000.00,
                'stock' => 1,
                'image_url' => 'products/jJcYl5U0mQWNNByMWpJDP1OUvgqSkLp9B4bkZaif.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'Jaket NIKE Running',
                'description' => "Jacket Nike Running \r\n#ready aggsstuff\r\nSize on Taq : L \r\nP x L    : 68 X L 58 \r\nMinus  : Tidak ada",
                'price' => 99000.00,
                'stock' => 1,
                'image_url' => 'products/l7wJuAFDsB2KU9BiuG7gHiJWm88wy7gxjIbcGX2M.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'Preloved Kaos UNIQLO',
                'description' => "Ukuran S, tapi cenderung besar\r\nBaik dan tebal",
                'price' => 30000.00,
                'stock' => 1,
                'image_url' => 'products/GtWiohzAcmTblVaRLIVMhtxPNERAlk32BvpibA7i.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'Jaket Gym Master Reversible',
                'description' => "size L\r\nPanjang 68cm\r\nLebar 118cm\r\nNominus\r\nGoodcondition",
                'price' => 130000.00,
                'stock' => 1,
                'image_url' => 'products/ODnwWsWPU5EVb2e7oStjYD0gUlOsvmXctuUp0j6x.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'T-Shirt Swellow Kaos',
                'description' => 'ukuran m (sekali pakai)',
                'price' => 250000.00,
                'stock' => 1,
                'image_url' => 'products/eYLMdmyj4zO17WjYDAr01J02CAznhoULWBLeIOye.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'Vintage Golden Bear Navy Harrington Work Jacket',
                'description' => "•Size M fit L (P63xL58) Ld116 Boxy\r\n\r\nGeser foto untuk detail ——>\r\n\r\nitem deskripsi : 𝗪𝗮𝗿𝗻𝗮 𝗯𝗶𝘀𝗮 𝘀𝗮𝗷𝗮 𝘀𝗲𝗱𝗶𝗸𝗶𝘁 𝗯𝗲𝗿𝗯𝗲𝗱𝗮 𝗸𝗮𝗿𝗲𝗻𝗮 𝗲𝗳𝗲𝗸 𝗰𝗮𝗵𝗮𝘆𝗮 ! ,sudah di loundry ,warna navy pekat ,bahan canvas ,very goodcondition.\r\n\r\n📩 For order / lebih detail Chat or WA \r\nWa : 0882001848112\r\nIg : hakki.thrifttops & hakkistuff.id\r\nRekber +13% Admin\r\nLok : Bandung ,Jawa Barat",
                'price' => 199000.00,
                'stock' => 1,
                'image_url' => 'products/OF1bgkHTCEOFpqFUIuqOO42MqlzEkHs9jB5m1CNh.jpg'
            ],
            [
                'category_id' => 3,
                'name' => 'Lip Cream Velvet BRASOV',
                'description' => "dijual soalnya salah shade\r\nwarna nya thai tea cakep gt \r\nbisa oyenn 🧡",
                'price' => 20000.00,
                'stock' => 1,
                'image_url' => 'products/X8oUb52RsQ2krcGjBT0YwDJzSUBBgJvcz1MnNA7w.jpg'
            ],
            [
                'category_id' => 3,
                'name' => 'OMG Face Wash',
                'description' => 'Masih segel yaa',
                'price' => 12000.00,
                'stock' => 1,
                'image_url' => 'products/vW4OkEnGAup0eGRWTu8I1YiswlHcunMbtoPFZXcz.jpg'
            ],
            [
                'category_id' => 3,
                'name' => 'Amos Professional Unix Hair Dryer',
                'description' => "Authentic 💯\r\nbeli di official store\r\nPemakaian Pribadi \r\n 🚩Malang",
                'price' => 100000.00,
                'stock' => 1,
                'image_url' => 'products/9fqHH6WKiqfVvIHPfLVCphkJXBKLW4LGJFTZAdrI.jpg'
            ],
            [
                'category_id' => 3,
                'name' => 'Supremacy In Oud Adnan EDP',
                'description' => "Bought for 620.000\r\nSisa juice 60%\r\nFullset with box\r\nNego santai",
                'price' => 380000.00,
                'stock' => 1,
                'image_url' => 'products/cfJ1GU20Qsf4d3N8N8NUKz0VtPLR8XMbq4NBTBjB.jpg'
            ],
            [
                'category_id' => 3,
                'name' => 'Lavojoy - Hold Me Tight Pro Shampoo',
                'description' => "Brand new masih segel\r\nDijual karena udah ada sampo lain\r\n\r\n📦 Pengiriman:\r\n• Kirim manual dari Benhil, Jakarta aja ya\r\n• Nggak bisa lewat e-commerce\r\n• Pengiriman hanya tiap weekend (Sabtu/Minggu)\r\nMakasih udah ngerti yaa! 😊",
                'price' => 75000.00,
                'stock' => 1,
                'image_url' => 'products/IbSkdcJYWA3BGAYGgDE0hE8GDbnKADHEaBEqZDdB.jpg'
            ],
            [
                'category_id' => 6,
                'name' => 'Digicam Sony DSC S930',
                'description' => "kondisi fisik masih lumayan\r\nminus Kuningan batre udh karat mungkin perlu di Servis",
                'price' => 500000.00,
                'stock' => 1,
                'image_url' => 'products/0MSx87hODTm7hTIrjqoo7m3JIvbhInD1bfb0deZX.jpg'
            ],
            [
                'category_id' => 6,
                'name' => 'JBL GO 2 Black Blueetooth Speaker Authentic',
                'description' => "Authentic 💯\r\nbeli di official store\r\nPemakaian Pribadi \r\n 🚩Malang",
                'price' => 100000.00,
                'stock' => 1,
                'image_url' => 'products/mgKk3iOlNRrJtMGpOGFlPRdI97ZIrS0Bl2IVKFYP.jpg'
            ],
            [
                'category_id' => 6,
                'name' => 'Kamera Canon Eos M10 with Box',
                'description' => "Kamera Canon EOS M10 Fullset KIT\r\nLCD vignet tidak ngaruh hasil\r\nkondisi :\r\naf mf normal\r\naudio video normal\r\nTouchscreen normal\r\nFlash Nyala\r\nHasil Jepretan tajam\r\nKelengkapan :\r\n- Kamera\r\n- Baterai\r\n- Charger\r\n- Box\r\n\r\nlok : Jogja",
                'price' => 3650000.00,
                'stock' => 1,
                'image_url' => 'products/9L2nS3AyYPjjMysY2fj11Mai1X3KEi4UEnO3GGVb.jpg'
            ],
            [
                'category_id' => 6,
                'name' => 'Macbook Pro 2017',
                'description' => "Good Condition!!\r\nMac OS terbaru, Storage 8/250, CC rendah, Pemakaian 4/5 Jam Nugas / Games / Netflix Lancar",
                'price' => 2000000.00,
                'stock' => 1,
                'image_url' => 'products/P5HHfKNxTN2lgsLm6gbzJlzO2I5tzxq3cZeJhlNI.jpg'
            ],
            [
                'category_id' => 6,
                'name' => 'PC gaming intel core i5 9400f GTX 1060 512GB',
                'description' => "Dijual PC, Spec:\r\n- Intel Core i5 9400f\r\n- Mobo Asrock H310\r\n- VGA GTX 1060 3GB\r\n- RAM 16GB (2x8GB) \r\n- SSD 2x240GB\r\n- PSU Corsair VX 550W\r\n\r\nGak nego dapet bonus",
                'price' => 4200000.00,
                'stock' => 1,
                'image_url' => 'products/IRtPGsQ7gpMLZSyUqYDJOCbOxfjnSSVTChbqeLcC.jpg'
            ],
            [
                'category_id' => 5,
                'name' => 'Sleepsuit Adem',
                'description' => "HARGA NETT, NO NEGO ❗❗❗\r\nCek Ongkir di Tokren \"Zydbabykids\"\r\n\r\n✔️ Keterangan ada di gambar, kalau ada berbulu, noda, minusnya sudah dijelaskan ya. harap baca dg teliti. Barang mantan ya mom, jangan berekspektasi tinggi. \r\n✔️ Transaksi di Tokren +12% admin oren. \r\n✔️ Pembayaran split (apabila terjadi kehilangan barang dlm perjalanan akan diganti sesuai co) kecuali barang kembali ke seller, silahkan chat terlebih dahulu. WAJIB VIDEO UNBOXING\r\n✔️ Warna di foto bisa real bisa beda tergantung pencahayaan di kamera hp\r\n✔️ Membeli = Setuju, No Complain. \r\n✔️ Harap memberikan review yg bijak di kolom komentar \r\n\r\nHappy Shopping mom\r\n\r\n#prelovedbanjarmasin #babystuff #garagesale #prelovedjaket #thriftimport #thrift #prelovedbranded #bajubayi #prelovedbayi #prelovedbajuanak #prelovedsleepsuit #jaketwinteranak #jaketbulanganak #kemejaanak",
                'price' => 25000.00,
                'stock' => 1,
                'image_url' => 'products/A3BoZ7ZnDaocx38zD8JfwdQqFVT5FoRhRszw9k71.jpg'
            ],
            [
                'category_id' => 5,
                'name' => 'ERGOBABY OMNI 360 AIRMESH CHAMBRAY ORIGINAL',
                'description' => null,
                'price' => 1550000.00,
                'stock' => 1,
                'image_url' => 'products/EZkQDRjJPNM5rNEIXVw40Fx3SgdXW6TmFoSttBCC.jpg'
            ],
            [
                'category_id' => 5,
                'name' => 'Rok petticoat anak rok pengembang dress anak',
                'description' => "Rok petticoat anak, bahan organza, berfuring, pinggang karet\r\nSize 120 - 130 ( untuk usia 4 - 6 tahun) \r\n\r\nBrand -\r\nLP 46 - 70\r\nP 29",
                'price' => 35000.00,
                'stock' => 1,
                'image_url' => 'products/1aoif8f8rp8wlcx1oqYU6PJHwwTBXosOIZQ6aqUs.jpg'
            ],
            [
                'category_id' => 5,
                'name' => '110 Dress H&M Linen Biru Denim Anak Perempuan 3-4 Tahun',
                'description' => "• Pada foto pertama, warna diusahakan akan diedit semirip mungkin dengan aslinya.\r\n• Kadang ada barang yang sudah nett karena sudah termasuk freeong/admin marketplace yang sudah disubsidi (tergantung barangnya)\r\n• Kalau nego sadis otomatis di blok ya 🙏🏻\r\n\r\nPengiriman bisa melalui:\r\n✅ wahana (ongkir 5-15rb, rata2 7rb)\r\n✅ marketplace +admin (oren, ijo) bisa co link kecil sisanya transfer",
                'price' => 25000.00,
                'stock' => 1,
                'image_url' => 'products/PDZ1XLubpq7qYQq7S7BMCDZAU4OgN9IgMMs5TDah.jpg'
            ],
            [
                'category_id' => 5,
                'name' => 'Stroller pockit',
                'description' => 'stroller pockit gen 2s\r\nlike new',
                'price' => 700000.00,
                'stock' => 1,
                'image_url' => 'products/03YJ9hIDuqyZTFRPW6nKQDHHSdPleS5fsEUNNc5G.jpg'
            ],
            [
                'category_id' => 6,
                'name' => 'KATE SPADE KNOTT MINI SATCHEL',
                'description' => "KATE SPADE KNOTT MINI SATCHEL\r\n\r\nKondisi: almost VVGC (hanya ada noda secuil di bagian salam, selebihnya VVGC)\r\nKelengkapan: Price Tag, Long Strap, DB Pengganti\r\n\r\n\r\n#katespade #katespadebags #katespadeauthentic #katespadeknott #barangauthentic #barangbranded #prelovedauthentic #prelovedmurah #prelovedjkt",
                'price' => 1500000.00,
                'stock' => 1,
                'image_url' => 'products/bmIwTqQEKVRj7h1KVTau2fgp0HL9xKS8JYeFjwC3.jpg'
            ],
            [
                'category_id' => 6,
                'name' => 'Coach Nolita',
                'description' => "Coach nolita🖤\r\nAuthentic💯\r\nMuluss pamakaian wajar😍",
                'price' => 800000.00,
                'stock' => 1,
                'image_url' => 'products/9HXzljYx5GCkM1gGWLHMlNvLrX9YiL4vNZJstwU4.jpg'
            ],
            [
                'category_id' => 6,
                'name' => 'Tas Charles & Keith Alcott Scraft',
                'description' => "Tas Charles & Keith Alcott Scraft\r\nLike new\r\nPemakaian 2x\r\nMasih mulus semua no deffect\r\nBisa toko oren ada biaya admin 10%",
                'price' => 850000.00,
                'stock' => 1,
                'image_url' => 'products/BRk6dWTSn29o0nzsxe3nuNXdtSlmt1gQmASYxU24.jpg'
            ],
            [
                'category_id' => 6,
                'name' => 'LV Speedy 30 Monogram 2005',
                'description' => "bag db pengganti padlock (nempel)\r\nkondisi apa ada nya \r\nnett no nego",
                'price' => 2750000.00,
                'stock' => 1,
                'image_url' => 'products/iBwPNS1z9I4YsFNj1c2vaAoHy4Je3AOhWIPHEz4o.jpg'
            ],
            [
                'category_id' => 6,
                'name' => 'Coach Bag Reversible New',
                'description' => "Original Coach Bag\r\nNever been used\r\nTipe reversible, 1 tas bisa dipakai 2 mode sehingga seperti punya 2 tas\r\nPanjang 32cm, Tinggi 26cm\r\nDust bag dan paper bag lengkap\r\nNego tipis\r\n\r\nMinat DM",
                'price' => 1799000.00,
                'stock' => 1,
                'image_url' => 'products/SvshcDypurJ6ciReNftp0SqJCCpVfMF6NPP6NXud.jpg'
            ]
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(['name' => $product['name']], $product);
        }

        // Create transactions and transaction items
        $transactions = [
            [
                'user_id' => 1,
                'total_price' => 300.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-04 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 105.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-11 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 89.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-14 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 300.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-04-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 314.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-12 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 135.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-04-27 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 400.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-16 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 230.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-13 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 55.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-12 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 130.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-04-23 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 315.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-15 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 255.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-04 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 110.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-09 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 75.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-07 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 45.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-11 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 330.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-14 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 224.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-13 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 268.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-04-19 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 315.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-05-16 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'user_id' => 1,
                'total_price' => 225.00,
                'status' => 'paid',
                'payment_method' => 'midtrans',
                'midtrans_order_id' => null,
                'created_at' => '2025-04-21 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ]
        ];

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }

        // Create transaction items
        $transactionItems = [
            [
                'transaction_id' => 1,
                'product_id' => 1,
                'quantity' => 3,
                'price' => 45.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 1,
                'product_id' => 5,
                'quantity' => 3,
                'price' => 55.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 2,
                'product_id' => 2,
                'quantity' => 3,
                'price' => 35.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 3,
                'product_id' => 3,
                'quantity' => 1,
                'price' => 89.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 4,
                'product_id' => 5,
                'quantity' => 3,
                'price' => 55.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 4,
                'product_id' => 1,
                'quantity' => 3,
                'price' => 45.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 5,
                'product_id' => 3,
                'quantity' => 1,
                'price' => 89.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 5,
                'product_id' => 6,
                'quantity' => 3,
                'price' => 75.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 6,
                'product_id' => 1,
                'quantity' => 3,
                'price' => 45.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 7,
                'product_id' => 1,
                'quantity' => 3,
                'price' => 45.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 7,
                'product_id' => 4,
                'quantity' => 3,
                'price' => 65.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 7,
                'product_id' => 2,
                'quantity' => 2,
                'price' => 35.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 8,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 35.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 8,
                'product_id' => 1,
                'quantity' => 1,
                'price' => 45.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 8,
                'product_id' => 6,
                'quantity' => 2,
                'price' => 75.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 9,
                'product_id' => 5,
                'quantity' => 1,
                'price' => 55.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 10,
                'product_id' => 4,
                'quantity' => 2,
                'price' => 65.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 11,
                'product_id' => 6,
                'quantity' => 3,
                'price' => 75.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 11,
                'product_id' => 5,
                'quantity' => 1,
                'price' => 55.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 11,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 35.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 12,
                'product_id' => 4,
                'quantity' => 2,
                'price' => 65.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 12,
                'product_id' => 5,
                'quantity' => 1,
                'price' => 55.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 12,
                'product_id' => 2,
                'quantity' => 2,
                'price' => 35.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 13,
                'product_id' => 5,
                'quantity' => 2,
                'price' => 55.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 14,
                'product_id' => 6,
                'quantity' => 1,
                'price' => 75.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 15,
                'product_id' => 1,
                'quantity' => 1,
                'price' => 45.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 16,
                'product_id' => 6,
                'quantity' => 3,
                'price' => 75.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 16,
                'product_id' => 2,
                'quantity' => 3,
                'price' => 35.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 17,
                'product_id' => 3,
                'quantity' => 1,
                'price' => 89.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 17,
                'product_id' => 1,
                'quantity' => 3,
                'price' => 45.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 18,
                'product_id' => 1,
                'quantity' => 2,
                'price' => 45.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 18,
                'product_id' => 3,
                'quantity' => 2,
                'price' => 89.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 19,
                'product_id' => 5,
                'quantity' => 3,
                'price' => 55.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 19,
                'product_id' => 6,
                'quantity' => 2,
                'price' => 75.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ],
            [
                'transaction_id' => 20,
                'product_id' => 6,
                'quantity' => 3,
                'price' => 75.00,
                'created_at' => '2025-05-17 00:02:06',
                'updated_at' => '2025-05-17 00:02:06'
            ]
        ];

        foreach ($transactionItems as $item) {
            TransactionItem::create($item);
        }
    }
} 