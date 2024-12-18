<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Categories</h2>
        <div id="categoriesContainer" class="row mt-4">
            <!-- Categories will be loaded here -->
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Fetch categories using AJAX
            $.ajax({
                url: 'fetch_categories.php', // PHP script that returns categories
                type: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        let categories = response.categories;
                        let categoriesContainer = $('#categoriesContainer');
                        categoriesContainer.empty(); // Clear any existing categories

                        // Loop through the categories and create a card for each
                        categories.forEach(function(category) {
                            let categoryCard = `
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">${category.category_name}</h5>
                                            <p class="card-text">${category.description}</p>
                <a href="category_items.php?category_id=${category.id}" class="btn btn-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                            categoriesContainer.append(categoryCard);
                        });
                    } else {
                        $('#categoriesContainer').html('<p>No categories available.</p>');
                    }
                },
                error: function() {
                    $('#categoriesContainer').html('<p>An error occurred while fetching categories.</p>');
                }
            });
        });
    </script>
</body>
</html>
