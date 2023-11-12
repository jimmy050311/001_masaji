// import Swal from "sweetalert2/dist/sweetalert2.js";
import Swal from "sweetalert2/dist/sweetalert2.js"
export function alert(swalClassType = "site") {
    const swalClass = {
        popup: swalClassType + "-popup",
        header: "...",
        title: swalClassType + "-title",
        closeButton: swalClassType + "-close",
        icon: swalClassType + "-icon",
        image: "...",
        content: "...",
        htmlContainer: swalClassType + "-html-container",
        input: "...",
        inputLabel: "...",
        validationMessage: "...",
        actions: "...",
        cancelButton: swalClassType + "-cancel",
        confirmButton: swalClassType + "-confirm",
        denyButton: "",
        loader: "...",
        footer: "....",
    };

    const success =async (msg) => {
        const config = {
            icon: "success",
            title: "成功",
        }
        await defaultSwal(config,msg)
    }

    const warning = async(msg) => {
        const config = {
            icon: "warning",
            title: "警告",
        }
        await defaultSwal(config,msg)
    }

    const error=async(msg) => {
        const config = {
            icon: "error",
            title: "錯誤",
        }
        await defaultSwal(config,msg)
    }

    const defaultSwal = async(
        config = {
            icon: "",
            title: "",
        },
        msg
    ) => {
        await Swal.fire({
            customClass: swalClass,
            icon: config.icon,
            title: config.title,
            text: msg,
            confirmButtonText: '確認'
        }).then(()=>{});
        return true
    }

    const dump = async (msg, url) => {

        let timerInterval

        await Swal.fire({
            title: '提示',
            icon: 'success',
            html: msg + ", <b></b>秒後將跳轉",
            timer: 2000,
            timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft() / 1000
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
        }).then((result) => {
            if (result.isDismissed === true) {
                if (url == '') {
                    // window.location.reload();
                } else {
                    window.location.href = url;
                }
            }
        });
        return true
    }

    return {
        success,
        warning,
        error,
        dump
    };
}


export function loading(loadClass = "light") {

    const spinner = Swal.mixin({
        background: "transparent",
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: false,
        reverseButtons: false,
        allowOutsideClick: false,
        backdrop: "swal2-backdrop-hide",
        html:   `<div class="text-center default-loading" >
                    <div class="spinner-border text-${loadClass}" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`,
    });

    const growSpinner = Swal.mixin({
        background: "transparent",
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: false,
        reverseButtons: false,
        allowOutsideClick: false,
        backdrop: "swal2-backdrop-hide",
        html:   `<div class="text-center default-loading" >
                    <div class="spinner-grow text-${loadClass}" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`,
    });

    return {
        spinner,
        growSpinner
    };
}