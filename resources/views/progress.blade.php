@extends('layouts.app') {{-- Update with your actual layout name, for example, 'app' or another layout you are using --}}

@section('content')
    <header>
        <h1>Wildlife & Forestry Crime Complaint System</h1>
    </header>
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
            padding: 1em 0;
        }

        section {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        .flow-chart {
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .step {
            width: 4cm;
            height: 3cm;
            text-align: center;
            padding: 7px; /* Updated padding to 0.7cm */
            border: 1px solid #ddd;
            border-radius: 4px;
            background: linear-gradient(to bottom right, #BFEFFF, #87CEEB); /* Gradient from very light blue to slightly darker blue */
            position: relative;
            margin-bottom: 3cm; /* Adjust the margin to set the gap between boxes */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* Box shadow with slight increase from first to last box */
        }

        .step:last-child {
            margin-bottom: 0; /* Remove bottom margin for the last box */
        }

        .step:hover {
            background: linear-gradient(to bottom right, #A8D8F8, #70a8cd); /* Change this to a darker shade if needed */
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    <section>
        <h2>Submit a Complaint Against Environmental Crime</h2>
        <p>Empowering the public to take action against wildlife & forestry crime. Report incidents with evidence through our online and mobile applications.</p>

        <div class="flow-chart">
            <div class="step">
                <h3>Step 1</h3>
                <p>Create an account or log in</p>
            </div>
            <div class="step">
                <h3>Step 2</h3>
                <p>Submit your complaint with evidence</p>
            </div>
            <div class="step">
                <h3>Step 3</h3>
                <p>Complaint directed to relevant institution</p>
            </div>
            <div class="step">
                <h3>Step 4</h3>
                <p>Monitor investigation progress</p>
            </div>
        </div>
    </section>

    <footer>
        &copy; Complaint management System
    </footer>
@endsection
