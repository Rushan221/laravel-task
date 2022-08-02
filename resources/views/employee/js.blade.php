<script>
    $(document).ready(function () {
        $('.department-select').select2({
            placeholder: "Select a company first.",
        });

        $('.company-select').on('change', function () {
            let companyId = $(this).val();
            $('.department-select').empty().trigger('change');
            if (companyId !== '') {
                getCompanyDepartments(companyId)
            }
        });

        function getCompanyDepartments(companyId) {
            $.ajax({
                url: "{{ route('get.company.departments') }}",
                type: "GET",
                data: {
                    companyId: companyId
                },
                success: function (response) {
                    if (response.status === 'success') {
                        let departments = response.departments;
                        $.each(departments, function (i, val) {
                            $('.department-select').select2({
                                placeholder: "Select departments",
                            });
                            $("#department").prepend('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                    } else if (response.status === 'no_department') {
                        $('.department-select').select2({
                            placeholder: "No departments found.",
                        });
                    }
                },
                error: function (err) {
                    alert('Internal server error');
                }
            });
        }
    });
</script>
