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
        <td>Result</td>
    </tr>
    </thead>
    <tbody>
    @foreach($sites as $site)
    <tr>
        <td>
            <a href="{{ $site->url }}">{{$site->name}}</a>
        </td>
        <td>
            @if($site->hasPassed())
                Passed
            @else
                Failed
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
