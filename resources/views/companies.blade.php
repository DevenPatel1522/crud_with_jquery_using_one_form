<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}





</head>


<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Company Data</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Company</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered" id="ajax-crud-datatable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Image</th>
                        <th>country</th>
                        <th>state</th>
                        <th>city</th>
                        <th>hobbies</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- boostrap company model -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="modal fade" id="company-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="CompanyModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label"> Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Company Name" maxlength="50">
                                {{-- @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label"> Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Company Email" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Address</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Company Address">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Gender</label>
                            <div class="col-sm-12">
                                <input type="radio" name="gender" id="gender" value="male">&nbsp;Male
                                <input type="radio" name="gender" id="gender" value="female">&nbsp;Female
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Image</label>
                            <div class="col-sm-12">
                                <input type="file" name="image" id="image" class="form-control" placeholder="image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"> country</label>
                            <div class="col-sm-12">
                                <select id="country" name=country>
                                    <option value="" selected disabled>Select</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"> {{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label"> State</label>
                            <div class="col-sm-12">

                                <select name=state id="state">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> City</label>
                            <div class="col-sm-12">
                                <div>
                                    <select name=city id="city">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label"> Hobbies</label>
                            <div class="col-sm-12">
                                <input type="checkbox" name="hobbies[]" id="hobbies"
                                    value="html">&nbsp;&nbsp;html&nbsp;&nbsp;
                                <input type="checkbox" name="hobbies[]" id="hobbies" value="css">&nbsp;css &nbsp;&nbsp;
                                <input type="checkbox" name="hobbies[]" id="hobbies" value="javascript">&nbsp;javascript
                                &nbsp;&nbsp;
                                <input type="checkbox" name="hobbies[]" id="hobbies" value="php">&nbsp;php &nbsp;&nbsp;
                                <input type="checkbox" name="hobbies[]" id="hobbies" value="laravel">&nbsp;laravel
                                &nbsp;&nbsp;
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->
</body>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">
   
            $(document).ready(function() {
               
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#ajax-crud-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('ajax-crud-datatable') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'gender',
                            name: 'gender'
                        },
                        {
                            data: 'image',
                            name: 'image',
                            render: function(data, type, full, meta) {
                                return '<img src="{{ url('public/image/') }}/' + data +
                                    '" height="120px;"\>';
                            }
                        },
                        {
                            data: 'country',
                            name: 'country'
                        },
                        {
                            data: 'state',
                            name: 'state'
                        },
                        {
                            data: 'city',
                            name: 'city'
                        },
                        {
                            data: 'hobbies',
                            name: 'hobbies'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false
                        },
                    ],
                    order: [
                        [0, 'desc']
                    ]
                });
                $('#CompanyForm').validate({
                        rules: {
                            name: {
                                required: true
                            },
                            email:{
                                required:true  
                            },
                            address:{
                                required:true
                            },
                            gender:{
                                required:true
                            },
                            image:{
                                required:true
                            },
                            country:{
                                required:true
                            },
                            state:{
                                required:true
                            },
                            city:{
                                required:true
                            },
                            "hobbies[]":{
                                required:true,
                                minlength: 1 

                            }

                        },
                        messages: {

                            name: {
                                required: "Please enter name",
                            },
                            email:{
                                required: "Please enter email",
                            },
                            address:{
                                required: "Please enter address",
                            },
                            gender:{
                                required: "Please Select gender",
                            },
                            image: {
                                required: "Please upload image",
                            },
                            country:{
                                required:"Please Select country",
                            },
                            state:{
                                required:"Please Select state",
                            },
                            city:{
                                required:"Please Select city",
                            },
                            "hobbies[]":{
                                required:"Please select at least two types of spam",
                            },
                        }

                        });
            });





            $('#country').change(function() {
                var countryID = $(this).val();

                console.log(countryID)

                if (countryID) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('get-state-list') }}?country_id=" + countryID,

                        success: function(res) {
                            if (res) {

                                $("#state").empty();
                                $("#state").append('<option>Select</option>');
                                $.each(res, function(key, value) {
                                    $("#state").append('<option value="' + value.id + '">' +
                                        value
                                        .state_name + '</option>');
                                });
                            } else {
                                $("#state").empty();
                            }
                        }
                    });
                } else {
                    $("#state").empty();
                    $("#city").empty();
                }
            }); $('#state').on('change', function() {
                var stateID = $(this).val();

                console.log(stateID)

                if (stateID) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('get-city-list') }}?state_id=" + stateID,
                        success: function(res) {
                            if (res) {
                                $("#city").empty();
                                $.each(res, function(key, value) {
                                    $("#city").append('<option value="' + value.id + '">' +
                                        value
                                        .city_name + '</option>');
                                });

                            } else {
                                $("#city").empty();
                            }
                        }
                    });
                } else {
                    $("#city").empty();
                }

            });


            function add() {
                $('#CompanyForm').trigger("reset");
                $('#CompanyModal').html("Add Company");
                $('#company-modal').modal('show');
                $('#id').val('');
            }                                                                                                    

            function editFunc(id) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('edit-company') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#CompanyModal').html("Edit Company");
                        $('#company-modal').modal('show');
                        $('#id').val(res.id);
                        $('#name').val(res.name);
                        $('#email').val(res.email);
                        $('#address').val(res.address);
                        $('#gender').val(res.gender);
                        $('#image').val(res.image);
                        $('#country').val(res.country);
                        $('#state').val(res.state);
                        $('#city').val(res.city);
                        $('#hobbies').val(res.hobbies);
                    }
                });
            }

            function deleteFunc(id) {
                if (confirm("Delete Record?") == true) {
                    var id = id;
                    $.ajax({
                        type: "POST",
                        url: "{{ url('delete-company') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            var oTable = $('#ajax-crud-datatable').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                }
            }
            $('#CompanyForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('store-company') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $("#company-modal").modal('hide');
                        var oTable = $('#ajax-crud-datatable').dataTable();
                        oTable.fnDraw(false);
                        $("#btn-save").html('Submit');
                        $("#btn-save").attr("disabled", false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
</script>
</html>
