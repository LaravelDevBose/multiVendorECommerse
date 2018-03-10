@component('mail::message')
 Thank You #{{ $qusenInfo->name }}


-You are Qusetion about our product<br>
-Product Name :<a href="{{ route('singel.product.view', $productInfo->id) }}" style="text-decoration: none; color: blue;"> <b> {{ $productInfo->productName }}</b> </a> <br>
-Product Code : {{ $productInfo->productCode }}<br>
-Product Price : {{ $productInfo->newPrice }}<br>

@component('mail::panel')
**Q: {{ $qusenInfo->message }} ?**

**Answer:** <p>{{ $answer }}</p>
@endcomponent

@component('mail::button', ['url' => route('singel.product.view', $productInfo->id)])
View Product
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
