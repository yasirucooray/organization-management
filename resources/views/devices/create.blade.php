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
    <h1>Create Device for {{ $location->name }}</h1>
    <br>
    <div class="row">
        @error('error')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        <div class="col-12">
            <form action="{{ route('locations.devices.store', $location->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="code" class="form-label"> Number</label>
                    <input type="text" class="form-control" id="number" name="number" value="{{ old('number') }}"
                        required>
                    @error('number')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option class="form-control" value="pos" {{ old('type') == 'pos' ? 'selected' : '' }}>POS
                        </option>
                        <option class="form-control" value="kiosk" {{ old('type') == 'kiosk' ? 'selected' : '' }}>Kiosk
                        </option>
                        <option class="form-control" value="digital-signage"
                            {{ old('type') == 'digital-signage' ? 'selected' : '' }}>Digital Signage</option>
                    </select>
                    @error('type')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option class="form-control" value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                            Active</option>
                        <option class="form-control" value="inactive"
                            {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label"> Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                    @error('image')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
