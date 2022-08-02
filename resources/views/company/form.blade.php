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
                       value="{{ old('name', isset($company->name) ? $company->name:'')}}" required>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" class="form-control"
                       value="{{ old('name', isset($company->location) ? $company->location:'')}}"
                       required>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label for="contact-no">Contact no.</label>
                <input type="tel" name="contact" id="contact-no" class="form-control"
                       value="{{ old('name', isset($company->contact) ? $company->contact:'')}}"
                       required>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label for="department">Departments</label>
                <div class="row">
                    <div class="col-md-10">
                        <select name="departments[]" id="department" class="form-control multi-select"
                                multiple="multiple">
                            @foreach($departments as $department)
                                @if(in_array($department->id, $departmentIds))
                                    <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                                @else
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm add-department-btn"><i class="fa fa-plus"></i> Add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
            <a href="{{route('company.index')}}" class="btn btn-danger btn-sm">Back</a>
        </div>
    </div>
</div>
