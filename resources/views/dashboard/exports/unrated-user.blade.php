<table>
    <thead>
        <tr>
            <th class="min-w-125px">#</th>
            <th class="min-w-125px">Name</th>
            <th class="min-w-125px">Manager Name</th>
            <th class="min-w-125px">Assessment Title</th>
        </tr>
    </thead>
    <tbody>
        @foreach($unRatedUsers as $key=>$UnrateUser)
                    <tr id="row-{{ $UnrateUser->id }}">
                        <td>{{$key+1}}</td>
                        <td class="name" data-field="name">
                            {{ $UnrateUser?->user->name }}
                        </td>

                        <td class="name" data-field="name">
                            {{ $UnrateUser?->assessment?->manager->name }}
                        </td>

                        <td class="name" data-field="name">
                            {{ $UnrateUser?->assessment?->title }}
                        </td>
                    </tr>
        @endforeach
    </tbody>
</table>
