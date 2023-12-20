<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa; /* Set a background color if images have transparency */
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 100vh;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .form-container {
            position: absolute;
            z-index: 2; /* Ensure the form is on top of the images */
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            max-width: 100%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="image-container">
        <img src="image/img1.jpg" alt="Image 1" class="background-image" style="opacity: 1;">
        <img src="image/img2.jpg" alt="Image 2" class="background-image">
        <img src="image/img3.jpg" alt="Image 3" class="background-image">
        <img src="image/img4.jpg" alt="Image 4" class="background-image">
        <img src="image/img5.jpg" alt="Image 5" class="background-image">

        <div class="form-container">
            <form class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="mb-4">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const images = document.querySelectorAll('.background-image');
            let index = 0;

            function showImage() {
                images[index].style.opacity = '1';
                setTimeout(hideImage, 500); // display time
                index = (index + 1) % images.length;
            }

            function hideImage() {
                images[index].style.opacity = '0';
                setTimeout(showNextImage, 500); // img delay
            }

            function showNextImage() {
                index = (index + 1) % images.length;
                if (index === 0) {
                    // Reset the index to 0 when reaching the last image
                    showImage();
                } else {
                    showImage();
                }
            }

            showImage(); // Start the animation
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
