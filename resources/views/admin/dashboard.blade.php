@extends('layout.headerSidebar-layout')

@section('adminDashboard')

<div class="pagetitle">
    <h1>Subjects</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item">Subjects</li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addSubjectModel">
                Add Subject
            </button>
            <div class="card">
                <div class="card-body">
                    <!-- Subject Add Modal -->
                    <div class="modal fade " id="addSubjectModel" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add Subject</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="addSubject">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="subject-name" class="col-form-label">Subject Name:</label>
                                            <input type="text" class="form-control" id="subject-name" name="subject"
                                                required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subjects</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $subject)
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td>{{ $subject->subject }}</td>
                                <td>
                                    <!-- Edit Icon -->
                                    <a href="#" class="text-primary me-3 editButton" data-id="{{ $subject->id }}"
                                        data-subject="{{ $subject->subject }}" title="Edit Subject"
                                        data-bs-toggle="modal" data-bs-target="#editSubjectModel">
                                        <i class="ri-edit-2-line fs-5"></i>
                                    </a>
                                    <!-- Subject Edit Modal -->
                                    <div class="modal fade " id="editSubjectModel" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Subject</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form id="editSubject">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="subject-name" class="col-form-label">Subject
                                                                Name:</label>
                                                            <input type="text" class="form-control"
                                                                id="edit_subject_name" name="subject">
                                                            <input type="hidden" class="form-control" name="id"
                                                                id="edit_subject_id">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Icon -->
                                    <a href="#" class="text-danger deleteButton" title="Delete Subject"
                                        data-id="{{ $subject->id }}" data-bs-toggle="modal"
                                        data-bs-target="#deleteSubjectModel">
                                        <i class="ri-delete-bin-2-line fs-5"></i>
                                    </a>
                                    <!-- Subject delete Modal -->
                                    <div class="modal fade " id="deleteSubjectModel" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Delete Subject</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form id="deleteSubject">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <p>Are you sure you want to delete this subject?</p>
                                                            <input type="hidden" class="form-control" name="id"
                                                                id="delete_subject_id">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@section('customjs')
<script>
    // Add Subject
    $(document).ready(function(){
        $("#addSubject").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('addSubject') }}",
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    if(data.success == true){
                        toastr.success(data.msg);
                        // Delay the reload to give time for the toastr notification to show
                        setTimeout(function(){
                            location.reload();
                        }, 1300); // Adjust the delay time (in milliseconds) as needed
                    } else {
                        toastr.error(data.msg);
                    }
                },
                error: function(xhr){
                    toastr.error('An error occurred while adding the subject.');
                }
            });
        });
    });

    // Edit Subject

    $(".editButton").click(function(){
        var subject_id = $(this).attr('data-id');
        var subject_name = $(this).attr('data-subject');
        $("#edit_subject_name").val(subject_name);
        $("#edit_subject_id").val(subject_id);
    })

    $("#editSubject").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('editSubject') }}",
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    if(data.success == true){
                        toastr.success(data.msg);
                        // Delay the reload to give time for the toastr notification to show
                        setTimeout(function(){
                            location.reload();
                        }, 1300); // Adjust the delay time (in milliseconds) as needed
                    } else {
                        toastr.error(data.msg);
                    }
                },
                error: function(xhr){
                    toastr.error('An error occurred while adding the subject.');
                }
            });
        });

        // Delete Subject

    $(".deleteButton").click(function(){
        var subject_id = $(this).attr('data-id');
        $("#delete_subject_id").val(subject_id);
    })

    $("#deleteSubject").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('deleteSubject') }}",
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    if(data.success == true){
                        toastr.success(data.msg);
                        // Delay the reload to give time for the toastr notification to show
                        setTimeout(function(){
                            location.reload();
                        }, 1300); // Adjust the delay time (in milliseconds) as needed
                    } else {
                        toastr.error(data.msg);
                    }
                },
                error: function(xhr){
                    toastr.error('An error occurred while adding the subject.');
                }
            });
        });
</script>
@endsection