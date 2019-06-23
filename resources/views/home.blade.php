<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <style>
        .container, .container-fluid {
            font-size: 13px !important;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="{{ url('home') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('form') }}">Add Project</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4>API Endpoints</h4>
            <ol>
                <li>All projects : <a href="{{ url('api/projects/all') }}" target="_blank">{{ url('api/projects/all')  }}</a></li>
                <li>Projects with status completed : <a href="{{ url('api/projects/status/completed') }}" target="_blank">{{ url('api/projects/status/completed')  }}</a></li>
                <li>Projects from county Kenya : <a href="{{ url('api/projects/country/kenya') }}" target="_blank">{{ url('api/projects/country/kenya')  }}</a></li>
            </ol>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <a href="{{ url('form') }}" class="btn btn-primary float-right">Add Project</a>
            <h2>Projects</h2>

            Rows <select onchange="rowsChanged(this.value)">
                @foreach([5, 10, 20, 50, 100] as $i)
                    <option @if(request('rows', 10)==$i) selected @endif>{{ $i }}</option>
                @endforeach
            </select>
            <table class="table table-bordered mt-3">
                <thead>
                <tr>
                    <th>Country</th>
                    <th>Region</th>
                    <th>Title</th>
                    <th>Objectives</th>
                    <th>Party To</th>
                    <th>Country Classification</th>
                    <th>Trust Fund</th>
                    <th>Co-Financing</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Story</th>
                    <th>SDGs</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($projects as $project)
                    <tr>
                        <td>
                            @foreach($project->countries as $country)
                                {{ $country->name }},
                            @endforeach
                        </td>
                        <td>{{ $project->region->name }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->objectives }}</td>
                        <td>{{ $project->partyto }}</td>
                        <td>{{ $project->region->class }}</td>
                        <td>{{ $project->trust_fund }}</td>
                        <td>{{ $project->co_financing }}</td>
                        <td>{{ $project->duration}} months</td>
                        <td>{{ $project->status}}</td>
                        <td>{{ $project->story}}</td>
                        <td>{{ $project->sdgs}}</td>
                        <td style="min-width: 200px">
                            <a href="{{ url("form/$project->id?id=$project->id") }}" class="btn btn-outline-primary btn-sm">Edit</a>
                            <a href="{{ url("form/$project->id?delete=true") }}" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="11" class="text-danger">
                            No records
                        </th>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $projects->appends(['rows' => request('rows')])->links() }}
        </div>
    </div>
</div>
<script>
    let domain = "{{url('/')}}";

    function rowsChanged(count) {
        window.location.href = domain + '/home?rows=' + count + '&id=' + '{{ request('id') }}';
    }
</script>
</body>
</html>
