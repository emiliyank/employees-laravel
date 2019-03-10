@component('mail::message')
# New team member

Yay, our team is growing! New colleague has registered on our platform, this is {{ $newColleague->name }} {{ $newColleague->lastname}} with email {{ $newColleague->email }}.
You can greet him/her.

Best,<br>
{{ config('app.name') }}
@endcomponent
