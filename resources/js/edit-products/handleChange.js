var dataColor = {}
export default {
    async fetchColors() {
        let colors = await axios.post('/api/Color', { action: "getAll" });
        dataColor = colors.data.data;
        const _color_id = document.getElementById('_color_id');
        if (_color_id) {
            colors.data.data.forEach(element => {
                _color_id.innerHTML +=
                    `
                    <option value="${element.color_id}">${element.value}</option>
                `
            });
        }
    },
    async fetchCategoty() {
        let categoty = await axios.post('/api/Category', { action: "getAll" });
        const _category_id = document.getElementById('_category_id');
        if (_category_id) {
            categoty?.data?.data?.forEach(element => {
                _category_id.innerHTML +=
                    `
                    <option value="${element.category_id}">${element.category_name}</option>
                `
            });
        }
    },
    handleChangeColor() {
        const color = document.getElementById('_color_id')
        color?.addEventListener('change', () => {
            dataColor.forEach(element => {
                if (color.value == element.color_id) {
                    const changeColor = document.getElementById('changeColor')
                    changeColor.style.backgroundColor = element.value;
                }
            });
        })

    },
}
