@component('mail::message')
    # Message Received

    The following message comes via the site:

    From: {{ $name }}
    Email: {{ $email }}
    Phone: {{ $phone }}

    {{ $enquiry }}

@endcomponent