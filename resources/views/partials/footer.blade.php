<footer class="bg-gray-800 text-white pt-16 pb-12">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            <!-- Logo + description + social -->
            <div class="footer-col flex flex-col justify-between">
                <div>
                    <a href="#" class="text-3xl font-['Pacifico'] mb-4 inline-block text-white">CS-Dev</a>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Développeur web et mobile créant des expériences numériques modernes et interactives.
                    </p>
                    <div class="flex space-x-3">
                        
                        <a href="{{ $user->facebook_link }}" target="_blank"
                            class="w-10 h-10 flex items-center justify-center bg-white/20 hover:bg-white/40 rounded-full transition transform hover:scale-110">
                            <i class="ri-facebook-fill"></i>
                        </a>
                        
                        @if($user->linkedin_link)
                        <a href="{{ $user->linkedin_link }}" target="_blank"
                            class="w-10 h-10 flex items-center justify-center bg-white/20 hover:bg-white/40 rounded-full transition transform hover:scale-110">
                            <i class="ri-linkedin-fill"></i>
                        </a>
                        @endif
                        @if($user->github_link)
                        <a href="{{ $user->github_link }}" target="_blank"
                            class="w-10 h-10 flex items-center justify-center bg-white/20 hover:bg-white/40 rounded-full transition transform hover:scale-110">
                            <i class="ri-github-fill"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Liens rapides -->
            <div class="footer-col bg-white/10 p-4 rounded-xl shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-white">Liens rapides</h3>
                <ul class="space-y-2">
                    <li><a href="#accueil" class="hover:text-yellow-300 transition">Accueil</a></li>
                    <li><a href="#a-propos" class="hover:text-yellow-300 transition">À propos</a></li>
                    <li><a href="#projets" class="hover:text-yellow-300 transition">Projets</a></li>
                    <li><a href="#blog" class="hover:text-yellow-300 transition">Blog</a></li>
                    <li><a href="#contact" class="hover:text-yellow-300 transition">Contact</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="footer-col bg-white/10 p-4 rounded-xl shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-white">Services</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-yellow-300 transition">Développement Web</a></li>
                    <li><a href="#" class="hover:text-yellow-300 transition">Applications Mobiles</a></li>
                    <li><a href="#" class="hover:text-yellow-300 transition">E-commerce</a></li>
                    <li><a href="#" class="hover:text-yellow-300 transition">Consulting</a></li>
                </ul>
            </div>

            <!-- Contact rapide -->
            <div class="footer-col bg-white/10 p-4 rounded-xl shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-white">Contact</h3>
                <ul class="space-y-3 text-gray-300 text-sm">
                    <li class="flex items-center gap-2">
                        <i class="ri-mail-line text-yellow-300"></i>
                        <span>{{$user->email}}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="ri-phone-line text-yellow-300"></i>
                        <span>{{ $user->tel }}</span>
                    </li>
                    <li class="mt-4">
                        <a href="#contact"
                            class="inline-block bg-yellow-300 text-gray-900 px-4 py-2 rounded-md font-medium hover:bg-yellow-400 transition">
                            M'envoyer un message
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>
