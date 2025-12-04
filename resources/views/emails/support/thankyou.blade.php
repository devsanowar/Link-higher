@component('mail::message')
# Thank you, {{ $support->name }}! 🙌

We’ve received your support/quote request.
Our team will get back to you shortly. 🙂

@if($support->service_type)
**Service Type:** {{ $support->service_type }}
@endif

@if($support->website_url)
**Website / Project URL:** {{ $support->website_url }}
@endif

@if($support->budget_range)
**Estimated Budget:** {{ $support->budget_range }}
@endif

---

Here’s what you submitted:

> {{ $support->message }}

If you need to add anything or correct any detail,
you can simply **reply to this email**, and we’ll handle it from there.

Thanks again,
**{{ config('app.name') }}**
@endcomponent
