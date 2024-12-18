<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Selecao</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="UserProfile.php">Profile</a></li>
              <li><a href="/LOGIN/Sign-in.php">Log-out</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>


    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div id="hero-carousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

        <!-- Slide 1 -->
        <div class="carousel-item active">
  <div class="carousel-container">
    <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Courier and Joy Ride</span></h2>
    <p class="animate__animated animate__fadeInUp">Experience the convenience of reliable courier services and the thrill of joyful rides. Whether you're sending parcels or enjoying a ride, we've got you covered with fast, secure, and enjoyable service.</p>
    <a href="BookingForDelivery.php" class="btn-get-started animate__animated animate__fadeInUp scrollto">Book Now</a>
  </div>
</div>

      


      </div>

      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
      </svg>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>About</h2>
    <p>Who We Are</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
        <p>
          We are dedicated to providing seamless courier services and exciting joy ride experiences. With a commitment to excellence, we aim to bring convenience and fun to your everyday life.
        </p>
        <ul>
          <li><i class="bi bi-check2-circle"></i> <span>Reliable and secure delivery services you can trust.</span></li>
          <li><i class="bi bi-check2-circle"></i> <span>Thrilling joy ride options for an unforgettable experience.</span></li>
          <li><i class="bi bi-check2-circle"></i> <span>Customer-focused solutions tailored to your needs.</span></li>
        </ul>
      </div>

      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <p>Whether you're sending parcels or seeking a ride, we combine innovation and reliability to deliver top-tier services. Our team is committed to making your journey smooth and enjoyable every step of the way.</p>
        <a href="#" class="read-more"><span>Learn More</span><i class="bi bi-arrow-right"></i></a>
      </div>

    </div>

  </div>

</section>

    <!-- Features Section -->
    <section id="features" class="features section">

  <div class="container">

    <ul class="nav nav-tabs row d-flex" data-aos="fade-up" data-aos-delay="100">
      <li class="nav-item col-3">
        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
          <i class="bi bi-truck"></i>
          <h4 class="d-none d-lg-block">Reliable Courier Services</h4>
        </a>
      </li>
      <li class="nav-item col-3">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
          <i class="bi bi-bicycle"></i>
          <h4 class="d-none d-lg-block">Express Delivery Options</h4>
        </a>
      </li>
      <li class="nav-item col-3">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
          <i class="bi bi-star"></i>
          <h4 class="d-none d-lg-block">Joy Rides for All</h4>
        </a>
      </li>
      <li class="nav-item col-3">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4">
          <i class="bi bi-geo-alt"></i>
          <h4 class="d-none d-lg-block">Seamless Navigation</h4>
        </a>
      </li>
    </ul><!-- End Tab Nav -->

    <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

      <div class="tab-pane fade active show" id="features-tab-1">
        <div class="row">
          <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
            <h3>Dependable Delivery Services Tailored to Your Needs</h3>
            <p class="fst-italic">
              We ensure your packages are delivered safely and on time with our trusted courier services.
            </p>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span>Fast and secure delivery for your parcels.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Real-time tracking to keep you informed.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Affordable solutions for businesses and individuals.</span></li>
            </ul>
            <p>
              Experience a hassle-free courier service designed to prioritize your convenience and satisfaction.
            </p>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 text-center">
            <img src="assets/img/courier-1.jpg" alt="Reliable Courier Services" class="img-fluid">
          </div>
        </div>
      </div><!-- End Tab Content Item -->

      <div class="tab-pane fade" id="features-tab-2">
        <div class="row">
          <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
            <h3>Fast and Flexible Express Deliveries</h3>
            <p>
              Need it delivered quickly? Our express services are designed to get your packages where they need to be, fast.
            </p>
            <p class="fst-italic">
              From urgent documents to last-minute gifts, we deliver with speed and efficiency.
            </p>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span>Same-day and next-day delivery options available.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Special handling for fragile or time-sensitive items.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Reliable express couriers for peace of mind.</span></li>
            </ul>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 text-center">
            <img src="assets/img/courier-2.jpg" alt="Express Delivery Options" class="img-fluid">
          </div>
        </div>
      </div><!-- End Tab Content Item -->

      <div class="tab-pane fade" id="features-tab-3">
        <div class="row">
          <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
            <h3>Unforgettable Joy Rides for Everyone</h3>
            <p>
              Escape the ordinary with our thrilling joy rides. Explore new destinations and make lasting memories.
            </p>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span>Exciting routes through scenic landscapes.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Safe and well-maintained vehicles for every ride.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Perfect for families, friends, or solo adventurers.</span></li>
            </ul>
            <p class="fst-italic">
              Make every moment count with our specially designed joy ride packages.
            </p>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 text-center">
            <img src="assets/img/joyride-1.jpg" alt="Joy Rides" class="img-fluid">
          </div>
        </div>
      </div><!-- End Tab Content Item -->

      <div class="tab-pane fade" id="features-tab-4">
        <div class="row">
          <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
            <h3>Navigate Your Way with Ease</h3>
            <p>
              Our advanced navigation tools ensure you always find the fastest, safest routes to your destination.
            </p>
            <p class="fst-italic">
              From package delivery to joy rides, enjoy seamless navigation with our technology.
            </p>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span>Real-time location updates for convenience.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Efficient route planning to save time and effort.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>User-friendly systems for stress-free experiences.</span></li>
            </ul>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 text-center">
            <img src="assets/img/navigation.jpg" alt="Seamless Navigation" class="img-fluid">
          </div>
        </div>
      </div><!-- End Tab Content Item -->

    </div>

  </div>

</section><!-- /Features Section -->


   <!-- Call To Action Section -->
<section id="call-to-action" class="call-to-action section dark-background">

<div class="container">

  <div class="row" data-aos="zoom-in" data-aos-delay="100">
    <div class="col-xl-9 text-center text-xl-start">
      <h3>Join Our Mission</h3>
      <p>Take the first step toward making a difference. Partner with us to create impactful solutions and build a brighter future for everyone.</p>
    </div>
    <div class="col-xl-3 cta-btn-container text-center">
      <a class="cta-btn align-middle" href="#">Get Started</a>
    </div>
  </div>

</div>

</section>

    <!-- Services Section -->
<section id="services" class="services section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Our Services</h2>
  <p>Discover what we offer to meet your needs</p>
</div><!-- End Section Title -->

<div class="container">

  <div class="row gy-4">

    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
      <div class="service-item position-relative">
        <div class="icon">
          <i class="bi bi-cash-stack" style="color: #0dcaf0;"></i>
        </div>
        <a href="service-details.html" class="stretched-link">
          <h3>Financial Planning</h3>
        </a>
        <p>We help you manage your finances, providing customized strategies for growth and security tailored to your goals.</p>
      </div>
    </div><!-- End Service Item -->

    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
      <div class="service-item position-relative">
        <div class="icon">
          <i class="bi bi-calendar4-week" style="color: #fd7e14;"></i>
        </div>
        <a href="service-details.html" class="stretched-link">
          <h3>Project Scheduling</h3>
        </a>
        <p>Streamline your projects with our efficient scheduling solutions, ensuring on-time delivery and seamless workflows.</p>
      </div>
    </div><!-- End Service Item -->

    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
      <div class="service-item position-relative">
        <div class="icon">
          <i class="bi bi-chat-text" style="color: #20c997;"></i>
        </div>
        <a href="service-details.html" class="stretched-link">
          <h3>Consultation Services</h3>
        </a>
        <p>Get expert advice and actionable insights to tackle challenges and unlock new opportunities for your business.</p>
      </div>
    </div><!-- End Service Item -->

    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
      <div class="service-item position-relative">
        <div class="icon">
          <i class="bi bi-credit-card-2-front" style="color: #df1529;"></i>
        </div>
        <a href="service-details.html" class="stretched-link">
          <h3>Payment Solutions</h3>
        </a>
        <p>Experience seamless transactions with our secure and user-friendly payment processing services.</p>
      </div>
    </div><!-- End Service Item -->

    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
      <div class="service-item position-relative">
        <div class="icon">
          <i class="bi bi-globe" style="color: #6610f2;"></i>
        </div>
        <a href="service-details.html" class="stretched-link">
          <h3>Global Networking</h3>
        </a>
        <p>Expand your reach with our global networking services, connecting you to partners and clients worldwide.</p>
      </div>
    </div><!-- End Service Item -->

    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
      <div class="service-item position-relative">
        <div class="icon">
          <i class="bi bi-clock" style="color: #f3268c;"></i>
        </div>
        <a href="service-details.html" class="stretched-link">
          <h3>Time Management</h3>
        </a>
        <p>Maximize productivity with our time management solutions, designed to keep you focused on what matters most.</p>
      </div>
    </div><!-- End Service Item -->

  </div>

</div>

</section><!-- /Services Section -->

  
   
    <!-- Pricing Section -->
    <section id="faq" class="faq section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>FAQs</h2>
    <p>Get to Know Us Better</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-12">
        <div class="accordion" id="faqAccordion">

          <!-- FAQ Item 1 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="faq-heading-1">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-1" aria-expanded="true" aria-controls="faq-collapse-1">
                What is your vision?
              </button>
            </h2>
            <div id="faq-collapse-1" class="accordion-collapse collapse show" aria-labelledby="faq-heading-1" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Our vision is to empower individuals and businesses by providing innovative and accessible solutions that simplify everyday challenges and inspire growth.
              </div>
            </div>
          </div>
          <!-- End FAQ Item 1 -->

          <!-- FAQ Item 2 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="faq-heading-2">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-2" aria-expanded="false" aria-controls="faq-collapse-2">
                How do you operate?
              </button>
            </h2>
            <div id="faq-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-heading-2" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                We operate through a combination of dedicated teams, cutting-edge technology, and customer-focused approaches to ensure the best experience for our users and partners.
              </div>
            </div>
          </div>
          <!-- End FAQ Item 2 -->

          <!-- FAQ Item 3 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="faq-heading-3">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-3" aria-expanded="false" aria-controls="faq-collapse-3">
                What industries do you serve?
              </button>
            </h2>
            <div id="faq-collapse-3" class="accordion-collapse collapse" aria-labelledby="faq-heading-3" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                We cater to a variety of industries including technology, healthcare, education, e-commerce, and finance, tailoring our services to meet specific needs.
              </div>
            </div>
          </div>
          <!-- End FAQ Item 3 -->

          <!-- FAQ Item 4 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="faq-heading-4">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-4" aria-expanded="false" aria-controls="faq-collapse-4">
                How can I contact your team?
              </button>
            </h2>
            <div id="faq-collapse-4" class="accordion-collapse collapse" aria-labelledby="faq-heading-4" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                You can reach us through our contact page, email, or customer support hotline. We're always here to assist you with any inquiries or feedback.
              </div>
            </div>
          </div>
          <!-- End FAQ Item 4 -->

          <!-- FAQ Item 5 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="faq-heading-5">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-5" aria-expanded="false" aria-controls="faq-collapse-5">
                What sets you apart from competitors?
              </button>
            </h2>
            <div id="faq-collapse-5" class="accordion-collapse collapse" aria-labelledby="faq-heading-5" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Our commitment to innovation, personalized service, and an unwavering focus on customer satisfaction distinguishes us from others in the industry.
              </div>
            </div>
          </div>
          <!-- End FAQ Item 5 -->

        </div>
      </div>
    </div>
  </div>
</section><!-- /Faq Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Our Hardworking Team</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>CTO</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

   
    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>A108 Adam Street, New York, NY 535022</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>+1 5589 55488 55</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>info@example.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer dark-background">
  <div class="container">

    <!-- Site Name -->
    <h3 class="sitename">Selecao</h3>

    <!-- Footer Description -->
    <p>At Selecao, we are committed to delivering top-tier solutions with an unwavering focus on quality and customer satisfaction. Join us on our journey to make a meaningful impact.</p>

    <!-- Social Media Links -->
    <div class="social-links d-flex justify-content-center">
      <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
      <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
      <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
      <a href="#" aria-label="Skype"><i class="bi bi-skype"></i></a>
      <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
    </div>

    <!-- Copyright & Credits -->
    <div class="container">
      <div class="copyright text-center">
        <span>&copy; <strong class="px-1 sitename">Selecao</strong> 2024. All Rights Reserved.</span>
      </div>
      <div class="credits text-center">
        
      </div>
    </div>

  </div>
</footer>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>