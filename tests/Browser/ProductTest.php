<?php

namespace Tests\Browser;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProductTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testUserCanViewProducts()
    {
        $products = Product::factory()->count(3)->create();

        $this->browse(function (Browser $browser) use ($products) {
            $browser->visit('/products')
                   ->assertSee($products[0]->name)
                   ->assertSee($products[1]->name)
                   ->assertSee($products[2]->name);
        });
    }

    public function testUserCanViewProductDetails()
    {
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 99.99
        ]);

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit('/products')
                   ->clickLink($product->name)
                   ->assertPathIs('/products/' . $product->id)
                   ->assertSee($product->name)
                   ->assertSee($product->description)
                   ->assertSee('$99.99');
        });
    }

    public function testUserCanAddProductToCart()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $product) {
            $browser->loginAs($user)
                   ->visit('/products/' . $product->id)
                   ->press('Add to Cart')
                   ->assertSee('Product added to cart')
                   ->visit('/cart')
                   ->assertSee($product->name);
        });
    }

    public function testUserCanSearchProducts()
    {
        $product1 = Product::factory()->create(['name' => 'Blue T-Shirt']);
        $product2 = Product::factory()->create(['name' => 'Red Jeans']);

        $this->browse(function (Browser $browser) use ($product1, $product2) {
            $browser->visit('/products')
                   ->type('search', 'T-Shirt')
                   ->press('Search')
                   ->assertSee($product1->name)
                   ->assertDontSee($product2->name);
        });
    }
} 