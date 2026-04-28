<?php

class Pagination {
    public static function create($total_data, $per_page, $current_page, $base_url) {
        $total_pages = ceil($total_data / $per_page);
        $start_data = ($current_page - 1) * $per_page + 1;
        $end_data = min($start_data + $per_page - 1, $total_data);

        // Jika tidak ada data
        if ($total_data == 0) {
            return '';
        }

        $html = '<!-- Pagination Premium Global -->
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mt-4 px-4 mb-5 gap-3">
            <div class="text-muted small order-2 order-md-1">
                Menampilkan <span class="fw-bold text-dark">' . $start_data . ' - ' . $end_data . '</span> dari <span class="fw-bold text-dark">' . $total_data . '</span> data
            </div>
            
            <nav class="order-1 order-md-2">
                <ul class="pagination-premium mb-0">';

        // Tombol Previous
        $prev_disabled = ($current_page <= 1) ? 'disabled' : '';
        $prev_url = ($current_page <= 1) ? '#' : $base_url . '/' . ($current_page - 1);
        $html .= '<li class="page-btn ' . $prev_disabled . '"><a href="' . $prev_url . '" class="text-decoration-none text-inherit"><i class="fas fa-chevron-left"></i></a></li>';

        // Logika Nomor Halaman (Simple version with 1...active...last)
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == 1 || $i == $total_pages || ($i >= $current_page - 1 && $i <= $current_page + 1)) {
                $active = ($i == $current_page) ? 'active' : '';
                $html .= '<li class="page-btn ' . $active . '"><a href="' . $base_url . '/' . $i . '" class="text-decoration-none ' . ($active ? 'text-white' : 'text-dark') . '">' . $i . '</a></li>';
            } elseif ($i == 2 || $i == $total_pages - 1) {
                $html .= '<li class="page-btn-dots">...</li>';
            }
        }

        // Tombol Next
        $next_disabled = ($current_page >= $total_pages) ? 'disabled' : '';
        $next_url = ($current_page >= $total_pages) ? '#' : $base_url . '/' . ($current_page + 1);
        $html .= '<li class="page-btn ' . $next_disabled . '"><a href="' . $next_url . '" class="text-decoration-none text-inherit"><i class="fas fa-chevron-right"></i></a></li>';

        $html .= '      </ul>
            </nav>

            <div class="order-3">
                <div class="d-flex align-items-center bg-white px-3 py-2 rounded-3 shadow-sm border" style="cursor: pointer;">
                    <select class="form-select form-select-sm border-0 bg-transparent fw-bold p-0" style="width: auto; cursor: pointer; font-size: 12px; height: auto;" onchange="window.location.href=\'' . $base_url . '/1/\' + this.value">
                        <option value="8" ' . ($per_page == 8 ? 'selected' : '') . '>8 per halaman</option>
                        <option value="16" ' . ($per_page == 16 ? 'selected' : '') . '>16 per halaman</option>
                        <option value="32" ' . ($per_page == 32 ? 'selected' : '') . '>32 per halaman</option>
                    </select>
                </div>
            </div>
        </div>';

        return $html;
    }
}
