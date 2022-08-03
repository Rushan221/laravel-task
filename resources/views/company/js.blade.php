<script>
    $(document).ready(function () {
        $('.multi-select').select2();

        $('.add-department-btn').on('click', function () {
            $('#add-department-form').trigger("reset");
            $('#add-department-modal').modal('show');
        });

        $('#add-department-form').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('add.department') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    formData
                },
                success: function (response) {
                    if (response.status === 'success') {
                        let department = response.department;
                        $("#department").prepend('<option value="' + department.id + '">' + department.name + '</option>');
                        $('#add-department-modal').modal('hide');
                        Swal.fire('New Department has been added.', '', 'success')
                    } else if (response.status === 'failed') {
                        let errors = response.errors
                        for (let key of Object.keys(errors)) {
                            let errorDiv = $('#' + key + '-msg');
                            errorDiv.show();
                            errorDiv.append(errors[key])
                        }
                    } else {
                        $('#add-department-modal').modal('hide');
                    }
                },
                error: function (err) {
                    alert('Internal server error');
                }
            });
        });
    });
</script>
