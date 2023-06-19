@foreach ($get_users as $user)
<a href="{{ route('admin.show_user', $user->id) }}" title="{{ $user->name }}"
    class="btn btn-icon btn-default mx-auto mb-4 ">
    <div class="symbol symbol-40px symbol-circle">
        <img src="{{ $user->image_path }}" alt="">

    </div>
</a>
@endforeach
