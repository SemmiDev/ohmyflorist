<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {

        $images = [
            'https://cdn.shopify.com/s/files/1/1789/5809/products/0620-PinkBlush-Thumbnail-01_2000x.jpg?v=1594200523',
            'https://cdn.shopify.com/s/files/1/1789/5809/products/0820-JustForYou-Thumbnail-01_600x.jpg?v=1598248788',
            'https://cdn.shopify.com/s/files/1/1789/5809/products/0620-BloomyDays-Thumbnail-01_600x.jpg?v=1592275040',
            'https://cdn.shopify.com/s/files/1/1789/5809/products/Sweetheart_001_600x.jpg?v=1614845162',
            'https://cdn.shopify.com/s/files/1/1789/5809/products/Darling_Devotion_1_600x.jpg?v=1574913288',
            'https://cdn.shopify.com/s/files/1/1789/5809/products/PurplePassion1_600x.jpg?v=1647315163',
            'https://cdn.shopify.com/s/files/1/1789/5809/products/Precious_Purple_600x.jpg?v=1574922828',
            'https://cdn.shopify.com/s/files/1/1789/5809/products/99RedRosesMidnightEdition_001_1_600x.jpg?v=1611721851',
            'https://cdn.shopify.com/s/files/1/1789/5809/products/mom-is-always-right-14548245577841_600x.jpg?v=1618971306',
            'https://cdn.shopify.com/s/files/1/1789/5809/products/blushing-ballad-15292697575537_600x.jpg?v=1618969997',
            'https://cdn.shopify.com/s/files/1/1789/5809/products/sweet-pea-15379552272497_600x.jpg?v=1618969761',
            'https://cdn.shopify.com/s/files/1/1789/5809/products/0620-CloudsOfAffection-Thumbnail-01_600x.jpg?v=1594198720'];

        return [
            'name' => fake()->name(),
            'image_url' => fake()->randomElement($images),
            'price' => 250000,
            'discount' => fake()->randomFloat(2, 0, 0.5)
        ];
    }
}