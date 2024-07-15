import product from "./test.js"
import change from "./edit-products/handleChange.js";

const rowProducts = document.querySelectorAll(`tr[name='row-products']`)
rowProducts?.forEach(row => {
    const id = row.attributes['data-id'].value;
    const toHref = row.attributes['data-href'].value;
    row.addEventListener('click', () => {
        product.handleClickProduct(id, toHref);
    })
})

const changePage = document.querySelector(`#change-page`)
changePage?.addEventListener("click", () => {
    const totalPage = changePage.attributes['data-totalPage'].value;
    const toHref = changePage.attributes['data-href'].value;
    product.handlePageClick(totalPage, toHref);
})

const imgProduct = document.querySelector(`input[name='img-product']`)
imgProduct?.addEventListener("change", () => {
    product.handleChangeImage(imgProduct);
})

change.fetchColors();
change.fetchCategoty();
change.handleChangeColor();