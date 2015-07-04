@extends('layout.main')

@section('content')
    <h1>CAGE ME!</h1>
    <p>List of methods you can use in this API:</p>
    <table>
        <thead>
        <tr>
            <th>Method</th>
            <th>URL</th>
            <th>Parameters</th>
            <th>Return Format</th>
            <th>Notes / Description</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>GET</td>
            <td>/random</td>
            <td>n/a</td>
            <td>JSON</td>
            <td>Returns a single random picture of our One True God.</td>
        </tr>
        <tr>
            <td>GET</td>
            <td>/bomb/{number?}</td>
            <td>n/a</td>
            <td>JSON</td>
            <td>Returns a(n) (optional) {number} of random cages (default if no number specified is 5), up to a maximum of {{ \App\Repositories\JsonCageRepository::MAX_BOMB_CAGES }}.</td>
        </tr>
        <tr>
            <td>GET</td>
            <td>/count</td>
            <td>n/a</td>
            <td>JSON</td>
            <td>Returns the total number of pictures of our One True God that are available to us.</td>
        </tr>
        </tbody>
    </table>
@endsection