<table>
    <thead>
        <tr>
            <th class="min-w-125px">#</th>
            <th class="min-w-125px">Name</th>
            <th class="min-w-125px">Manager Name</th>
            <th class="min-w-125px">Assessment Title</th>
            <th class="min-w-125px">Rate</th>
        </tr>
    </thead>
    <tbody>
        @foreach($RatedUsers as $key=>$rateUser)
        <tr id="row-{{ $rateUser->id }}">
            <td>{{$key+1}}</td>
            <td class="name" data-field="name">
                {{ $rateUser?->user->name }}
            </td>
            <td class="name" data-field="name">
                {{ $rateUser?->assessment->manager->name }}
            </td>

            <td class="name" data-field="name">
                {{ $rateUser?->assessment?->title }}
            </td>
            <td class="name" data-field="name">
                {{ $rateUser?->rateUser->rate}} %
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
