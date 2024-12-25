<!-- Start Footer -->
@if (!View::hasSection('full_screen'))
    <div class="footer-bottom py-3 not-print d-none d-sm-block">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-sm-between gap-3">
                <p>{{ __('site.All_rights_reserved_©_2022') }}</p>
                <div class="about_data d-flex align-items-center justify-content-center">
                    <p class="ms-2">{{ __('site.Sales_program_v1.0') }}</p>
                </div>
                <a href="https://www.const-tech.org/">
                    <img src="{{ asset('img/footer/copy.png') }}" alt="logo">
                </a>
            </div>
        </div>
    </div>
@endif
<!-- ENd Footer -->
<!-- Js Files -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<!-- Sweer Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(".img").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".img-preview").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert', ({
        detail: {
            type,
            message
        }
    }) => {
        Toast.fire({
            icon: type,
            title: message
        })
    })
</script>


<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
</script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />
@stack('js')
</body>

</html>
