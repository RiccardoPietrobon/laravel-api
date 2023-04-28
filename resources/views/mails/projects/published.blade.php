<x-mail::message>
# {{$published_text}}
## {{$project->title}}

<p> {{$project->getAbstract(20)}} </p>

@if($project->published)
<x-mail::button :url="$button_url">

Dettaglio
</x-mail::button>
@endif

Grazie, <br>
{{ config('app.name') }}
    
</x-mail::message>