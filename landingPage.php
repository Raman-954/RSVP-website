<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventTrack - Manage Your Event Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <nav class="bg-indigo-900 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
            <img src="event.gif" alt="Event Logo" class="h-12 md:h-16 w-auto">
                <span class="font-bold text-xl">RSVP Events</span>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="#features" class="hover:text-indigo-200 transition">Features</a>
                <a href="#how-it-works" class="hover:text-indigo-200 transition">How It Works</a>
                <a href="#testimonials" class="hover:text-indigo-200 transition">Testimonials</a>
            </div>
            <div class="flex space-x-3">
            <a href="login.php" class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-100 transition">Login</a>
            <a href="signup.php" class="bg-indigo-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-400 transition">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-indigo-600 text-white py-20 relative">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row items-center">
        <!-- Text Content -->
        <div class="md:w-1/2 mb-10 md:mb-0">
          <h1 class="text-4xl md:text-5xl font-bold mb-6">Simplify Your Event Management</h1>
          <p class="text-xl mb-8">Easily track attendance, send notifications, and manage your events in one place.</p>
          <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <button class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-medium hover:bg-indigo-100 transition text-lg">
              Get Started
            </button>
            <button 
              onclick="openVideoModal()" 
              class="bg-transparent border-2 border-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition text-lg">
              See Demo
            </button>
          </div>
        </div>

        <!-- Image -->
        <div class="md:w-1/2">
          <img src="https://addyevents.in/wp-content/uploads/2024/08/corporate-events.jpg" alt="Event management dashboard" class="rounded-lg shadow-xl">
        </div>
      </div>
    </div>

    <!-- Video Modal -->
    <div id="videoModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-75 flex items-center justify-center p-4">
  <div class="bg-white rounded-lg overflow-hidden w-full max-w-3xl shadow-lg">
    <!-- Modal Header -->
    <div class="flex justify-between items-center bg-indigo-600 text-white px-4 py-2">
      <h3 class="text-lg font-semibold">Demo Video</h3>
      <button onclick="closeVideoModal()" class="text-white text-2xl font-bold">&times;</button>
    </div>
    <!-- Video Element -->
    <div class="w-full">
      <video id="demoVideo" class="w-full" controls>
        <source src="demo1.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
  </div>
</div>
  </section>


    <!-- Features Section -->
    <section id="features" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Why Choose EventTrack?</h2>
                <p class="text-gray-600 text-xl max-w-2xl mx-auto">Our platform makes it easy to manage event attendance with powerful features.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="bg-indigo-100 text-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-user-check text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Attendance Tracking</h3>
                    <p class="text-gray-600">Mark your status as attending, maybe, or can't go with just one click. Keep track of who's coming to your events easily.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="bg-indigo-100 text-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-bell text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Email Notifications</h3>
                    <p class="text-gray-600">Get timely reminders about upcoming events. Never miss an important event again with our notification system.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="bg-indigo-100 text-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Event Management</h3>
                    <p class="text-gray-600">Create, edit, and manage all your events in one centralized dashboard. Complete control at your fingertips.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">How It Works</h2>
                <p class="text-gray-600 text-xl max-w-2xl mx-auto">Three simple steps to get started with EventTrack.</p>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-center">
                <!-- Step 1 -->
                <div class="text-center mb-10 md:mb-0">
                    <div class="bg-indigo-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h3 class="text-xl font-bold mb-2">Create an Account</h3>
                    <p class="text-gray-600 max-w-xs mx-auto">Sign up and create your profile in just a few minutes.</p>
                </div>
                
                <div class="hidden md:block">
                    <i class="fas fa-arrow-right text-2xl text-indigo-300"></i>
                </div>
                
                <!-- Step 2 -->
                <div class="text-center mb-10 md:mb-0">
                    <div class="bg-indigo-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h3 class="text-xl font-bold mb-2">Create or Join Events</h3>
                    <p class="text-gray-600 max-w-xs mx-auto">Add your own events or get invited to others.</p>
                </div>
                
                <div class="hidden md:block">
                    <i class="fas fa-arrow-right text-2xl text-indigo-300"></i>
                </div>
                
                <!-- Step 3 -->
                <div class="text-center">
                    <div class="bg-indigo-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h3 class="text-xl font-bold mb-2">Manage Attendance</h3>
                    <p class="text-gray-600 max-w-xs mx-auto">Respond to invites and receive notifications about upcoming events.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">What Our Users Say</h2>
                <p class="text-gray-600 text-xl max-w-2xl mx-auto">See how EventTrack has helped people organize their events effortlessly.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 ">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8YXZhdGFyfGVufDB8fDB8fHww" alt="User avatar" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Sarah Johnson</h4>
                            <p class="text-gray-500">Event Planner</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"EventTrack has revolutionized how I manage my events. The attendance tracking feature saves me hours of work every week."</p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="flex items-center mb-4">
                        <img src="https://s3.amazonaws.com/37assets/svn/1024-original.1e9af38097008ef9573f03b03ef6f363219532f9.jpg" alt="User avatar" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Michael Chen</h4>
                            <p class="text-gray-500">Community Manager</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"The email notification system ensures all our members are always informed about upcoming meetings. Attendance has improved by 40%!"</p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-2xl transition-transform transform hover:scale-105">
                    <div class="flex items-center mb-4">
                        <img src="https://media.licdn.com/dms/image/v2/D4E03AQEyMNcR8Zvk9g/profile-displayphoto-shrink_400_400/B4EZQckdREHgAg-/0/1735646113112?e=2147483647&v=beta&t=_ATONMcbGg3Z0p_lZPAwNWCktLJ7j1CvBr5G2dakr6I" alt="User avatar" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Jessica Taylor</h4>
                            <p class="text-gray-500">Team Lead</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"I love how easy it is to see who's attending our team events. The interface is intuitive and the 'maybe' status option is really helpful."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-indigo-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Simplify Your Event Management?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Join thousands of satisfied users who are managing their events with ease using EventTrack.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="signup.php" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-medium hover:bg-indigo-100 transition text-lg">Sign Up Free</a>
                <button class="bg-transparent border-2 border-white px-8 py-3 rounded-lg font-medium hover:bg-indigo-500 transition text-lg">Learn More</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About Section -->
                <div>
                    <h3 class="text-xl font-bold mb-4">About RSVP System</h3>
                    <p class="text-blue-200">
                        Our Event RSVP System helps organizations manage event attendance efficiently. 
                        Users can easily register for events, track their participation, and organizers 
                        can monitor attendance in real-time.
                    </p>
                </div>
                
                <!-- Developers Section -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Development Team</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Ashish Kumar
                            <a href="https://www.linkedin.com/in/ashish-kumar-957b82277/" class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Raman Kumar
                            <a href="https://www.linkedin.com/in/raman-kumar-379081297" class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Ritu Raj
                            <a href="https://www.linkedin.com/in/riturazz?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Aman Prakash
                            <a href="https://linkedin.com/in/aman" class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Contact Section -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                    <address class="text-blue-200 not-italic">
                        <p class="mb-2 hover:font-bold">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            Lovely Professional University,
                            Phagwara, Punjab
                        </p>
                        <p class="mb-2 hover:font-bold">
                            <i class="fas fa-phone mr-2"></i>
                            +91 98352-09367
                        </p>
                        <p class="hover:font-bold">
                            <i class="fas fa-envelope mr-2"></i>
                            ashish78337@gmail.com
                        </p>
                    </address>
                </div>
            </div>
            
            <div class="border-t border-blue-800 mt-8 pt-6 text-center text-blue-300">
                <p>&copy; <?php echo date('Y'); ?> Event RSVP System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
    // Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);

        window.scrollTo({
          top: targetElement.offsetTop - 80,
          behavior: 'smooth'
        });
      });
    });

    function openVideoModal() {
    const modal = document.getElementById('videoModal');
    const video = document.getElementById('demoVideo');
    modal.classList.remove('hidden');
    video.currentTime = 0;
    video.play();
}

function closeVideoModal() {
    const modal = document.getElementById('videoModal');
    const video = document.getElementById('demoVideo');
    video.pause();
    video.currentTime = 0;
    modal.classList.add('hidden');
}
    
  </script>
</body>
</html>