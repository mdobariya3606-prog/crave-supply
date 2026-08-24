<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'role' => 'admin',
                'password' => 'password',
            ],
        );

        $categories = collect([
            ['name' => 'Gourmet Pantry', 'slug' => 'gourmet-pantry', 'description' => 'Premium staples and ingredients for considered kitchens.'],
            ['name' => 'Artisan Beverages', 'slug' => 'artisan-beverages', 'description' => 'Small-batch coffees, teas, and refreshments for every setting.'],
            ['name' => 'Signature Snacks', 'slug' => 'signature-snacks', 'description' => 'Elevated snacks for thoughtful breaks and shared spaces.'],
            ['name' => 'Office Essentials', 'slug' => 'office-essentials', 'description' => 'Dependable everyday supplies with a premium finish.'],
            ['name' => 'Wellness & Care', 'slug' => 'wellness-care', 'description' => 'Comfort-focused products for healthier workdays.'],
        ])->mapWithKeys(function (array $attributes) {
            $category = Category::updateOrCreate(
                ['slug' => $attributes['slug']],
                $attributes,
            );

            return [$attributes['slug'] => $category->id];
        });

        $products = [
            ['category' => 'gourmet-pantry', 'sku' => 'PAN-001', 'name' => 'Reserve Himalayan Sea Salt', 'slug' => 'reserve-himalayan-sea-salt', 'description' => 'Hand-finished mineral salt with a clean, delicate crunch.', 'price' => 499.00, 'stock' => 48],
            ['category' => 'gourmet-pantry', 'sku' => 'PAN-002', 'name' => 'Estate Extra Virgin Olive Oil', 'slug' => 'estate-extra-virgin-olive-oil', 'description' => 'Cold-pressed estate olive oil with bright, peppery notes.', 'price' => 1299.00, 'stock' => 32],
            ['category' => 'artisan-beverages', 'sku' => 'BEV-001', 'name' => 'Single-Origin Arabica Coffee', 'slug' => 'single-origin-arabica-coffee', 'description' => 'A smooth medium roast with notes of cacao and toasted almond.', 'price' => 899.00, 'stock' => 64],
            ['category' => 'artisan-beverages', 'sku' => 'BEV-002', 'name' => 'Jasmine Pearl Green Tea', 'slug' => 'jasmine-pearl-green-tea', 'description' => 'Hand-rolled tea pearls layered with fresh jasmine fragrance.', 'price' => 749.00, 'stock' => 41],
            ['category' => 'signature-snacks', 'sku' => 'SNK-001', 'name' => 'Dark Chocolate Almond Clusters', 'slug' => 'dark-chocolate-almond-clusters', 'description' => 'Roasted almonds covered in rich 72% dark chocolate.', 'price' => 599.00, 'stock' => 55],
            ['category' => 'signature-snacks', 'sku' => 'SNK-002', 'name' => 'Rosemary Truffle Cashews', 'slug' => 'rosemary-truffle-cashews', 'description' => 'Crisp roasted cashews finished with rosemary and truffle.', 'price' => 699.00, 'stock' => 36],
            ['category' => 'office-essentials', 'sku' => 'OFF-001', 'name' => 'Executive Desk Supply Set', 'slug' => 'executive-desk-supply-set', 'description' => 'A refined set of notebooks, pens, and desk essentials.', 'price' => 1599.00, 'stock' => 24],
            ['category' => 'office-essentials', 'sku' => 'OFF-002', 'name' => 'Recycled Kraft Presentation Box', 'slug' => 'recycled-kraft-presentation-box', 'description' => 'Sturdy, elegant packaging for client-ready presentations.', 'price' => 449.00, 'stock' => 72],
            ['category' => 'wellness-care', 'sku' => 'WEL-001', 'name' => 'Calm Botanical Hand Wash', 'slug' => 'calm-botanical-hand-wash', 'description' => 'A gentle botanical cleanser with a subtle cedar and citrus scent.', 'price' => 649.00, 'stock' => 44],
            ['category' => 'wellness-care', 'sku' => 'WEL-002', 'name' => 'Bamboo Comfort Tissues', 'slug' => 'bamboo-comfort-tissues', 'description' => 'Soft, responsibly sourced tissues for premium shared spaces.', 'price' => 399.00, 'stock' => 88],
            ['category' => 'gourmet-pantry', 'sku' => 'PAN-003', 'name' => 'Saffron Infused Honey', 'slug' => 'saffron-infused-honey', 'description' => 'Silken wildflower honey delicately infused with saffron.', 'price' => 1099.00, 'stock' => 28],
            ['category' => 'gourmet-pantry', 'sku' => 'PAN-004', 'name' => 'Smoked Peppercorn Reserve', 'slug' => 'smoked-peppercorn-reserve', 'description' => 'A fragrant pepper blend with a refined, wood-fired finish.', 'price' => 579.00, 'stock' => 46],
            ['category' => 'gourmet-pantry', 'sku' => 'PAN-005', 'name' => 'Tuscan Herb Blend', 'slug' => 'tuscan-herb-blend', 'description' => 'A balanced blend of garden herbs for elevated everyday cooking.', 'price' => 449.00, 'stock' => 61],
            ['category' => 'gourmet-pantry', 'sku' => 'PAN-006', 'name' => 'Belgian Cocoa Powder', 'slug' => 'belgian-cocoa-powder', 'description' => 'Deep, velvety cocoa powder for baking and rich beverages.', 'price' => 799.00, 'stock' => 39],
            ['category' => 'gourmet-pantry', 'sku' => 'PAN-007', 'name' => 'Wild Orchard Preserve', 'slug' => 'wild-orchard-preserve', 'description' => 'Small-batch fruit preserve made with orchard-picked produce.', 'price' => 649.00, 'stock' => 34],
            ['category' => 'gourmet-pantry', 'sku' => 'PAN-008', 'name' => 'Aged Balsamic Reduction', 'slug' => 'aged-balsamic-reduction', 'description' => 'A glossy, slow-aged reduction with a bright sweet-tart finish.', 'price' => 1199.00, 'stock' => 22],
            ['category' => 'gourmet-pantry', 'sku' => 'PAN-009', 'name' => 'Sicilian Citrus Marmalade', 'slug' => 'sicilian-citrus-marmalade', 'description' => 'Bright citrus marmalade with a delicate, bittersweet edge.', 'price' => 699.00, 'stock' => 37],
            ['category' => 'gourmet-pantry', 'sku' => 'PAN-010', 'name' => 'Pistachio Cream Spread', 'slug' => 'pistachio-cream-spread', 'description' => 'Luxuriously smooth pistachio spread with a roasted finish.', 'price' => 999.00, 'stock' => 26],
            ['category' => 'artisan-beverages', 'sku' => 'BEV-003', 'name' => 'Earl Grey Reserve', 'slug' => 'earl-grey-reserve', 'description' => 'A fragrant black tea layered with bergamot and soft florals.', 'price' => 699.00, 'stock' => 48],
            ['category' => 'artisan-beverages', 'sku' => 'BEV-004', 'name' => 'Cold Brew Concentrate', 'slug' => 'cold-brew-concentrate', 'description' => 'Silky, low-acidity coffee concentrate for effortless serving.', 'price' => 949.00, 'stock' => 35],
            ['category' => 'artisan-beverages', 'sku' => 'BEV-005', 'name' => 'Hibiscus Citrus Cooler', 'slug' => 'hibiscus-citrus-cooler', 'description' => 'A vibrant botanical infusion with a refreshing citrus finish.', 'price' => 599.00, 'stock' => 52],
            ['category' => 'artisan-beverages', 'sku' => 'BEV-006', 'name' => 'Vanilla Oat Chai', 'slug' => 'vanilla-oat-chai', 'description' => 'A warming chai blend with vanilla, cardamom, and oat notes.', 'price' => 799.00, 'stock' => 43],
            ['category' => 'artisan-beverages', 'sku' => 'BEV-007', 'name' => 'Sparkling Mineral Water', 'slug' => 'sparkling-mineral-water', 'description' => 'Crisp, finely carbonated mineral water for polished service.', 'price' => 349.00, 'stock' => 96],
            ['category' => 'artisan-beverages', 'sku' => 'BEV-008', 'name' => 'Cacao Nib Drinking Chocolate', 'slug' => 'cacao-nib-drinking-chocolate', 'description' => 'Intense drinking chocolate with roasted cacao nibs.', 'price' => 849.00, 'stock' => 31],
            ['category' => 'artisan-beverages', 'sku' => 'BEV-009', 'name' => 'Peach Oolong Tea', 'slug' => 'peach-oolong-tea', 'description' => 'A smooth oolong tea with a naturally sweet peach aroma.', 'price' => 729.00, 'stock' => 40],
            ['category' => 'artisan-beverages', 'sku' => 'BEV-010', 'name' => 'Espresso House Blend', 'slug' => 'espresso-house-blend', 'description' => 'A balanced espresso blend with caramel and toasted hazelnut.', 'price' => 999.00, 'stock' => 58],
            ['category' => 'signature-snacks', 'sku' => 'SNK-003', 'name' => 'Sea Salt Caramel Fudge', 'slug' => 'sea-salt-caramel-fudge', 'description' => 'Soft, buttery fudge finished with flakes of sea salt.', 'price' => 549.00, 'stock' => 47],
            ['category' => 'signature-snacks', 'sku' => 'SNK-004', 'name' => 'Cranberry Pistachio Bites', 'slug' => 'cranberry-pistachio-bites', 'description' => 'A bright, nutty bite with tart cranberry and pistachio.', 'price' => 629.00, 'stock' => 42],
            ['category' => 'signature-snacks', 'sku' => 'SNK-005', 'name' => 'Wasabi Sesame Crisps', 'slug' => 'wasabi-sesame-crisps', 'description' => 'Thin, crisp crackers with sesame warmth and a clean wasabi lift.', 'price' => 479.00, 'stock' => 65],
            ['category' => 'signature-snacks', 'sku' => 'SNK-006', 'name' => 'Honey Roasted Macadamias', 'slug' => 'honey-roasted-macadamias', 'description' => 'Premium macadamias lightly glazed with raw forest honey.', 'price' => 899.00, 'stock' => 33],
            ['category' => 'signature-snacks', 'sku' => 'SNK-007', 'name' => 'Coconut Almond Biscotti', 'slug' => 'coconut-almond-biscotti', 'description' => 'Twice-baked biscotti with toasted coconut and almond.', 'price' => 579.00, 'stock' => 51],
            ['category' => 'signature-snacks', 'sku' => 'SNK-008', 'name' => 'Black Pepper Potato Chips', 'slug' => 'black-pepper-potato-chips', 'description' => 'Hand-cooked chips with cracked pepper and a delicate crunch.', 'price' => 399.00, 'stock' => 74],
            ['category' => 'signature-snacks', 'sku' => 'SNK-009', 'name' => 'Matcha White Chocolate Truffles', 'slug' => 'matcha-white-chocolate-truffles', 'description' => 'Silky white chocolate truffles balanced with ceremonial matcha.', 'price' => 949.00, 'stock' => 29],
            ['category' => 'signature-snacks', 'sku' => 'SNK-010', 'name' => 'Mediterranean Olive Crackers', 'slug' => 'mediterranean-olive-crackers', 'description' => 'Artisan crackers with green olive, herbs, and olive oil.', 'price' => 529.00, 'stock' => 57],
            ['category' => 'office-essentials', 'sku' => 'OFF-003', 'name' => 'Linen Bound Meeting Journal', 'slug' => 'linen-bound-meeting-journal', 'description' => 'A refined, lay-flat journal designed for important notes.', 'price' => 699.00, 'stock' => 38],
            ['category' => 'office-essentials', 'sku' => 'OFF-004', 'name' => 'Executive Rollerball Pen', 'slug' => 'executive-rollerball-pen', 'description' => 'A balanced metal rollerball with a smooth precision refill.', 'price' => 899.00, 'stock' => 27],
            ['category' => 'office-essentials', 'sku' => 'OFF-005', 'name' => 'Leatherette Desk Tray', 'slug' => 'leatherette-desk-tray', 'description' => 'A clean-lined tray for organising daily desk essentials.', 'price' => 1199.00, 'stock' => 21],
            ['category' => 'office-essentials', 'sku' => 'OFF-006', 'name' => 'Monochrome Sticky Notes Set', 'slug' => 'monochrome-sticky-notes-set', 'description' => 'Premium paper notes in a restrained professional palette.', 'price' => 299.00, 'stock' => 84],
            ['category' => 'office-essentials', 'sku' => 'OFF-007', 'name' => 'Minimalist Document Folder', 'slug' => 'minimalist-document-folder', 'description' => 'Structured document storage for presentations and proposals.', 'price' => 549.00, 'stock' => 46],
            ['category' => 'office-essentials', 'sku' => 'OFF-008', 'name' => 'Brushed Steel Card Holder', 'slug' => 'brushed-steel-card-holder', 'description' => 'A compact, durable holder for business cards and notes.', 'price' => 649.00, 'stock' => 35],
            ['category' => 'office-essentials', 'sku' => 'OFF-009', 'name' => 'Desk Cable Management Kit', 'slug' => 'desk-cable-management-kit', 'description' => 'Subtle cable organisation for a calmer, cleaner workspace.', 'price' => 399.00, 'stock' => 63],
            ['category' => 'office-essentials', 'sku' => 'OFF-010', 'name' => 'Cork Desk Calendar', 'slug' => 'cork-desk-calendar', 'description' => 'A reusable desktop calendar with a warm natural finish.', 'price' => 749.00, 'stock' => 30],
            ['category' => 'wellness-care', 'sku' => 'WEL-003', 'name' => 'Lavender Hand Lotion', 'slug' => 'lavender-hand-lotion', 'description' => 'A fast-absorbing lotion with lavender and oat extract.', 'price' => 599.00, 'stock' => 49],
            ['category' => 'wellness-care', 'sku' => 'WEL-004', 'name' => 'Cedarwood Soy Candle', 'slug' => 'cedarwood-soy-candle', 'description' => 'A calming soy candle with cedarwood, amber, and moss.', 'price' => 899.00, 'stock' => 25],
            ['category' => 'wellness-care', 'sku' => 'WEL-005', 'name' => 'Linen Eye Comfort Mask', 'slug' => 'linen-eye-comfort-mask', 'description' => 'A softly weighted linen mask for quiet restorative breaks.', 'price' => 749.00, 'stock' => 34],
            ['category' => 'wellness-care', 'sku' => 'WEL-006', 'name' => 'Botanical Lip Balm Trio', 'slug' => 'botanical-lip-balm-trio', 'description' => 'Three nourishing balms made with botanical oils and waxes.', 'price' => 499.00, 'stock' => 56],
            ['category' => 'wellness-care', 'sku' => 'WEL-007', 'name' => 'Eucalyptus Shower Steamers', 'slug' => 'eucalyptus-shower-steamers', 'description' => 'A refreshing aromatic ritual for an energising reset.', 'price' => 679.00, 'stock' => 43],
            ['category' => 'wellness-care', 'sku' => 'WEL-008', 'name' => 'Natural Cotton Hand Towels', 'slug' => 'natural-cotton-hand-towels', 'description' => 'Soft, absorbent cotton towels with a quiet hotel finish.', 'price' => 799.00, 'stock' => 38],
            ['category' => 'wellness-care', 'sku' => 'WEL-009', 'name' => 'Citrus Mineral Bath Soak', 'slug' => 'citrus-mineral-bath-soak', 'description' => 'Mineral-rich salts with a bright citrus botanical blend.', 'price' => 849.00, 'stock' => 27],
            ['category' => 'wellness-care', 'sku' => 'WEL-010', 'name' => 'Unscented Gentle Soap Set', 'slug' => 'unscented-gentle-soap-set', 'description' => 'A mild, fragrance-free soap set for comfortable daily care.', 'price' => 549.00, 'stock' => 62],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                [
                    'category_id' => $categories[$product['category']],
                    'sku' => $product['sku'],
                    'name' => $product['name'],
                    'slug' => $product['slug'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'is_available' => true,
                ],
            );
        }

        $reviewers = collect([
            ['name' => 'Aarav Mehta', 'email' => 'aarav.reviewer@example.com'],
            ['name' => 'Maya Kapoor', 'email' => 'maya.reviewer@example.com'],
            ['name' => 'Daniel Reed', 'email' => 'daniel.reviewer@example.com'],
            ['name' => 'Sofia Bennett', 'email' => 'sofia.reviewer@example.com'],
        ])->map(function (array $attributes) {
            return User::updateOrCreate(
                ['email' => $attributes['email']],
                [...$attributes, 'role' => 'customer', 'password' => 'password'],
            );
        });

        $reviewComments = [
            'Beautifully presented and noticeably better than the usual everyday alternative.',
            'The quality feels premium, and it arrived carefully packed. I would happily order it again.',
            'A thoughtful product with excellent finish and dependable performance.',
            'Exactly what our team needed. The details and overall experience feel very considered.',
        ];

        Product::whereIn('slug', collect($products)->pluck('slug'))->get()->each(function (Product $product, int $productIndex) use ($reviewers, $reviewComments) {
            $reviewers->take(3)->values()->each(function (User $reviewer, int $reviewerIndex) use ($product, $productIndex, $reviewComments) {
                Review::updateOrCreate(
                    ['product_id' => $product->id, 'user_id' => $reviewer->id],
                    [
                        'rating' => [5, 4, 5][$reviewerIndex],
                        'comment' => $reviewComments[($productIndex + $reviewerIndex) % count($reviewComments)],
                        'is_approved' => true,
                    ],
                );
            });
        });
    }
}
