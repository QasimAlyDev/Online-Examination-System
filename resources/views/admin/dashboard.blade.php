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
                    <!-- Modal -->
                    <div class="modal fade " id="addSubjectModel" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="addSubject">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Subject</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="subject-name" class="col-form-label">Subject Name:</label>
                                            <input type="text" class="form-control" id="subject-name" name="subject"
                                                required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subjects</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $subject )
                                
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td>{{ $subject->subject }}</td>
                                <td>Edit</td>
                                <td>Delete</td>
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
</script>
@endsection

