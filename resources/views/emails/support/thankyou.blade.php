@component('mail::message')
# Thank you, {{ $support->name }}! 🙌

আমরা আপনার সাপোর্ট/কোট রিকোয়েস্টটি পেয়েছি।
আমাদের টিম খুব দ্রুতই আপনার সাথে যোগাযোগ করবে। 🙂

@if($support->service_type)
**Service Type:** {{ $support->service_type }}
@endif

@if($support->website_url)
**Website / Project URL:** {{ $support->website_url }}
@endif

@if($support->budget_range)
**Approx. Budget:** {{ $support->budget_range }}
@endif

---

আপনি যা লিখেছেন:

> {{ $support->message }}

যদি এর মধ্যে কিছু আপডেট থাকে বা ভুল হয়, আপনি সরাসরি এই ইমেইলের Reply দিয়েও আমাদের জানাতে পারেন।

Thanks again,
**{{ config('app.name') }}**
@endcomponent
