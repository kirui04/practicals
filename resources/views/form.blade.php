<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 640px;
            }
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
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Add Project</h2>
        </div>
        <div class="card-body">
            <ul>
                @foreach($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            @if(session()->has('ok'))
                <div class="alert alert-success">Added successfully!</div>
            @endif

            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label>Region</label>
                    <select class="form-control" name="region_id" onchange="filterCountries(this.value)" required>
                        <option value="">--Select--</option>
                        @foreach($regions as $reg)
                            <option @if($reg->id==request('region')) selected @endif value="{{ $reg->id }}">{{ $reg->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Project Countries</label>
                    <select name="country_ids[]" class="form-control" multiple style="min-height: 200px" required>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Project Title</label>
                    <input class="form-control" name="title" value="{{ old('title', @$project->title) }}"
                           placeholder="Project title" required>
                </div>

                <div class="form-group">
                    <label>Party To</label>
                    <input class="form-control" name="partyto" value="{{ old('partyto', @$project->partyto) }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Trust Fund</label>
                    <input class="form-control" name="trust_fund" value="{{ old('trust_fund', @$project->trust_fund) }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Co Financing</label>
                    <input class="form-control" name="co_financing"
                           value="{{ old('co_financing', @$project->co_financing) }}" required>
                </div>

                <div class="form-group">
                    <label>Duration</label>
                    <input type="number" class="form-control" name="duration"
                           value="{{ old('duration', @$project->duration) }}" required>
                </div>


                <div class="form-group">
                    <label>Duration</label>
                    <select name="status" class="form-control" required>
                        <option>Completion report submitted</option>
                        <option>Under implementation</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Project Story</label>
                    <textarea rows="4" name="story" class="form-control"
                              required>{{ old('story', @$project->story) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Project Story</label>
                    <textarea rows="4" name="sdgs" class="form-control"
                              required>{{ old('sdgs', @$project->sdgs) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Objectives</label>
                    <textarea rows="8" name="objectives" class="form-control"
                              required>{{ old('objectives', @$project->objectives) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    function filterCountries(id) {
        let domain = "{{url('/')}}";
        if (id) {
            window.location.href = domain + '/form?region=' + id + '&id={{ request('id') }}';
        }
    }
</script>
</html>
