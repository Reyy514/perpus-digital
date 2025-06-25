<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-neutral leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kartu Statistik Utama --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Buku -->
                <div class="bg-base-100 p-6 rounded-xl shadow-lg flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-neutral/70">Total Buku</p>
                        <p class="text-3xl font-bold text-neutral mt-1">{{ $stats['total_books'] ?? 0 }}</p>
                        <a href="{{ route('admin.books.index') }}" class="text-sm font-semibold text-primary mt-4 inline-block hover:underline">Lihat Detail &rarr;</a>
                    </div>
                    <div class="p-3 rounded-full bg-primary/10 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-copy"><path d="M2 17h2v3H2z"/><path d="M22 17h-2v3h2z"/><path d="M6 17h2v3H6z"/><path d="M14 17h2v3h-2z"/><rect width="18" height="12" x="3" y="3" rx="2"/><path d="M7 21h10"/><path d="M12 3v18"/></svg>
                    </div>
                </div>

                <!-- Peminjaman Aktif -->
                <div class="bg-base-100 p-6 rounded-xl shadow-lg flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-neutral/70">Peminjaman Aktif</p>
                        <p class="text-3xl font-bold text-neutral mt-1">{{ $stats['active_borrowings'] ?? 0 }}</p>
                        <a href="{{ route('admin.borrowings.index') }}" class="text-sm font-semibold text-primary mt-4 inline-block hover:underline">Lihat Detail &rarr;</a>
                    </div>
                    <div class="p-3 rounded-full bg-secondary/10 text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                    </div>
                </div>

                <!-- Total Pengguna -->
                <div class="bg-base-100 p-6 rounded-xl shadow-lg flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-neutral/70">Total Pengguna</p>
                        <p class="text-3xl font-bold text-neutral mt-1">{{ $stats['active_users'] ?? 0 }}</p>
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-primary mt-4 inline-block hover:underline">Lihat Detail &rarr;</a>
                    </div>
                    <div class="p-3 rounded-full bg-accent/10 text-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                </div>
                
                <!-- Total Kategori -->
                <div class="bg-base-100 p-6 rounded-xl shadow-lg flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-neutral/70">Total Kategori</p>
                        <p class="text-3xl font-bold text-neutral mt-1">{{ $stats['total_categories'] ?? 0 }}</p>
                         <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold text-primary mt-4 inline-block hover:underline">Lihat Detail &rarr;</a>
                    </div>
                    <div class="p-3 rounded-full bg-info/10 text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-grid"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Grafik -->
                <div class="lg:col-span-2 bg-base-100 p-6 rounded-xl shadow-lg">
                    <h3 class="font-semibold mb-4 text-neutral">Aktivitas Peminjaman (7 Hari Terakhir)</h3>
                    <div class="relative h-80">
                        <canvas id="borrowingChart"></canvas>
                    </div>
                </div>

                <!-- Aktivitas Terbaru (Dinamis) -->
                <div class="bg-base-100 p-6 rounded-xl shadow-lg">
                     <h3 class="font-semibold mb-4 text-neutral">Aktivitas Terbaru</h3>
                     <div class="space-y-4">
                        @forelse($recentActivities as $activity)
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-base-200 text-neutral/60 rounded-full">
                                    {{-- Ikon dinamis berdasarkan tipe aktivitas --}}
                                    @if($activity->type == 'user_registered')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                                    @elseif($activity->type == 'book_borrowed')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-check"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/><path d="m9 13 2 2 4-4"/></svg>
                                    @elseif($activity->type == 'review_created')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-plus"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="9" x2="15" y1="10" y2="10"/><line x1="12" x2="12" y1="7" y2="13"/></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                                    @endif
                                </div>
                                <p class="text-sm text-neutral/80">
                                    {{ $activity->description }}
                                    <span class="text-neutral/50 text-xs block">{{ $activity->created_at->diffForHumans() }}</span>
                                </p>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-sm text-neutral/60">Belum ada aktivitas terbaru.</p>
                            </div>
                        @endforelse
                     </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('borrowingChart');
            if (!ctx) return;

            const chartData = @json($chartData->values() ?? []);
            const chartLabels = @json($chartData->keys()->map(fn ($date) => \Carbon\Carbon::parse($date)->format('d M')) ?? []);
            
            // Fungsi untuk mendapatkan warna dari CSS Variables
            const getComputedColor = (variable) => {
                return getComputedStyle(document.documentElement).getPropertyValue(variable).trim();
            };
            
            const getChartColors = () => {
                // Konversi HSL dari config ke RGBA untuk Chart.js
                const primaryColor = `hsl(${getComputedColor('--primary')})`;
                const primaryColorTransparent = `hsla(${getComputedColor('--primary')} / 0.1)`;
                
                return {
                    borderColor: primaryColor,
                    backgroundColor: primaryColorTransparent,
                    ticksColor: `hsl(${getComputedColor('--neutral')} / 0.5)`,
                    gridColor: `hsl(${getComputedColor('--base-300')} / 0.2)`
                };
            };
            
            const initialColors = getChartColors();

            const borrowingChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: chartData,
                        borderColor: initialColors.borderColor,
                        backgroundColor: initialColors.backgroundColor,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: initialColors.borderColor,
                        pointBorderColor: getComputedColor('--base-100'),
                        pointHoverBackgroundColor: getComputedColor('--base-100'),
                        pointHoverBorderColor: initialColors.borderColor,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, ticks: { color: initialColors.ticksColor, precision: 0 }, grid: { color: initialColors.gridColor } },
                        x: { ticks: { color: initialColors.ticksColor }, grid: { display: false } }
                    },
                    plugins: { legend: { display: false } },
                    interaction: { intersect: false, mode: 'index' },
                }
            });

            // Listener untuk update chart saat tema berubah
            new MutationObserver(() => {
                const newColors = getChartColors();
                borrowingChart.data.datasets[0].borderColor = newColors.borderColor;
                borrowingChart.data.datasets[0].backgroundColor = newColors.backgroundColor;
                borrowingChart.data.datasets[0].pointBackgroundColor = newColors.borderColor;
                borrowingChart.data.datasets[0].pointBorderColor = getComputedColor('--base-100');
                borrowingChart.data.datasets[0].pointHoverBackgroundColor = getComputedColor('--base-100');
                borrowingChart.data.datasets[0].pointHoverBorderColor = newColors.borderColor;
                borrowingChart.options.scales.y.ticks.color = newColors.ticksColor;
                borrowingChart.options.scales.x.ticks.color = newColors.ticksColor;
                borrowingChart.options.scales.y.grid.color = newColors.gridColor;
                borrowingChart.update('none'); // Update tanpa animasi
            }).observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
        });
    </script>
    @endpush
</x-app-layout>
