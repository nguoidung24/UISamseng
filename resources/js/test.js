import axios from "axios";
var getImage = document.getElementById('__thumbnail')?.src;

export default {
    handleClickProduct(id, href) {
        Swal.fire({
            title: "Bạn cầm làm gì?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Sửa nó",
            denyButtonText: `Xóa nó`,
            cancelButtonText: "Thôi",
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = `/edit_products/${id}`
            } else if (result.isDenied) {
                const handle = async () => {
                    const request = {
                        action: "delete",
                        product_id: id
                    }
                    let response = await axios.post(href, request);
                    if (response.data) {
                        await Swal.fire("Đã xóa!", "", "success");
                        location.reload();
                    } else {
                        await Swal.fire("Xóa không thành công!", "", "warning");
                        location.reload();
                    }
                }
                handle();
            }
        });
    },
    handlePageClick(totalPage, href) {
        Swal.fire({
            title: "Nhập số trang !",
            input: "number",
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: true,
            confirmButtonText: "Đi đến",
            showLoaderOnConfirm: true,
            preConfirm: async (page) => {
                if (Number(page) > 0 && Number(page) <= Number(totalPage)) {
                    location.href = href + `&page=${page}`;
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "warning",
                        title: "<h1 class='text-black'>Trang không hợp lệ</h1>",
                        showCloseButton: true,
                    });
                }


            }
        })
    },
    handleChangeImage(e) {
        var linkImgDefault = '';

        if (getImage)
            linkImgDefault = getImage;

        else
            linkImgDefault = '/assets/image/img-plus.svg';

        const img = e.files[0];
        const thumbnail = document.getElementById('__thumbnail')
        if (img != undefined) {
            const link = URL.createObjectURL(img);
            thumbnail.src = link;
        } else
            thumbnail.src = linkImgDefault
    }
}