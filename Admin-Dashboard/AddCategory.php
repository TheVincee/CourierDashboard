<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add New Category</h2>
        <form id="addCategoryForm" class="mt-4">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
        </form>
        <div id="responseMessage" class="mt-3"></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#addCategoryForm').on('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            // Serialize form data
            let formData = $(this).serialize();

            // Send data via AJAX
            $.ajax({
                url: 'AddCategs.php', // Ensure this is the correct file path
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Since jQuery will automatically parse the JSON response
                    if (response.status === 'success') {
                        $('#responseMessage').html(
                            '<div class="alert alert-success text-center">' + response.message + '</div>'
                        );
                        $('#addCategoryForm')[0].reset(); // Reset form fields
                    } else {
                        $('#responseMessage').html(
                            '<div class="alert alert-danger text-center">' + response.message + '</div>'
                        );
                    }
                },
                error: function() {
                    $('#responseMessage').html(
                        '<div class="alert alert-danger text-center">An error occurred. Please try again.</div>'
                    );
                }
            });
        });
    });
</script>

</body>
</html>
