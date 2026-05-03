<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CS-Dev | {{ $projet->title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        #reading-progress { position:fixed;top:0;left:0;height:3px;width:0%;background:linear-gradient(90deg,#667eea,#764ba2);z-index:9999;transition:width .1s ease; }
        .hero-gradient { background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);position:relative;overflow:hidden; }
        .hero-gradient::before { content:'';position:absolute;inset:0;background:url('data:image/svg+xml,<svg width="60" height="60" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="g" width="60" height="60" patternUnits="userSpaceOnUse"><path d="M60 0L0 0 0 60" fill="none" stroke="rgba(255,255,255,0.07)" stroke-width="1"/></pattern></defs><rect width="60" height="60" fill="url(%23g)"/></svg>'); }
        .breadcrumb-item:not(:last-child)::after { content:'›';margin:0 .4rem;color:rgba(255,255,255,.45); }
        .card { transition:transform .3s ease,box-shadow .3s ease; }
        .card:hover { transform:translateY(-4px);box-shadow:0 16px 40px rgba(0,0,0,.1); }
        .tech-badge { transition:transform .2s ease,box-shadow .2s ease; }
        .tech-badge:hover { transform:translateY(-2px) scale(1.05);box-shadow:0 4px 12px rgba(0,0,0,.15); }
        #slide-image { transition:opacity .3s ease,transform .3s ease; }
        .carousel-btn { backdrop-filter:blur(8px);transition:all .2s ease; }
        .carousel-btn:hover { transform:scale(1.1);background:rgba(255,255,255,.95); }
        .fab-container { position:fixed;bottom:2rem;right:2rem;display:flex;flex-direction:column;gap:.75rem;z-index:1000; }
        .fab { width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#667eea,#764ba2);color:white;box-shadow:0 4px 12px rgba(102,126,234,.4);cursor:pointer;transition:all .3s ease; }
        .fab:hover { transform:translateY(-3px) scale(1.08);box-shadow:0 8px 20px rgba(102,126,234,.5); }
        .fab.hidden { opacity:0;visibility:hidden;pointer-events:none; }
        .suggestion-card { transition:transform .3s ease,box-shadow .3s ease; }
        .suggestion-card:hover { transform:translateY(-6px);box-shadow:0 20px 40px rgba(0,0,0,.12); }
        .suggestion-card img { transition:transform .5s ease; }
        .suggestion-card:hover img { transform:scale(1.05); }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 text-slate-900 antialiased">

<div id="reading-progress"></div>
@include('partials.header')

<main class="pt-20">

    {{-- HERO --}}
    <section class="hero-gradient py-14 relative">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="mb-5 flex items-center flex-wrap text-sm text-white/70">
                <a href="{{ route('projects.index') }}" class="breadcrumb-item hover:text-white transition">Accueil</a>
                <a href="{{ route('projects.all') }}" class="breadcrumb-item hover:text-white transition">Projets</a>
                <span class="text-white/90 font-medium">{{ Str::limit($projet->title, 35) }}</span>
            </nav>
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-md px-4 py-1.5 rounded-full mb-4 border border-white/25 text-sm text-white font-medium">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-400"></span>
                        </span>
                        Projet terminé
                    </div>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white tracking-tight mb-5 leading-tight">{{ $projet->title }}</h1>
                    @php
                        $typeColors = ['frontend'=>'bg-blue-500/80','backend'=>'bg-emerald-500/80','database'=>'bg-purple-500/80','service'=>'bg-orange-500/80'];
                    @endphp
                    <div class="flex flex-wrap gap-2">
                        @foreach ($projet->technologies as $tech)
                            <span class="tech-badge inline-flex items-center rounded-full px-3 py-1.5 text-xs font-semibold text-white border border-white/20 shadow {{ $typeColors[$tech->type] ?? 'bg-slate-500/80' }}">{{ $tech->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    @if ($projet->link_visualisation)
                        <a href="{{ $projet->link_visualisation }}" target="_blank" class="inline-flex items-center gap-2 bg-white text-purple-700 px-5 py-2.5 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all hover:scale-105 text-sm">
                            <i class="ri-external-link-line"></i> Voir le site en direct
                        </a>
                    @endif
                    @if ($projet->link_github)
                        <a href="{{ $projet->link_github }}" target="_blank" class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-md text-white px-5 py-2.5 rounded-full font-semibold border border-white/25 hover:bg-white/25 transition-all text-sm">
                            <i class="ri-github-fill"></i> <span class="hidden sm:inline">GitHub</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- CONTENU --}}
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- Colonne gauche --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Carrousel --}}
                <div class="card bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden">
                    <div class="relative">
                        <img id="slide-image" src="{{ asset($projet->imagefirst) }}" alt="{{ $projet->title }}" class="w-full aspect-video object-cover" />
                        <button id="btn-prev" aria-label="Précédent" class="carousel-btn absolute left-3 top-1/2 -translate-y-1/2 bg-white/75 rounded-full p-2.5 shadow-md">
                            <i class="ri-arrow-left-s-line text-xl text-slate-700"></i>
                        </button>
                        <button id="btn-next" aria-label="Suivant" class="carousel-btn absolute right-3 top-1/2 -translate-y-1/2 bg-white/75 rounded-full p-2.5 shadow-md">
                            <i class="ri-arrow-right-s-line text-xl text-slate-700"></i>
                        </button>
                        <div class="absolute bottom-3 left-3 bg-black/50 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full font-medium">
                            <span id="current-slide">1</span> / <span id="total-slides">1</span>
                        </div>
                    </div>
                    <div id="dots" class="flex justify-center gap-2 py-4 px-6"></div>
                </div>

                {{-- Description --}}
                <div class="card bg-white rounded-3xl border border-slate-100 shadow-xl p-7">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white flex-shrink-0">
                            <i class="ri-file-text-line text-lg"></i>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800">À propos du projet</h2>
                    </div>
                    <p class="text-slate-600 leading-relaxed text-justify text-sm sm:text-base">{!! $projet->description !!}</p>
                </div>

                {{-- Objectifs & Défis --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="card bg-white rounded-3xl border border-slate-100 shadow-xl p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0"><i class="ri-target-line text-lg"></i></div>
                            <h3 class="font-bold text-slate-800">Objectifs</h3>
                        </div>
                        <ul class="space-y-2.5">
                            @forelse (is_array($projet->objectives) ? $projet->objectives : [] as $item)
                                @if(trim($item))
                                <li class="flex items-start gap-2.5 text-sm text-slate-600">
                                    <i class="ri-checkbox-circle-fill text-green-500 mt-0.5 flex-shrink-0"></i>
                                    <span class="text-justify">{{ $item }}</span>
                                </li>
                                @endif
                            @empty
                                <li class="text-sm text-slate-400 italic">Aucun objectif renseigné.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card bg-white rounded-3xl border border-slate-100 shadow-xl p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-9 h-9 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center flex-shrink-0"><i class="ri-lightbulb-flash-line text-lg"></i></div>
                            <h3 class="font-bold text-slate-800">Défis relevés</h3>
                        </div>
                        <ul class="space-y-2.5">
                            @forelse (is_array($projet->challenges) ? $projet->challenges : [] as $item)
                                @if(trim($item))
                                <li class="flex items-start gap-2.5 text-sm text-slate-600">
                                    <i class="ri-flashlight-fill text-orange-400 mt-0.5 flex-shrink-0"></i>
                                    <span class="text-justify">{{ $item }}</span>
                                </li>
                                @endif
                            @empty
                                <li class="text-sm text-slate-400 italic">Aucun défi renseigné.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>

            {{-- Colonne droite --}}
            <aside class="space-y-5">

                {{-- Stack --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-md p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <i class="ri-stack-line text-purple-600 text-lg"></i>
                        <h3 class="font-bold text-slate-800">Stack technique</h3>
                    </div>
                    <dl class="space-y-3 text-sm">
                        @php $labels = ['frontend'=>'Frontend','backend'=>'Backend','database'=>'Base de données','service'=>'Services']; @endphp
                        @foreach ($labels as $type => $label)
                            @php $technos = $projet->technologies->where('type', $type); @endphp
                            @if($technos->isNotEmpty())
                            <div>
                                <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1.5">{{ $label }}</dt>
                                <dd class="flex flex-wrap gap-1.5">
                                    @foreach ($technos as $tech)
                                        @php $colors=['#3B82F6','#10B981','#F59E0B','#EF4444','#8B5CF6','#EC4899','#14B8A6','#F97316']; $c=$colors[abs(crc32($tech->name))%count($colors)]; @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium text-white shadow-sm" style="background-color:{{ $c }}">{{ $tech->name }}</span>
                                    @endforeach
                                </dd>
                            </div>
                            @endif
                        @endforeach
                    </dl>
                </div>

                {{-- Fonctionnalités --}}
                @php $foncs = is_array($projet->fonctionnalites) ? array_filter($projet->fonctionnalites, 'trim') : []; @endphp
                @if(count($foncs) > 0)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-md p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <i class="ri-list-check-2 text-blue-600 text-lg"></i>
                        <h3 class="font-bold text-slate-800">Fonctionnalités</h3>
                    </div>
                    <ul class="space-y-2">
                        @foreach ($foncs as $item)
                        <li class="flex items-start gap-2 text-sm text-slate-600">
                            <i class="ri-checkbox-circle-fill text-blue-500 mt-0.5 flex-shrink-0"></i>
                            <span class="text-justify">{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif


            </aside>
        </div>

        {{-- SUGGESTIONS --}}
        @if($suggestions->isNotEmpty())
        <div class="mt-16 mb-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Autres projets</h2>
                    <p class="text-slate-500 text-sm mt-1">Découvrez d'autres réalisations</p>
                </div>
                <a href="{{ route('projects.all') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-purple-600 hover:text-purple-700 transition">
                    Voir tout <i class="ri-arrow-right-line"></i>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($suggestions as $s)
                <a href="{{ route('projet.show', $s->id) }}" class="suggestion-card bg-white rounded-2xl border border-slate-100 shadow-md overflow-hidden flex flex-col group">
                    <div class="overflow-hidden h-44">
                        <img src="{{ asset($s->imagefirst) }}" alt="{{ $s->title }}" class="w-full h-full object-cover object-top" />
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-slate-800 mb-2 group-hover:text-purple-600 transition">{{ $s->title }}</h3>
                            <p class="text-slate-500 text-xs leading-relaxed line-clamp-2">{{ Str::limit(strip_tags($s->description), 100) }}</p>
                        </div>
                        <div class="flex flex-wrap gap-1.5 mt-3">
                            @foreach ($s->technologies->take(3) as $tech)
                                <span class="text-xs px-2 py-0.5 bg-blue-50 text-blue-700 rounded-full font-medium">{{ $tech->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</main>

@include('partials.footer', ['user' => $user])

<div class="fab-container">
    <button id="shareBtn" class="fab" title="Partager"><i class="ri-share-line"></i></button>
    <button id="scrollToTop" class="fab hidden" title="Haut de page"><i class="ri-arrow-up-line"></i></button>
</div>

<script>
    gsap.registerPlugin(ScrollTrigger);
    gsap.from('.hero-gradient h1', { y:40, opacity:0, duration:.9, ease:'power3.out' });
    gsap.from('.hero-gradient .tech-badge', { scale:0, opacity:0, duration:.4, stagger:.08, delay:.4, ease:'back.out(1.7)' });
    gsap.utils.toArray('.card').forEach((el,i) => {
        gsap.from(el, { y:60, opacity:0, duration:.7, delay:i*.08, scrollTrigger:{ trigger:el, start:'top 88%', toggleActions:'play none none reverse' } });
    });
    gsap.utils.toArray('.suggestion-card').forEach((el,i) => {
        gsap.from(el, { y:50, opacity:0, duration:.6, delay:i*.1, scrollTrigger:{ trigger:el, start:'top 90%', toggleActions:'play none none reverse' } });
    });
    window.addEventListener('scroll', () => {
        const h = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        document.getElementById('reading-progress').style.width = (window.scrollY/h*100)+'%';
    });
    const topBtn = document.getElementById('scrollToTop');
    window.addEventListener('scroll', () => topBtn.classList.toggle('hidden', window.scrollY < 300));
    topBtn.addEventListener('click', () => window.scrollTo({ top:0, behavior:'smooth' }));
    document.getElementById('shareBtn').addEventListener('click', async () => {
        if (navigator.share) { try { await navigator.share({ title:'{{ addslashes($projet->title) }}', url:location.href }); } catch(e){} }
        else { await navigator.clipboard.writeText(location.href); alert('Lien copié !'); }
    });
</script>

<script>
    const slides = [
        @forelse ($projet->images as $image)
            { src:"{{ asset($image->image_path) }}", alt:"{{ addslashes($projet->title) }}" }@if(!$loop->last),@endif
        @empty
            { src:"{{ asset($projet->imagefirst) }}", alt:"{{ addslashes($projet->title) }}" }
        @endforelse
    ];
    const img=document.getElementById('slide-image'), dotsWrap=document.getElementById('dots'),
          prevBtn=document.getElementById('btn-prev'), nextBtn=document.getElementById('btn-next'),
          curEl=document.getElementById('current-slide'), totEl=document.getElementById('total-slides');
    let idx=0;
    totEl.textContent=slides.length;
    function renderDots(){
        dotsWrap.innerHTML='';
        slides.forEach((_,i)=>{
            const b=document.createElement('button');
            b.setAttribute('aria-label','Image '+(i+1));
            b.className='rounded-full transition-all duration-300 '+(i===idx?'w-7 h-2.5 bg-purple-600':'w-2.5 h-2.5 bg-slate-300 hover:bg-slate-400');
            b.addEventListener('click',()=>{ idx=i; update(); });
            dotsWrap.appendChild(b);
        });
    }
    function update(){
        img.style.opacity='0'; img.style.transform='scale(0.97)';
        setTimeout(()=>{
            img.src=slides[idx].src; img.alt=slides[idx].alt; curEl.textContent=idx+1; renderDots();
            setTimeout(()=>{ img.style.opacity='1'; img.style.transform='scale(1)'; },40);
        },250);
    }
    function prev(){ idx=(idx-1+slides.length)%slides.length; update(); }
    function next(){ idx=(idx+1)%slides.length; update(); }
    prevBtn.addEventListener('click',prev); nextBtn.addEventListener('click',next);
    window.addEventListener('keydown',e=>{ if(e.key==='ArrowLeft')prev(); if(e.key==='ArrowRight')next(); });
    let sx=0,dx=0;
    img.addEventListener('touchstart',e=>{ sx=e.touches[0].clientX; });
    img.addEventListener('touchmove', e=>{ dx=e.touches[0].clientX-sx; });
    img.addEventListener('touchend', ()=>{ if(Math.abs(dx)>40) dx>0?prev():next(); dx=0; });
    let auto=setInterval(next,5000);
    img.addEventListener('mouseenter',()=>clearInterval(auto));
    img.addEventListener('mouseleave',()=>{ auto=setInterval(next,5000); });
    update();
</script>

</body>
</html>
