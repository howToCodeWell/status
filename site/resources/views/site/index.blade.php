<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sites</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <td>Site Name</td>
        <td>Date Checked</td>
        <td>Result</td>
    </tr>
    </thead>
    <tbody>
    @foreach($sites as $site)
    <tr>
        <td>
            <a href="{{ $site->url }}">{{$site->name}}</a>
        </td>

        @if($site->getLatestResult())
            <td>{{ $site->getLatestResult()->created_at->format('d-m-Y h:i:s') }}</td>
            <td>
                @if($site->getLatestResult()->passed)
                    Passed
                @else
                    Failed
                @endif
            </td>
        @else
            <td>-</td>
            <td>-</td>
        @endif

    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
