@extends('layouts.app')

@section('title', 'Contact Us - Grand Aveline')

@section('content')
    <!-- Contact Form Section -->
    <main class="flex-grow flex items-center justify-center p-4 min-h-screen" data-aos="zoom-in">
        <div class="container mx-auto p-6 max-w-2xl">
            <div class="bg-white p-8 rounded-2xl shadow-2xl flex flex-col bg-opacity-90">
                <!-- Contact Details -->
                <div class="mb-8 text-center" data-aos="fade-up">
                    <h1 class="text-4xl font-bold mb-4 text-[#451a03]" style="font-family: Raleway, serif;">Contact Us</h1>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        We'd love to hear from you! Whether you have questions, feedback, or need assistance, feel free to reach out to us. Our team is here to help and respond as quickly as possible.
                    </p>
                    <div class="flex justify-center items-center mb-4">
                        <i class="fas fa-phone-alt text-[#451a03] mr-3"></i>
                        <p class="text-gray-700">+62 XXX XXX </p>
                    </div>
                    <div class="flex justify-center items-center mb-4">
                        <i class="fas fa-envelope text-[#451a03] mr-3"></i>
                        <a href="mailto:kadangkiding@gmail.com" class="text-gray-700">kadangkiding@gmail.com</a>
                    </div>
                </div>

                <!-- Social Media Icons -->
                <div class="flex justify-center space-x-6 mt-6">
                    <a href="#" class="text-[#451a03] text-2xl hover:text-[#ea580c]"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-[#451a03] text-2xl hover:text-[#ea580c]"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-[#451a03] text-2xl hover:text-[#ea580c]"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </main>
@endsection
