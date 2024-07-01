@extends('layout.headerSidebar-layout')

@section('examDashboard')

<div class="pagetitle">
    <h1>Exams</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item">Exams</li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addExamModel">
                Add Exam
            </button>
            <div class="card">
                <div class="card-body">
                    <!-- Exam Add Modal -->
                    <div class="modal fade " id="addExamModel" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add Exam</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="addExam">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="exam_name" name="exam_name"
                                                placeholder="Enter Exam Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" name="subject_id" aria-label="subject select"
                                                required>
                                                <option value="" selected disabled>Open this select menu</option>
                                                @if (count($subjects) > 0)
                                                @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="time">Time (Hours:Minutes)</label>
                                            <input type="text" id="time" name="time" class="form-control" placeholder="HH:MM" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" name="date" class="form-control" required
                                                min="{{ date('Y-m-d') }}">
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
                                <th>Exam Name</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Time Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                            <tr>
                                <td>{{ $exam->id }}</td>
                                <td>{{ $exam->exam_name }}</td>
                                <td>{{ $exam->subjects[0]['subject'] }}</td>
                                <td>{{ $exam->date }}</td>
                                <td>{{ $exam->time }} Hrs</td>
                                <td>
                                    <a href="#" class="text-primary me-3 editButton" data-id=""
                                        data-exam="" title="Edit Exam">
                                        <i class="ri-edit-2-line fs-5"></i>
                                    </a>
                                    <a href="#" class="text-danger me-3 deleteButton" data-id=""
                                        data-exam="" title="Delete Exam">
                                        <i class="ri-delete-bin-2-line fs-5"></i>
                                    </a>
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
    $(document).ready(function(){
        $("#addExam").submit(function(e){
            e.preventDefault();

            // Format the time input to HH:MM format
            var timeInput = $("#time").val().trim();
            var hours = timeInput.split(':')[0];
            var minutes = timeInput.split(':')[1];
            var formattedTime = hours.padStart(2, '0') + ':' + minutes.padStart(2, '0');

            // Update the input field with formatted time
            $("#time").val(formattedTime);

            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('addExam') }}",
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
                    toastr.error('An error occurred while adding the exam.');
                }
            });
        });
    });
</script>
@endsection
