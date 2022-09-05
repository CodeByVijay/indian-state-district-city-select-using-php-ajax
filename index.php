<?php
require_once('main.php');
?>
<!doctype html>
<html lang="en">

<head>
    <title>Practice JQuery</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center text-primary">Select State District City</h4>
            </div>
            <div class="card-body">
                <form action="javascript:void(0)" id="formVal">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for=""></label>
                                <select id="state" name="state" class="form-control">
                                    <option value="">Choose State</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($state_query)) {
                                    ?>
                                        <option value="<?= $row['state_id']; ?>"><?= $row['state_title']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for=""></label>
                                <select id="district" name="district" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for=""></label>
                                <select id="city" name="city" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" onclick="formsubmit(this)">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#state').on('change', function() {
            $('#city').html('')
            $('#district').html('')
            let state_id = $(this).val()
            if (state_id !== '') {

                $.ajax({
                    type: "GET",
                    url: "main.php",
                    data: {
                        "state_id": state_id
                    },
                    success: function(result) {
                        let html = '';
                        html += `<option value="">Choose District</option>`;
                        $(JSON.parse(result)).each(function(index, val) {
                            html += `<option value="${val.id}">${val.name}</option>`
                        })
                        $('#district').html(html)

                    }
                });

            }
        })


        $('#district').on('change', function() {
            $('#city').html('')
            let district_id = $(this).val()
            if (district_id !== '') {

                $.ajax({
                    type: "GET",
                    url: "main.php",
                    data: {
                        "district_id": district_id
                    },
                    success: function(result) {
                        let html = '';
                        html += `<option value="">Choose City</option>`;
                        $(JSON.parse(result)).each(function(index, val) {
                            html += `<option value="${val.id}">${val.name}</option>`
                        })
                        $('#city').html(html)

                    }
                });

            }
        })

    });

    function formsubmit(e) {
            e.preventDefault
            let form = $('#formVal') 
            let formData = form.serialize();
            console.log(formData);
        }
</script>