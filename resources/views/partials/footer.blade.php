<footer class="bg-indigo-800 text-white pt-16 pb-12">
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

            <!-- Newsletter -->
            <div class="footer-col bg-white/10 p-4 rounded-xl shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-white">Newsletter</h3>
                <p class="text-gray-300 mb-4 text-sm">Recevez mes derniers articles et conseils directement dans votre boîte mail.</p>
                <form class="flex gap-2">
                    <input type="email" placeholder="Votre email"
                        class="flex-grow px-4 py-2 rounded-l-md bg-white/20 border border-white/30 text-white placeholder-gray-200 focus:ring-2 focus:ring-yellow-300 focus:outline-none">
                    <button type="submit"
                        class="bg-yellow-300 px-4 py-2 rounded-r-md font-medium text-gray-900 hover:bg-yellow-400 transition transform hover:scale-105">
                        <i class="ri-send-plane-fill"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</footer>
