
    <ul class="list">
        <li class="products">
            <div class="header">
                <i class="suggester-icon osh-font-stats-bars"></i>
                <span class="title">Popular Products</span>
            </div>
            <ul class="list">
                @forelse($searchProducts as $searchProduct)
                <li class="product item" data-tracking="sdf" data-tracking-trigger="searchSuggestionTopProducts">
                    <a href="{{ route('product', $searchProduct->id) }}">
                        <span class="product-image">
                            <img class="lazy image -loaded" style="height: 50px; width: 50px;" src="{{ asset($searchProduct->thumbImage) }}" data-src="{{ asset($searchProduct->thumbImage) }}" data-placeholder="{{ ucfirst($searchProduct->productName) }}" alt="{{ ucfirst($searchProduct->productName) }} ">
                        </span>
                        <span class="product-details">
                            <span class="product-title">{{ ucfirst($searchProduct->productName) }}</span>
                            <span class="product-price">{{ number_format($searchProduct->finalPrice) }}</span>
                        </span>
                    </a>
                </li>
                @empty

                @endforelse
            </ul>
        </li>

        <li class="products-cta">
            <div class="products-cta-btn osh-btn -no_bg_secondary -block">
                <span class="translate">See all Results</span>
                <span class="count -is_ltr_content">{{ count($searchProducts) }}</span>
            </div>
        </li>
    </ul>
