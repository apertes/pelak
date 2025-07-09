<!-- Preloader -->
<div id="preloader">
    <div id="ctn-preloader" class="ont-preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                    <span data-text-preloader="موتریلا" class="letters-loading">
                        موتریلا
                     </span>
            </div>
            <p class="text-center">بارگذاری</p>
        </div>

        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Preloader -->

<script>
    // کد مدیریت پریلودر
    document.addEventListener("DOMContentLoaded", function() {
        hidePreloader();
    });

    window.addEventListener('load', function() {
        hidePreloader();
    });

    // حذف اجباری پریلودر بعد از 3 ثانیه
    setTimeout(hidePreloader, 3000);

    function hidePreloader() {
        var preloader = document.getElementById('preloader');
        if (preloader && preloader.style.display !== 'none') {
            preloader.style.opacity = '0';
            setTimeout(function() {
                preloader.style.display = 'none';
            }, 500);
        }
    }
</script> 