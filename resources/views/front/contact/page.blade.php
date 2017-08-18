@extends('front.base', ['pageName' => 'contact-page'])

@section('content')
    <h1 class="h1 text-col text-center">Contact Us</h1>
    <p class="body-text text-center text-constrain">Stay tuned for our new booking form, coming soon! In the meantime, if you'd like to book a table please send a message and let us know for how many people, and when.</p>
    <contact-form url="/contact" button-text="send"></contact-form>
@endsection