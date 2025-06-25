@if($item->returned_at)
    <span class="inline-flex items-center gap-2 rounded-full bg-success/10 px-3 py-1 text-xs font-medium text-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle-2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
        Selesai
    </span>
@elseif($item->due_date && now()->gt($item->due_date))
    <span class="inline-flex items-center gap-2 rounded-full bg-error/10 px-3 py-1 text-xs font-medium text-error">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alarm-clock-off"><path d="M19.94 14.25a8.94 8.94 0 0 1-1.35 2.81m-1.35-1.35a4.02 4.02 0 0 0-5.69-5.62l-2.4-2.4m7.39.29a9 9 0 0 0-11.33-1.45"/><path d="M22 6A8.97 8.97 0 0 0 13.06 3.19"/><path d="M2.5 12.5a8.96 8.96 0 0 0 3.32 5.37"/><path d="m2 2 20 20"/><path d="M5 3 2 6"/><path d="M22 17v-3h-3"/></svg>
        Terlambat
    </span>
@else
    <span class="inline-flex items-center gap-2 rounded-full bg-info/10 px-3 py-1 text-xs font-medium text-info">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
        Dipinjam
    </span>
@endif