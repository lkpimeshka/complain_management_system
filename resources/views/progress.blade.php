<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Environmental Crime Complaint System</title>
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

    <header class="bg-dark text-white">
        <h1>Environmental Crime Complaint System</h1>
    </header>

    <section class="container">
        <h2>Submit a Complaint Against Environmental Crime</h2>
        <p>Empowering the public to take action against wildlife, forestry, and environmental crime. Report incidents with evidence through our online and mobile applications.</p>

        <div class="flow-chart d-flex">
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

    <footer class="bg-dark text-white">
        &copy; 2023 Environmental Crime Complaint System
    </footer>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
