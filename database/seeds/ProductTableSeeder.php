<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ImagesProduct;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
            array('product' => 'Be Full Stack Developer - Laravel','price' => '350000.00','stock' => '100','description' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('product' => 'Be Full Stack Developer - Vue','price' => '350000.00','stock' => '120','description' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('product' => 'Tutorial Java Android - Pemula','price' => '118000.00','stock' => '150','description' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('product' => 'Tutorial Java Android - Menengah','price' => '118000.00','stock' => '130','description' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('product' => 'Tutorial Singkat Jago CI','price' => '98000.00','stock' => '90','description' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('product' => 'Menjadi Android Developer Expert','price' => '2200000.00','stock' => '70','description' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('product' => 'Kotlin Android Developer Expert','price' => '1100000.00','stock' => '95','description' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('product' => 'Tutorial Kotlin Android - Pemula','price' => '128000.00','stock' => '110','description' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('product' => 'Tutorial Membuat Cek Ongkir','price' => '118000.00','stock' => '125','description' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('product' => 'Menjadi Game Developer Expert','price' => '2200000.00','stock' => '65','description' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('product' => 'Tutorial Membuat Aplikasi Video Streaming','price' => '148000.00','stock' => '105','description' => NULL,'created_at' => \Carbon\Carbon::now()),
            array('product' => 'Tutorial Membuat Aplikasi Pemutar Video Youtube','price' => '108000.00','stock' => '105','description' => NULL,'created_at' => \Carbon\Carbon::now()),
        );

        Product::insert($products);

        $images_product = array(
            array('product_id' => '1','image' => 'products/1ldLllCe07BQaje8mdITDyJvdNOR39WWvOyF8OYR.jpeg','created_at' => \Carbon\Carbon::now()),
            array('product_id' => '2','image' => 'products/2ud1EZT5kI0jlEfos8GP7kXjDlqb1aGNtq3LRM94.jpeg','created_at' => \Carbon\Carbon::now()),
            array('product_id' => '3','image' => 'products/bJj8pRmts8O4OHkXUvH0d8U6IK3uLgvUwAUc0B0w.jpeg','created_at' => \Carbon\Carbon::now()),
            array('product_id' => '4','image' => 'products/BiSOmkNbYMGsUncpkF9FhyJjM9yrvzy4dlurdWRr.jpeg','created_at' => \Carbon\Carbon::now()),
            array('product_id' => '5','image' => 'products/DcCDT6FuquF0J3HnWxjcCxDV5CAduGNqfXimyELU.jpeg','created_at' => \Carbon\Carbon::now()),
            array('product_id' => '6','image' => 'products/3vKUjYg0ZIkTjlNmJvSvfZzy5EdFYcppmgrHE4gr.jpeg','created_at' => \Carbon\Carbon::now()),
            array('product_id' => '7','image' => 'products/6GigSOsX2FHqP36EvrCZigU5GkLbpMAiWiUiRwgr.jpeg','created_at' => \Carbon\Carbon::now()),
            array('product_id' => '8','image' => 'products/BMnxJUQjNN5FkbPZtVA6zYsr9wipnODRCbSGPeBm.jpeg','created_at' => \Carbon\Carbon::now()),
            array('product_id' => '9','image' => 'products/2UeCIQMQSEL3CduAX4S2qJccUpocoIwr36b2NxQ1.jpeg','created_at' => \Carbon\Carbon::now()),
            array('product_id' => '10','image' => 'products/6GigSOsX2FHqP36EvrCZigU5GkLbpMAiWiUiRwgr.jpeg','created_at' => \Carbon\Carbon::now()),
            array('product_id' => '11','image' => 'products/3geeJdlbZP3zMlEH2SNrdUkIZctjJDnBaoANn1SQ.jpeg','created_at' => \Carbon\Carbon::now()),
            array('product_id' => '12','image' => 'products/M2DR4K6wRgohHucUNusc35nJtzIgKWpMa5T5Im9D.jpeg','created_at' => \Carbon\Carbon::now()),
        );

        ImagesProduct::insert($images_product);
    }
}
