<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Crime Progress</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1.5rem 0;
        }

        .step-card {
            flex: 1; /* Equal width for each step */
            text-align: center;
            padding: 1rem;
            border: 1px solid #ddd;
            /* border-radius: 4px; */
            background: linear-gradient(to bottom right, #BFEFFF, #87CEEB);
            /* position: relative; */
            /* margin-right: 2%;  */
            margin-top: 5%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .step-card:hover {
            background: linear-gradient(to bottom right, #A8D8F8, #70a8cd);
        }

        section {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2rem auto;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        .flow-chart {
            display: flex;
            position: relative;
        }

        .step {
            flex: 1; /* Equal width for each step */
            text-align: center;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: linear-gradient(to bottom right, #BFEFFF, #87CEEB);
            position: relative;
            margin-right: 2%; /* Adjust the space between steps */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .step:last-child {
            margin-right: 1px; /* margins  */
        }

        .step:hover {
            background: linear-gradient(to bottom right, #A8D8F8, #70a8cd);
        }

        footer {
            text-align: center;
            padding: 1rem;
            background-color: #333;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <?php
        use App\Models\Status;
        use App\Models\Assign;
        use App\Models\Attachment;
        use Illuminate\Support\Str;

        $statusModel = Status::where('id', $complain->status)->first();
        $evidence = Attachment::where('record_id', $complain->id)->where('type', 1)->first();
        $activityList = Assign::where('complaint_id', $complain->id)->orderBy('id', 'asc')->get();

    ?>

    <header class="bg-dark text-white">
        <h2 style="color: white">View Crime Progress | Complaint #{{$complain->id}}</h2>
    </header>

    <section class="container">
        <h2>Complaint Against {{($complain->institute_id == 1)? 'Wildlife' : 'Environmental'}} Crime</h2>
        <div class="card" style="padding: 1rem;">
            <h5>Complaint Description</h5>
            <p>{{$complain->txtcomplaint_remarks}}</p>

            <h5>Complaint Info</h5>
            <div class="row">
                <div class="col-sm-6">
                    <label>Type : {{$complain->problem_name}}</label>
                </div>
                <div class="col-sm-6">
                    <label>Location : {{$complain->location_name}}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label>Complainer : {{$complain->complainer}}</label>
                </div>
                <div class="col-sm-6">
                    <label>Status : {{$statusModel->name}}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label>Created Date : {{$complain->created_at}}</label>
                </div>
            </div>

            @if($evidence)
                <h5 style="margin-top: 20px;">Evidence</h5>

                <?php
                    $attachments = json_decode($evidence->attachments);
                ?>
                <div class="row">
                    @foreach($attachments as $attachment)
                        <div class="col-sm-4">
                            <img src="{{asset('images/attachments/'.$attachment)}}" width="100%" />
                        </div>
                    @endforeach
                </div>
            @endif
        </div>


        @if(count($activityList) > 0)
            <div class="row" style="margin-top: 10px; text-align: center">
                <div class="col-sm-12">
                    <h5>Complaint Progress</h5>
                </div>
            </div>

            <div class="row">
                @foreach($activityList as $k => $activity)
                    <div class="col-sm-4">
                        <div class="card step-card">
                            <h5>Step {{++$k}} [ {{Assign::getActTypeName($activity->activity_type)}} ]</h5>
                            <p>{{ Str::limit($activity->description, 60, '...') }}</p>
                            <div class="row" style="text-align: right">
                                <div class="col-sm-12">
                                    <a href="{{url('complain/view-action/'.$activity->id)}}" class="btn btn-primary btn-sm" title="View Activity Details"  target="_blank">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <footer class="bg-dark text-white">
        &copy; 2023 Complaint Management System
    </footer>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
