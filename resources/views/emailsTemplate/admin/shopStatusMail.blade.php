@component('mail::message')
# Hi. {{ ucfirst($shopFounder->name) }}

@component('mail::panel')
@if($status ==0 )

-Sir Your Shop {{ $shopName }} is make as Block for some Region <br>
**if you Went to back Pleass Contact With <a href="mail:admin@dorpon.com">admin@dorpon.com</a>**

@else
--Sir Your Shop {{ $shopName }} is Active Now.<br>
You Can Continue Your Activites as like Prvious.<br>  
**Thank To Stay With us**

@endif

@endcomponent

@if($status ==1 )
@component('mail::button', ['url' => route('merchantile.login')])
Login
@endcomponent

@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
