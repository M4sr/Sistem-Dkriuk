    <!-- Footer Section -->
    <footer id="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 pe-lg-5">
                    <?php 
                    $nama_toko = isset($data['pengaturan']['nama_toko']) ? $data['pengaturan']['nama_toko'] : "D'Kriuk Fried Chicken";
                    $logo_footer = !empty($data['pengaturan']['logo']) ? BASEURL . '/assets/img/logo/' . $data['pengaturan']['logo'] : 'https://ui-avatars.com/api/?name=DK&background=fff&color=A30D11'; 
                    ?>
                    <img src="<?= $logo_footer; ?>" class="footer-logo" alt="Logo">
                    <p class="footer-desc"><?= $nama_toko; ?> menghadirkan ayam goreng dengan cita rasa khas, renyah di luar, juicy di dalam.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                
                <div class="col-6 col-lg-2 border-start-lg ps-lg-5">
                    <h5 class="footer-heading">Menu</h5>
                    <ul class="footer-menu">
                        <li><a href="<?= BASEURL; ?>">Beranda</a></li>
                        <li><a href="#">Menu</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3 border-start-lg ps-lg-5">
                    <h5 class="footer-heading">Kontak Kami</h5>
                    <ul class="contact-info">
                        <li><i class="fas fa-phone"></i> 0812-3456-7890</li>
                        <li><i class="fas fa-map-marker-alt"></i> Jl. Crispy No. 123, Jakarta</li>
                        <li><i class="fas fa-clock"></i> Setiap Hari 09.00 - 22.00 WIB</li>
                    </ul>
                </div>

                <div class="col-lg-3 border-start-lg ps-lg-5">
                    <h5 class="footer-heading">Newsletter</h5>
                    <p class="newsletter-desc">Dapatkan info promo dan menu terbaru langsung di email kamu.</p>
                    <div class="newsletter-form">
                        <input type="text" class="newsletter-input" placeholder="Masukkan email kamu">
                        <button class="btn-newsletter"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-bar">
            © 2024 <?= $nama_toko; ?>. Semua hak dilindungi.
        </div>
    </footer>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateNavCart() {
            const badge = document.getElementById('navCartBadge');
            const badgeMobile = document.getElementById('navCartBadgeMobile');
            
            const cart = JSON.parse(localStorage.getItem('dkriuk_cart')) || [];
            const total = cart.reduce((acc, item) => acc + item.qty, 0);
            
            if (badge) {
                if (total > 0) {
                    badge.textContent = total;
                    badge.classList.remove('d-none');
                } else {
                    badge.classList.add('d-none');
                }
            }

            if (badgeMobile) {
                if (total > 0) {
                    badgeMobile.textContent = total;
                    badgeMobile.classList.remove('d-none');
                } else {
                    badgeMobile.classList.add('d-none');
                }
            }
        }
        
        // Listen for storage changes
        window.addEventListener('storage', updateNavCart);
        // Initial update
        document.addEventListener('DOMContentLoaded', updateNavCart);
    </script>
</body>
</html>
