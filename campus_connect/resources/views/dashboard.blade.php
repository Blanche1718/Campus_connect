<?php

// ...existing code..
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de bord administrateur') }}
        </h2>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistiques -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

                <!-- Annonces -->
                <div>
                    <a href="{{ route('annonces.index') }}" class="block no-underline">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Annonces</h3>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['annonces'] ?? 0 }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('annonces.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Utilisateurs -->
                <div>
    
                        <a href="{{ route('users.index') }}" class="block no-underline">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Utilisateurs</h3>
                                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['users'] ?? 0 }}</p>
                                    </div>
                                    <div>
            
                                            <a href="{{ route('users.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                    
                                    </div>
                                </div>
                            </div>
                        </a>
                  
                </div>

                <!-- Catégories -->
                <div>
                    <a href="{{ route('categories.index') }}" class="block no-underline">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Catégories</h3>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['categories'] ?? 0 }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('categories.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Salles -->
                <div>
                    <a href="{{ route('salles.index') }}" class="block no-underline">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Salles</h3>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['salles'] ?? 0 }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('salles.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Équipements -->
                <div>
                    <a href="{{ route('equipements.index') }}" class="block no-underline">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Équipements</h3>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['equipements'] ?? 0 }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('equipements.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Reservations -->
                <div>
                    <a href="{{ route('reservations.index') }}" class="block no-underline">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Réservations</h3>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['reservations'] ?? 0 }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('reservations.create') }}" class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded">Créer</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            <!-- Dernières annonces -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Dernières annonces</h3>

                    @if(isset($recentAnnonces) && $recentAnnonces->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Titre</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Auteur</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Catégorie</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Date publication</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($recentAnnonces as $annonce)
                                        <tr>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ Str::limit($annonce->titre, 80) }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ optional($annonce->auteur)->name ?? $annonce->auteur_id }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ optional($annonce->categorie)->nom ?? $annonce->categorie_id }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ optional($annonce->date_publication)->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-sm text-gray-600 dark:text-gray-400">Aucune annonce récente.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- SVG icons used via <use> --}}
    <svg style="display:none;">
        <symbol id="home" viewBox="0 0 24 24"><path d="M3 11.5L12 4l9 7.5V20a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1v-8.5z" fill="currentColor"/></symbol>
        <symbol id="megaphone" viewBox="0 0 24 24"><path d="M3 10v4h4l7 3V7L7 10H3zM17 5v14a1 1 0 001 1h1a1 1 0 001-1V5h-3z" fill="currentColor"/></symbol>
        <symbol id="users" viewBox="0 0 24 24"><path d="M16 11c1.66 0 3-1.34 3-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM6 11c1.66 0 3-1.34 3-3S7.66 5 6 5 3 6.34 3 8s1.34 3 3 3zm10 2c-2.33 0-7 1.17-7 3.5V20h14v-3.5c0-2.33-4.67-3.5-7-3.5z" fill="currentColor"/></symbol>
        <symbol id="calendar" viewBox="0 0 24 24"><path d="M7 10h10v5H7z" fill="currentColor"/><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2z" fill="currentColor"/></symbol>
        <symbol id="palette" viewBox="0 0 24 24"><path d="M12 3C7 3 3 7 3 12s4 9 9 9c.99 0 1.86-.16 2.66-.46.6-.22 1.05-.7 1.31-1.33.2-.46.5-.92.88-1.28A4.98 4.98 0 0017 10c0-2.76-2.24-5-5-5z" fill="currentColor"/></symbol>
    </svg>

    {{-- ECharts CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
    {{-- Alpine.js --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        /* Glass / card styles */
        .stat-card { border-radius: 1rem; background: linear-gradient(135deg, rgba(255,255,255,0.6), rgba(255,255,255,0.3)); padding: 1.25rem; box-shadow: 0 8px 30px rgba(2,6,23,0.08); border: 1px solid rgba(255,255,255,0.5); }
        .card-inner { position: relative; z-index: 2; }
        .icon-glass { background: linear-gradient(180deg, rgba(255,255,255,0.85), rgba(255,255,255,0.65)); padding: 0.5rem; border-radius: 0.75rem; }
        /* hover animations */
        .stat-card { transition: transform .25s ease, box-shadow .25s ease; }
        .stat-card:hover { transform: translateY(-6px); box-shadow: 0 18px 50px rgba(2,6,23,0.12); }
        /* dark tweaks */
        .dark .stat-card { background: linear-gradient(135deg, rgba(17,24,39,0.6), rgba(17,24,39,0.5)); border: 1px solid rgba(255,255,255,0.04); }
    </style>

    <script>
        function dashboard() {
            return {
                sidebarOpen: window.innerWidth >= 768,
                theme: 'blue',
                init() {
                    // apply default theme
                    this.applyTheme('blue');

                    // prepare data (from Blade variables)
                    // Stats totals (fallbacks)
                    this.stats = @json($stats ?? []);
                    this.recent = @json(isset($recentAnnonces) ? $recentAnnonces->map(function($a){ return [
                        'titre' => \Illuminate\Support\Str::limit($a->titre, 120),
                        'categorie' => optional($a->categorie)->nom,
                        'date' => optional($a->date_publication)?->format('Y-m-d')
                    ]; })->toArray() : array());

                    // Build chart data
                    this.buildCharts();
                },
                setTheme(theme) {
                    this.theme = theme;
                    this.applyTheme(theme);
                },
                applyTheme(theme) {
                    const root = document.documentElement;
                    const themes = {
                        blue: {
                            '--accent': '#2563EB',
                            '--accent-600': '#1D4ED8',
                            '--accent-50': '#eff6ff',
                            '--glass': 'rgba(37,99,235,0.08)'
                        },
                        violet: {
                            '--accent': '#7C3AED',
                            '--accent-600': '#6D28D9',
                            '--accent-50': '#F3E8FF',
                            '--glass': 'rgba(124,58,237,0.08)'
                        },
                        green: {
                            '--accent': '#16A34A',
                            '--accent-600': '#15803D',
                            '--accent-50': '#ECFDF5',
                            '--glass': 'rgba(22,163,74,0.08)'
                        },
                        brick: {
                            '--accent': '#C53030',
                            '--accent-600': '#9B2C2C',
                            '--accent-50': '#FFF5F5',
                            '--glass': 'rgba(197,48,48,0.08)'
                        },
                        lux: {
                            '--accent': '#111827',
                            '--accent-600': '#D4AF37',
                            '--accent-50': '#FDF6E3',
                            '--glass': 'rgba(212,175,55,0.06)'
                        }
                    };
                    const sel = themes[theme] || themes.blue;
                    for (const k in sel) root.style.setProperty(k, sel[k]);
                    // update some CSS dynamic elements (if required)
                    document.querySelectorAll('.icon-glass').forEach(el=>{
                        el.style.background = sel['--glass'] ? `linear-gradient(180deg, rgba(255,255,255,0.85), ${sel['--glass']})` : '';
                    });
                    // rebuild charts to adopt new colors
                    this.buildCharts();
                },

                // animations of cards
                cardHover(el) {
                    el.style.transform = 'translateY(-8px)';
                    el.style.boxShadow = '0 22px 60px rgba(2,6,23,0.16)';
                },
                cardLeave(el) {
                    el.style.transform = '';
                    el.style.boxShadow = '';
                },

                // chart helpers
                buildCharts() {
                    // Prepare dataset for bar chart from stats
                    const totals = this.stats || {};
                    const barLabels = ['Annonces','Utilisateurs','Catégories','Salles','Équipements','Réservations'];
                    const barData = [
                        totals.annonces||0,
                        totals.users||0,
                        totals.categories||0,
                        totals.salles||0,
                        totals.equipements||0,
                        totals.reservations||0
                    ];

                    // Bar Chart
                    const barDom = document.getElementById('chart-bar');
                    if (barDom) {
                        echarts.dispose(barDom);
                        const barChart = echarts.init(barDom);
                        const accent = getComputedStyle(document.documentElement).getPropertyValue('--accent') || '#2563EB';
                        barChart.setOption({
                            color: [accent.trim()],
                            tooltip: { trigger: 'axis' },
                            xAxis: { type: 'category', data: barLabels, axisLabel:{rotate:30} },
                            yAxis: { type: 'value' },
                            series: [{ data: barData, type: 'bar', barMaxWidth: 28, itemStyle:{borderRadius:6} }]
                        });
                    }

                    // Donut Chart: categories distribution (from recent if categories available)
                    const donutDom = document.getElementById('chart-donut');
                    if (donutDom) {
                        echarts.dispose(donutDom);
                        const donutChart = echarts.init(donutDom);
                        // try to compute from recent announcements if available
                        const recent = this.recent || [];
                        let map = {};
                        recent.forEach(r => {
                            const c = r.categorie || 'Non classé';
                            map[c] = (map[c] || 0) + 1;
                        });
                        // fallback: if map empty, use totals or sample
                        if (Object.keys(map).length === 0) {
                            map = {
                                'Annonces': totals.annonces||1,
                                'Salles': totals.salles||1,
                                'Autres': Math.max(1, Math.floor((totals.users||1)/2))
                            };
                        }
                        const donutData = Object.keys(map).map(k=>({name:k, value:map[k]}));
                        donutChart.setOption({
                            tooltip: { trigger: 'item' },
                            legend: { bottom: 0, left: 'center' },
                            series: [
                                {
                                    name: 'Répartition',
                                    type: 'pie',
                                    radius: ['40%', '70%'],
                                    avoidLabelOverlap: false,
                                    itemStyle: { borderRadius: 6, borderColor: '#fff', borderWidth: 2 },
                                    label: { show: false },
                                    emphasis: { label: { show: true, fontSize: 14, fontWeight: 'bold' } },
                                    data: donutData
                                }
                            ]
                        });
                    }

                    // Line chart: announcements over last 7 days (from recent data)
                    const lineDom = document.getElementById('chart-line');
                    if (lineDom) {
                        echarts.dispose(lineDom);
                        const lineChart = echarts.init(lineDom);
                        const dates = [];
                        const counts = [];
                        // Build last 7 days labels
                        for (let i=6;i>=0;i--){
                            const d = new Date();
                            d.setDate(d.getDate() - i);
                            const key = d.toISOString().slice(0,10);
                            dates.push(key);
                        }
                        // Compute counts map from recent
                        const cMap = {};
                        (this.recent||[]).forEach(r=>{
                            if (!r.date) return;
                            cMap[r.date] = (cMap[r.date]||0)+1;
                        });
                        dates.forEach(d=>{
                            counts.push(cMap[d]||0);
                        });
                        lineChart.setOption({
                            tooltip: { trigger: 'axis' },
                            xAxis: { type: 'category', data: dates.map(x=>x.slice(5)) },
                            yAxis: { type: 'value' },
                            series: [{
                                data: counts,
                                type: 'line',
                                smooth: true,
                                symbol: 'circle',
                                lineStyle: { width: 3 },
                                areaStyle: { opacity: 0.12 }
                            }],
                            grid: { left: '3%', right: '3%', bottom: '8%', containLabel: true }
                        });
                    }

                    // small sparklines for stat cards (reused as mini-charts)
                    ['sparkline-annonces','sparkline-users','sparkline-res'].forEach((id, idx)=>{
                        const dom = document.getElementById(id);
                        if (!dom) return;
                        echarts.dispose(dom);
                        const s = echarts.init(dom);
                        // random-ish sample or from stats deltas
                        const arr = Array.from({length:8}, ()=>Math.floor(Math.random()*5));
                        s.setOption({
                            tooltip:{show:false},
                            xAxis:{type:'category',show:false,data:arr.map((_,i)=>i)},
                            yAxis:{type:'value',show:false},
                            series:[{data:arr,type:'line',smooth:true, lineStyle:{width:2}, areaStyle:{opacity:0.06}, symbol:'none'}]
                        });
                    });
                }
            }
        }
    </script>

    {{-- Small inline CSS for theme variables (can be moved to global CSS) --}}
    <style>
        :root {
            --accent: #2563EB;
            --accent-600: #1D4ED8;
            --accent-50: #eff6ff;
        }
        .text-accent { color: var(--accent); }
        .bg-accent { background: linear-gradient(90deg, var(--accent) 0%, var(--accent-600) 100%); color: white; }
    </style>
</x-app-layout>
