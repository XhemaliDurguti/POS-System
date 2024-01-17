<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fetch Data by Input</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

    <form id="dataForm">
        <label for="inputValue">Enter ID:</label>
        <input type="text" id="inputValue" name="inputValue" required>
        <button type="submit">Submit</button>
    </form>

    <div id="result"></div>

    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#dataForm').submit(function(e) {
                e.preventDefault();

                // Get input value
                var inputValue = $('#inputValue').val();

                // Fetch data using AJAX
                $.ajax({
                    url: 'getproduct.php',
                    type: 'get',
                    data: {
                        id:barcode
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Display the fetched data
                        $('#result').html('<p>ID: ' + data.id + '</p><p>Name: ' + data.name + '</p><p>Age: ' + data.age + '</p>');
                    },
                    error: function() {
                        alert('Error fetching data.');
                    }
                });
            });
        });
    </script>

</body>

</html>