
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

.sidebar {
    width: 250px;
    background-color: #f8f9fa;
    min-height: 100vh;
    padding: 20px;
}

.sidebar .profile {
    text-align: center;
    margin-bottom: 20px;
}

.sidebar .profile img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto; 
    display: block; 
}

.sidebar .profile h2 {
    font-size: 14px;
    font-weight: 600;
    margin-top: 10px;
}

.sidebar .profile p {
    font-size: 14px;
    color: #6c757d;
}

.sidebar .nav-title {
    font-size: 14px;
    text-transform: uppercase;
    margin-bottom: 10px;
    color: #6c757d;
}

.sidebar .nav-item {
    list-style: none;
    margin-bottom: 10px;
}

.sidebar .nav-item a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #333;
    font-size: 15px;
    padding: 10px;
    border-radius: 8px;
    transition: background-color 0.3s;
}

.sidebar .nav-item a:hover {
    background-color: #66c2a6;
    color: #fff;
}

.sidebar .nav-item a svg {
    margin-right: 10px;
}
       .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #66c2a6;
    padding: 10px 20px;
}
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
<div class="navbar">
 <div class="search-bar">
   <input type="text" placeholder="Search...">
</div>
<button class="bg-red-500 px-3 py-1 rounded-md"  onclick="window.location.href='login.php';">Logout</button>
   
 </div>

 </div>
 <div class="flex">
     <!-- Sidebar -->
     <aside class="sidebar">
         <div class="profile">
             <img src="img/img 1.png" alt="Profile Picture"> 
             <h2>NUR AINATUL MARDHIYAH BINTI MOHAMAD</h2>
             <p>2024388929</p>
         </div>


    
         <h3 class="nav-title">Navigation</h3>
            <ul>
                <li class="nav-item">
                    <a href="student.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21H3a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="courses.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-4-4m0 0l4-4m-4 4h16" />
                        </svg>
                        My Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a href="attandance.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3" />
                        </svg>
                        Attendance
                    </a>
                </li>
                <li class="nav-item">
                    <a href="submission.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        Submissions
                    </a>
                </li>
                <li class="nav-item">
                    <a href="contact.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        Contact
                    </a>
                </li>
            </ul>
        </aside>

       
        <!-- Main Content -->
        <div class="main-content p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Contact Information</h1>
    </header>
    <p class="text-gray-600 mb-4">
        If you need any assistance while using the Student Online Form System, you can reach out through the following support channels:
    </p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Email Section -->
        <div class="contact-item bg-white shadow-lg rounded-lg p-6 flex items-center">
            <span class="text-4xl text-blue-500 mr-4">📧</span>
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Email</h2>
                <p class="text-sm text-gray-600">For technical issues or general inquiries, email us at:</p>
                <a href="mailto:support@studentonlineform.com" class="text-blue-500 hover:underline">support@studentonlineform.com</a>
            </div>
        </div>

        <!-- Phone Section -->
        <div class="contact-item bg-white shadow-lg rounded-lg p-6 flex items-center">
            <span class="text-4xl text-green-500 mr-4">📞</span>
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Phone Support</h2>
                <p class="text-sm text-gray-600">Call our support team at +6012-3456789</p>
                <p class="text-sm text-gray-500">(Sunday to Thursday, 10 AM - 5 PM)</p>
            </div>
        </div>

        <!-- Help Center Section -->
        <div class="contact-item bg-white shadow-lg rounded-lg p-6 flex items-center">
            <span class="text-4xl text-red-500 mr-4">📌</span>
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Help Center & FAQs</h2>
                <p class="text-sm text-gray-600">Check out the Help Center on our website for tutorials, troubleshooting guides, and FAQs:</p>
                <a href="https://www.studentonlineform.com/help-center" target="_blank" class="text-blue-500 hover:underline">Visit Help Center</a>
            </div>
        </div>
    </div>
</div>
