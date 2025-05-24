<?php

namespace Tests\Browser;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CartTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testUserCanAddAndRemoveItemsFromCart()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $product) {
            $browser->loginAs($user)
                   ->visit('/products/' . $product->id)
                   ->press('Add to Cart')
                   ->assertSee('Product added to cart')
                   ->visit('/cart')
                   ->assertSee($product->name)
                   ->press('Remove')
                   ->assertDontSee($product->name);
        });
    }

    public function testUserCanUpdateCartQuantity()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $product) {
            $browser->loginAs($user)
                   ->visit('/products/' . $product->id)
                   ->press('Add to Cart')
                   ->visit('/cart')
                   ->type('quantity', '2')
                   ->press('Update')
                   ->assertSee('Cart updated')
                   ->assertSee('$' . ($product->price * 2));
        });
    }

    public function testCartPersistsAfterLogout()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $product) {
            $browser->loginAs($user)
                   ->visit('/products/' . $product->id)
                   ->press('Add to Cart')
                   ->assertSee('Product added to cart')
                   ->visit('/logout')
                   ->visit('/login')
                   ->type('email', $user->email)
                   ->type('password', 'password')
                   ->press('Login')
                   ->visit('/cart')
                   ->assertSee($product->name);
        });
    }

    public function testCartShowsCorrectTotal()
    {
        $user = User::factory()->create();
        $product1 = Product::factory()->create(['price' => 50.00]);
        $product2 = Product::factory()->create(['price' => 75.00]);

        $this->browse(function (Browser $browser) use ($user, $product1, $product2) {
            $browser->loginAs($user)
                   ->visit('/products/' . $product1->id)
                   ->press('Add to Cart')
                   ->visit('/products/' . $product2->id)
                   ->press('Add to Cart')
                   ->visit('/cart')
                   ->assertSee('$125.00');
        });
    }
} 