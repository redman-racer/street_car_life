<?php
// Include Globals
require '../config/globals.php';
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<div id="Main_Container">
    <?php include_once '../includes/navigation.php'; ?>
    <div id="content">
        <div id="cs_container">

        </div>
    </div>
</div>
</body>
<footer>
    <script>
        // Garage Javascript Module
        (function () {
            // When the document is loaded
            $('document').ready(function () {
                // Fetch the user's cars
                fetchCars();
            });

            // Function to fetch cars
            function fetchCars() {
                // POST to fetch cars
                $.post('app/ajax-controllers/garageAjax.php', {
                    action: 'fetchCars'
                }, function (data) {
                    // Check for errors
                    if (checkErrors(data)) return false;

                    // For each car
                    data['cars'].forEach(function (car) {
                        // Write Template
                        car_template = '<div id="user_car" class="" data-id="'+ car['car_id'] +'">' +
                                            '<img src="" />' + // TODO set image as car['car_image'] when ready
                                        '</div>';
                        $("#cs_container").append(car_template);
                    })
                });
            }

            // Function to check for errors
            function checkErrors(data) {
                if (data['error'] !== false) {
                    console.log(data['error']);
                    return true;
                } else {
                    return false;
                }
            }
        }());
    </script>
</footer>