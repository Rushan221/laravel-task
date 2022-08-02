<div class="card">
    <div class="card-header">
        <h3>{{$cardHeader}}</h3>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Warning!</strong> Please check your fields<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="form-group col-md-6 mb-3">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name', isset($department->name) ? $department->name:'')}}" required>
            </div>

        </div>
    </div>
    <div class="card-footer">
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
            <a href="{{route('department.index')}}" class="btn btn-danger btn-sm">Back</a>
        </div>
    </div>
</div>
