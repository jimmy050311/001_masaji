<script>
    function loadingShow() {
        Swal.fire({
            background: "transparent",
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: false,
            timerProgressBar: false,
            reverseButtons: false,
            allowOutsideClick: false,
            backdrop: "swal2-backdrop-hide",
            html:  `<div class="text-center default-loading" >
                        <div class="spinner-grow text-light" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>`,
        })
    }

    function loadingClose() {
        Swal.fire({
            background: "transparent",
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: false,
            timerProgressBar: false,
            reverseButtons: false,
            allowOutsideClick: false,
            backdrop: "swal2-backdrop-hide",
            html:  `<div class="text-center default-loading" >
                        <div class="spinner-grow text-light" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>`,
        }).close()
    }
</script>