@component('mail::message')
 #Thank You {{ $qusenInfo->name }}


-You Order Was Shipped As soon as You get Your Products<br>
-** Total Product ** : {{ $order->totalProduct }}<br>
-** Total Ammount ** : {{ $order->totalAmmount }}<br>

<div style="width: 100%; height: auto; margin:0px; padding: 0px;">
	
	<div style="width:50%; height: auto; margin:.3em; padding: .5em; border: 1px solid #333; ">
		@component('mail::panel')
		demo
		@endcomponent
	</div>
	<div style="width:50%; height: auto; margin:.3em; padding: .5em; border: 1px solid #333; ">
		demo
	</div>

</div>
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