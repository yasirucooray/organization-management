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
    <a href="{{ route('organizations.index') }}">Back</a>
    <h2>Organization Details</h2>
    <div>
        <p style="font-size: 24px"> <strong>Name:</strong> {{ $organization->name }}</p>
        <p style="font-size: 24px"><strong>Code:</strong> {{ $organization->code }}</p>
    </div>

    <p>
    <h3>Locations</h3>
    <a href="{{ route('organizations.locations.create', $organization->id) }}"><button class="btn btn-success"> New
            Location</button></a></p>
    @if ($organization->locations->isEmpty())
        <p>No locations available.</p>
    @endif

    <br>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Location</th>
                        <th scope="col">Serial Number</th>
                        <th scope="col">IPV4 Address</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($organization->locations as $location)
                        <tr>
                            <th scope="row">{{ $location->id }}</th>
                            <td>{{ $location->name }}</td>
                            <td>{{ $location->serial_number }}</td>
                            <td>{{ $location->ipv4_address }}</td>
                            <td>
                                <a
                                    href="{{ route('organizations.locations.show', [$organization->id, $location->id]) }}"><button
                                        type="button" class="btn btn-primary"><i
                                            class="far fa-eye"></i>View</button></a>
                                <a href="{{ route('organizations.locations.edit', [$organization->id, $location->id]) }}"
                                    class="btn btn-warning">Edit</a>
                                <form
                                    action="{{ route('organizations.locations.destroy', [$organization->id, $location->id]) }}"
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
