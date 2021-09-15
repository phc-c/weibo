<li class="media mt4 mb4">
    <a href="{{route('users.show',$user->id)}}">
        <img src="{{$user->gravatar()}}" alt="{{$user->name}}"
             class="mr-3 gravatar">
    </a>
    <div class="media-body">
        <h5 class="mt-0 mb-1">
            {{$user->name}}
            <small>
                / {{$status->created_at->diffForHumans()}}
            </small>
        </h5>
        {{$status->content}}
    </div>
</li>
