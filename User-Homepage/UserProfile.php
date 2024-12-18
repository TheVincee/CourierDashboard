<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="UserProfileCSS.css">
  <title>User Profile with Password</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <!-- Profile Card -->
      <div class="card profile-card p-4">
        <h2 class="text-center mb-4">User Profile</h2>
        <form id="createProfileForm" enctype="multipart/form-data">
          <!-- Profile Picture -->
          <div class="mb-3 text-center">
            <img src="https://via.placeholder.com/120" alt="Profile Picture" class="rounded-circle" id="profileImage">
            <input type="file" name="profile_picture" class="form-control d-none" id="uploadImage" accept="image/*">
            <label for="uploadImage" class="btn btn-outline-primary mt-2">Upload Picture</label>
          </div>

          <!-- Profile Fields in Columns -->
          <div class="row">
            <!-- Full Name -->
            <div class="col-md-6 mb-3">
              <label for="fullName" class="form-label">Full Name</label>
              <input type="text" name="fullName" class="form-control" id="fullName" placeholder="Enter your full name" required>
            </div>
            <!-- Email -->
            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
          </div>

          <div class="row">
            <!-- Phone -->
            <div class="col-md-6 mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="tel" name="phone" class="form-control" id="phone" placeholder="Enter your phone number" required>
            </div>
            <!-- Location -->
            <div class="col-md-6 mb-3">
              <label for="location" class="form-label">Location</label>
              <input type="text" name="location" class="form-control" id="location" placeholder="Enter your location" required>
            </div>
          </div>

          <div class="mb-3">
            <!-- About Me -->
            <label for="aboutMe" class="form-label">About Me</label>
            <textarea class="form-control" name="aboutMe" id="aboutMe" rows="3" placeholder="Tell us about yourself" required></textarea>
          </div>

          <!-- Password Fields -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="currentPassword" class="form-label">Current Password</label>
              <input type="password" name="currentPassword" class="form-control" id="currentPassword" placeholder="Enter your current password" required>
            </div>

            <div class="col-md-6 mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <input type="password" name="newPassword" class="form-control" id="newPassword" placeholder="Enter a new password" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm New Password</label>
            <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Confirm your new password" required>
          </div>

          <!-- Save Profile Button -->
          <button type="submit" class="btn btn-primary w-100">Save Profile</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$('#createProfileForm').on('submit', function (e) {
  e.preventDefault();

  // Password validation
  const newPassword = $('#newPassword').val();
  const confirmPassword = $('#confirmPassword').val();
  if (newPassword !== confirmPassword) {
    alert('New password and confirmation do not match!');
    return;
  }

  // Profile image validation (optional)
  const profileImage = $('#uploadImage')[0].files[0];
  if (!profileImage) {
    alert('Please upload a profile picture!');
    return;
  }

  // Create FormData object
  const formData = new FormData(this);

  // AJAX request
  $.ajax({
    url: 'insert_profile.php', // Correct path to your PHP file
    method: 'POST',
    data: formData,
    processData: false, // Prevents jQuery from processing the data
    contentType: false, // Ensures the correct content type is sent
    success: function (response) {
      let jsonResponse;

      try {
        // Parse JSON response
        jsonResponse = JSON.parse(response);
      } catch (error) {
        console.error('JSON parsing error:', error, response);
        alert('Server returned an invalid response.');
        return;
      }

      // Check response status
      if (jsonResponse.status === 'success') {
        alert(jsonResponse.message);
        // Optionally clear the form or redirect
        $('#createProfileForm')[0].reset();
        $('#profileImage').attr('src', ''); // Reset profile picture
      } else {
        alert('Error: ' + jsonResponse.message);
      }
    },
    error: function (xhr, status, error) {
      console.error('AJAX request failed:', xhr.responseText, status, error);
      alert('An error occurred while processing your request. Please try again.');
    }
  });
});
</script>
</body>
</html>
