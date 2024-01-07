<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Activity Details</title>
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
        use App\Models\User;
        use App\Models\Assign;
        use App\Models\Attachment;

        $activityType = Assign::getActTypeName($activity->activity_type);
        $proof = Attachment::where('record_id', $activity->id)->where('type', 2)->first();
        $createdBy = User::find($activity->created_by);

    ?>

    <header class="bg-dark text-white">
        <h2 style="color: white">View {{$activityType}} Activity Details | Complaint #{{$complain->id}}</h2>
    </header>

    <section class="container">
        <h2>Complaint Against {{($complain->institute_id == 1)? 'Wildlife' : 'Environmental'}} Crime</h2>
        <div class="card" style="padding: 1rem;">

            <h5>Complaint Info</h5>
            <div class="row">
                <div class="col-sm-12">
                    <label>{{$complain->problem_name}}</label>
                    <p>{{$complain->txtcomplaint_remarks}}</p>
                </div>
            </div>

            <h5>Action Info</h5>
            <div class="row">
                <div class="col-sm-6">
                    <label>Description</label>
                    <p>{{$activity->description}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label>Type : {{$activityType}}</label>
                </div>
                <div class="col-sm-6">
                    <label>Created Date : {{$activity->created_at}}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label>{{$activityType}} By : {{$createdBy->name}}</label>
                </div>
                @if($activity->assigned_to)
                    <?php $assignedTo = User::find($activity->assigned_to); ?>
                    <div class="col-sm-6">
                        <label>{{$activityType}} To : {{$assignedTo->name}}</label>
                    </div>
                @endif
            </div>

            @if($proof)
                <h5 style="margin-top: 20px;">Proof</h5>

                <?php
                    $attachments = json_decode($proof->attachments);
                ?>
                <div class="row">
                    @foreach($attachments as $attachment)
                        <div class="col-sm-4">
                            <img src="{{asset('images/proof/'.$attachment)}}" width="100%" />
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

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
