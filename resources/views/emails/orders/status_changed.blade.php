@component('mail::message')
# Order Status Updated

Hello {{ $order->customer_name ?? 'Customer' }},

Your order **#{{ $order->id }}** status has been updated.

**Previous status:** {{ $order->getOriginal('status') ?? 'N/A' }}
**Current status:** {{ $order->status }}
**Updated at:** {{ $order->status_updated_at ? \Carbon\Carbon::parse($order->status_updated_at)->format('Y-m-d H:i') : now()->format('Y-m-d H:i') }}

@component('mail::button', ['url' => route('order.show', $order->id)])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
