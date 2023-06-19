<table>
    <thead>
        <tr>
            <th style="min-width: 80px">User Name</th>
            <th style="min-width: 80px">Total Rate</th>
            <th style="min-width: 80px">Assessment Name</th>
            <th style="min-width: 80px">Assessment Manager</th>
            <th style="min-width: 80px">Assessment Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rates as $rate)
            <tr style="text-align: center">
                <td style="min-width: 80px;text-align: center">{{ $rate->user->name }}</td>
                <td style="min-width: 80px;text-align: center">{{ $rate->rate }}%</td>
                <td style="min-width: 80px;text-align: center">{{ $rate->assessment->title }}</td>
                <td style="min-width: 80px;text-align: center">{{ $rate->assessment->manager->name }}</td>
                <td style="min-width: 80px;text-align: center">{{ $rate->assessment->type }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
