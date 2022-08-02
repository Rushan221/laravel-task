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
                       value="{{ old('name', isset($employee->name) ? $employee->name:'')}}" required>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control"
                       value="{{ old('email', isset($employee->email) ? $employee->email:'')}}" required>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label for="contact">Contact No.:</label>
                <input type="tel" name="contact" id="contact" class="form-control"
                       value="{{ old('contact', isset($employee->contact) ? $employee->contact:'')}}" required>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label for="designation">Designation:</label>
                <input type="tel" name="designation" id="designation" class="form-control"
                       value="{{ old('designation', isset($employee->designation) ? $employee->designation:'')}}"
                       required>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label for="company">Company:</label>
                <select name="company" id="company" class="form-control company-select">
                    <option value="">--- Select a company ---</option>
                    @foreach($companies as $company)
                        <option
                            value="{{$company->id}}" {{isset($employee->company_id)? ($employee->company_id == $company->id)?'selected':'':''}}>{{$company->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label for="department">Department(s):</label>
                <select name="departments[]" id="department" class="form-control department-select" multiple="multiple">
                    <option></option>
                    @if(isset($departments))
                        @foreach($departments as $department)
                            @if(in_array($department->id, $departmentIds))
                                <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                            @else
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>

        </div>
    </div>
    <div class="card-footer">
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
            <a href="{{route('employee.index')}}" class="btn btn-danger btn-sm">Back</a>
        </div>
    </div>
</div>


