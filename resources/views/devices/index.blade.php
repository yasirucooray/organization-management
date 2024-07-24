<head>
    <style>
        .container {
            padding: 2rem 0rem;
        }

        h4 {
            margin: 2rem 0rem 1rem;
        }

        .table-image {

            td,
            th {
                vertical-align: middle;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>


<div class="container">
    {{-- <a href="{{ route('organizations.locations.index', $location->id) }}">Back</a> --}}
    <h1>Devices for {{ $location->name }}</h1>
    <a href="{{ route('locations.devices.create', $location->id) }}"><button class="btn btn-success"> New
            Device</button></a></p>
    <br>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Device Number</th>
                        <th scope="col">Type</th>
                        <th scope="col">Image</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($location->devices as $device)
                        <tr>
                            <th scope="row">{{ $device->id }}</th>
                            <td>{{ $device->number }}</td>
                            <td>{{ $device->type }}</td>
                            <td><img src="{{ Storage::url($device->image) }}" alt="Device Image" width="150"></td>
                            <td>{{ $device->created_at->format('Y-m-d') }}</td>
                            <td>{{ $device->status }}</td>
                            <td>
                                <a href="{{ route('locations.devices.edit', [$location->id, $device->id]) }}"
                                    class="btn btn-warning">Edit</a>
                                <form action="{{ route('locations.devices.destroy', [$location->id, $device->id]) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
