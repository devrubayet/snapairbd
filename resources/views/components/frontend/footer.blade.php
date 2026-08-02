<section>
        <footer class="relative text-gray-800">
            <!-- Background Pattern -->
            <div style="background-image: url('./img/bg1.png');"
                class="absolute inset-1 bg-no-repeat bg-cover  bg-bottom  opacity-90"></div>

            <!-- Overlay -->
            <div class="absolute inset-0 bg-linear-to-b from-transparent to-[rgb(30,27,75)]"></div>

            <!-- Content -->
            <div
                class="relative max-w-7xl mx-auto px-6 py-16 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10 text-sm">

                <!-- Column 1 -->
                <div>
                    <h3 class="text-purple-800 font-semibold mb-4 uppercase tracking-wide">About Us</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-purple-700">About SnapAir</a></li>
                        <li><a href="#" class="hover:text-purple-700">Trade License No:
                                {{ $settings->trade_license }}</a></li>
                        <li><a href="#" class="hover:text-purple-700">Civil Aviation Certificate No:
                                <b>{{ $settings->civil_no }}</b></a></li>

                    </ul>
                </div>

                <!-- Column 2 -->
                <div>
                    <h3 class="text-purple-800 font-semibold mb-4 uppercase tracking-wide">Book & Manage</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-purple-700">Visa Track</a></li>
                        <li><a href="#" class="hover:text-purple-700">Visa Reservation Schedule</a></li>
                    </ul>
                </div>

                <!-- Column 3 -->
                <div>
                    <h3 class="text-purple-800 font-semibold mb-4 uppercase tracking-wide">Where We Offer</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-purple-700">Route Map</a></li>
                        <li><a href="#" class="hover:text-purple-700">Partner Airlines</a></li>
                        <li><a href="#" class="hover:text-purple-700">Popular Flights</a></li>
                    </ul>
                </div>

                <!-- Column 4 -->
                <div>
                    <h3 class="text-purple-800 font-semibold mb-4 uppercase tracking-wide">Prepare To Travel</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-purple-700">Baggage Guidelines</a></li>
                        <li><a href="#" class="hover:text-purple-700">Airport Information</a></li>
                        <li><a href="#" class="hover:text-purple-700">Travel Tips</a></li>
                        <li><a href="#" class="hover:text-purple-700">Medical Assistance</a></li>
                        <li><a href="#" class="hover:text-purple-700">Travelling with Pets</a></li>
                    </ul>
                </div>

                <!-- Column 5 (App Section) -->
                <div>
                    <h3 class="text-purple-800 font-semibold mb-4 uppercase tracking-wide">SnapAirBD</h3>
                    <p class="mb-4 text-gray-600"> book and manage flights on the go.</p>
                    <div class="space-y-3">
                        <img src="img/add.png" class="h-10" alt="App Store">
                        <img src="img/add.png" class="h-10" alt="Google Play">
                    </div>
                </div>

            </div>

            <!-- Bottom Bar -->
            <div class="relative border-t border-gray-300 mt-10">
                <div
                    class="max-w-7xl mx-auto px-6 py-6 text-xs text-white flex flex-col md:flex-row justify-between gap-4">
                    <p>© 2026 Your Airline. All Rights Reserved.</p>
                    <div class="flex gap-6">
                        <a href="#" class="hover:text-purple-700">Privacy Policy</a>
                        <a href="#" class="hover:text-purple-700">Terms of Service</a>
                        <a href="#" class="hover:text-purple-700">Contact</a>
                    </div>
                </div>
            </div>
        </footer>

    </section>