            </div>
            <footer class="text-center py-4 text-muted" style="font-size: 12px;">
                © 2024 Dkriuk Fried Chicken. Semua hak dilindungi.
            </footer>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Flatpickr (Date Picker) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <!-- SheetJS (Excel Export) -->
    <!-- ExcelJS & FileSaver for Premium Excel Export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    
    <script>
        // Sidebar Toggle
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#sidebar-wrapper").toggleClass("toggled");
        });

        // Initialize Flatpickr
        flatpickr("#range_date", {
            mode: "range",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    $("#filterForm").submit();
                }
            }
        });

        // Search Debounce (Auto submit after 800ms)
        let searchTimer;
        $('input[name="search"]').on('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                $("#filterForm").submit();
            }, 800);
        });

        // Export Functionality (ExcelJS Premium Table)
        async function exportData() {
            const tableElement = document.querySelector(".table");
            if (!tableElement || tableElement.rows.length <= 1) {
                Swal.fire({ icon: 'warning', title: 'Data Kosong', text: 'Tidak ada data untuk diekspor.' });
                return;
            }

            // Tampilkan Loading
            Swal.fire({
                title: 'Sedang Memproses...',
                text: 'Menyiapkan file Excel premium untuk Anda',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet('Laporan Penjualan');

            // 1. KOP LAPORAN (Header)
            worksheet.mergeCells('A1:H1');
            const title = worksheet.getCell('A1');
            title.value = 'LAPORAN PENJUALAN - DKRIUK FRIED CHICKEN';
            title.font = { name: 'Arial Black', size: 16, bold: true, color: { argb: 'FFA30D11' } };
            title.alignment = { vertical: 'middle', horizontal: 'center' };

            worksheet.mergeCells('A2:H2');
            const subtitle = worksheet.getCell('A2');
            subtitle.value = 'Jl. Jend. Sudirman No. 123, Jakarta';
            subtitle.font = { size: 12, italic: true };
            subtitle.alignment = { vertical: 'middle', horizontal: 'center' };

            worksheet.mergeCells('A3:H3');
            const periode = worksheet.getCell('A3');
            const dateVal = $("#range_date").val() || "Semua Waktu";
            periode.value = 'Periode: ' + dateVal;
            periode.font = { size: 11, bold: true };
            periode.alignment = { vertical: 'middle', horizontal: 'center' };
            
            worksheet.addRow([]); // Spacer

            // 2. PREPARE DATA FOR TABLE
            const headerRow = ["No", "Kode", "Pelanggan", "Waktu", "Tipe", "Metode", "Total", "Status"];
            const dataRows = [];
            
            tableElement.querySelectorAll("tbody tr").forEach((tr, index) => {
                const rowData = [index + 1]; // Generate Number
                tr.querySelectorAll("td").forEach((td, tdIndex) => {
                    let val = td.innerText.trim();
                    
                    // Jika kolom Total (Index 6 di rowData, Index 5 di td loop karena td mulai dari 0)
                    if (tdIndex === 5) {
                        // Bersihkan Rp dan titik untuk jadi angka bersih
                        val = parseFloat(val.replace(/[^0-9]/g, '')) || 0;
                    }
                    rowData.push(val);
                });
                if (rowData.length > 1) dataRows.push(rowData);
            });

            // 3. ADD TABLE OBJECT
            worksheet.addTable({
                name: 'TabelLaporan',
                ref: 'A5',
                headerRow: true,
                totalsRow: true,
                style: {
                    theme: 'TableStyleMedium2',
                    showRowStripes: true,
                },
                columns: [
                    { name: 'No' },
                    { name: 'Kode' },
                    { name: 'Pelanggan' },
                    { name: 'Waktu' },
                    { name: 'Tipe' },
                    { name: 'Metode', totalsRowLabel: 'TOTAL KESELURUHAN' },
                    { name: 'Total', totalsRowFunction: 'sum' },
                    { name: 'Status' }
                ],
                rows: dataRows,
            });

            // 4. FORMATTING
            worksheet.columns = [
                { width: 5 },  // No
                { width: 18 }, // Kode
                { width: 25 }, // Pelanggan
                { width: 25 }, // Waktu
                { width: 12 }, // Tipe
                { width: 20 }, // Metode
                { width: 18, numFmt: '"Rp" #,##0' }, // Total (Format Rupiah Excel)
                { width: 15 }  // Status
            ];

            // Styling baris total
            const totalRowIndex = worksheet.rowCount;
            const totalRow = worksheet.getRow(totalRowIndex);
            totalRow.font = { bold: true };
            totalRow.getCell(7).font = { bold: true, color: { argb: 'FFA30D11' } };
            totalRow.getCell(7).numFmt = '"Rp" #,##0';

            // 5. GENERATE & DOWNLOAD
            const buffer = await workbook.xlsx.writeBuffer();
            const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            saveAs(blob, `Laporan_Penjualan_${dateVal.replace(/ /g, '_')}.xlsx`);
            
            Swal.close();
        }
    </script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Notifikasi Flash
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('msg') === 'success') {
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data telah diproses.', confirmButtonColor: '#A30D11' });
        } else if (urlParams.get('msg') === 'error') {
            Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Terjadi kesalahan sistem.', confirmButtonColor: '#A30D11' });
        }

        // Fungsi Hapus Global
        function konfirmasiHapus(url) {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data ini tidak bisa dikembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A30D11',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) window.location.href = url;
            })
        }
    </script>
</body>
</html>
