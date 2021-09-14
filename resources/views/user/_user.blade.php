<div class="list-group-item">
    <img src="{{$user->gravatar()}}"
         alt="{{$user->name}}"
         width="32" class="mr-3">
    <a href="{{route('users.show',$user)}}">
        {{$user->id}}-----{{$user->name}}
    </a>
    <a>
        @can('destroy',$user)
            <form action="{{route('users.destroy',$user->id)}}"
                  method="POST" class="float-right">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit"
                        class="btn btn-danger btn-sm delete-btn">
                    删除
                </button>
            </form>
        @endcan
    </a>
</div>
