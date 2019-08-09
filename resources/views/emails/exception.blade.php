<ul>
    <li>IP Address: {{Request::ip()}}</li>
    <li>Time: {{Carbon\Carbon::now()->toDateTimeString()}}</li>
    <li>User: 
        @if(Auth::user())
            {{Auth::user()->name}}
        @else
            N/A **Guest**
        @endif
    </li>
    <li>Website: {{config('app.name')}}</li>
</ul>

{!! $content !!}