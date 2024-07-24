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
    <h1>Create Location for {{ $organization->name }}</h1>
    <br>
    <div class="row">
        @error('error')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        <div class="col-12">
            <form action="{{ route('organizations.locations.store', $organization->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="code" class="form-label">Serial Number</label>
                    <input type="text" class="form-control" id="serial_number" name="serial_number"
                        value="{{ old('serial_number') }}" required>
                    @error('serial_number')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                        required>
                    @error('name')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">IP4 Address</label>
                    <input type="text" class="form-control" id="ipv4_address" name="ipv4_address"
                        value="{{ old('ipv4_address') }}" required>
                    @error('ipv4_address')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
