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

<style>
    #stateData>ul {
        list-style: none;
        margin: 0px;
        padding: 0 0 10px 0;
    }
    .data:hover{
        color:blue;
        cursor: pointer;
        background-color: aqua;
        text-transform: uppercase;
        padding: 5px !important;
    }
</style>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center text-primary">Live Search Using Ajax</h4>
            </div>
            <div class="card-body">
                <form action="javascript:void(0)" id="formVal">


                    <div class="form-group">
                        <label for="">Search State</label>
                        <input type="text" name="state" data-id="" id="state" class="form-control">
                    </div>
                    <div id="stateData"></div>

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
    $('#state').on('keyup', function() {
        $('#stateData').html('')
        $('#stateData').show();
        let keyword = $(this).val()
        if (keyword !== "") {
            $.ajax({
                type: "GET",
                url: "main.php",
                data: {
                    'keyword': keyword
                },
                success: function(result) {
                    // console.log(result)
                    let html = "";
                    $(JSON.parse(result)).each(function(index, val) {
                        html += `<ul><li class="data" data-id="${val.id}">${val.name}</li></ul>`;
                    })
                    $('#stateData').html(html)
                }
            });
        }
    })

    $(document).on('click', ".data", function() {
        let getData = $(this).html()
        let getId = $(this).data('id')
        $('#state').val(getData);
        $('#state').attr("data-id", getId)
        $('#stateData').html('');
        $('#stateData').hide();

    })

    function formsubmit(e) {
        e.preventDefault
        let form = $('#formVal')
        let formData = form.serialize();
        console.log(formData);
    }
</script>