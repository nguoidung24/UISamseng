<div class="mb-3 mt-2">
    <p class="py-3 text-md text-center" style="font-family: cursive;">Tháng 5 Còn</p>
    <div class="grid grid-flow-col gap-5 justify-center text-center auto-cols-max">
        <div class="flex flex-col py-2 px-4 bg-base-200 rounded-box text-neutral-content">
            <span class="countdown mx-auto font-mono text-xl">
                <span id="day" style="--value: 0;">
                </span>
            </span>Ngày
        </div>
        <div class="flex flex-col py-2 px-4 bg-base-200 rounded-box text-neutral-content">
            <span class="countdown mx-auto font-mono text-xl">
                <span id="hours" style="--value: 0;">
                </span>
            </span>Giờ
        </div>
        <div class="flex flex-col py-2 px-4 bg-base-200 rounded-box text-neutral-content">
            <span class="countdown mx-auto font-mono text-xl">
                <span id="minutes" style="--value: 0;">
                </span>
            </span>Phút
        </div>
        <div class="flex flex-col py-2 px-4 bg-base-200 rounded-box text-neutral-content">
            <span class="countdown mx-auto font-mono text-xl">
                <span id="seconds" style="--value: 0;">
                </span>
            </span>Giây
        </div>
    </div>
</div>
<div class="text-center">
    <div class="stats">
        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box2" viewBox="0 0 16 16">
                    <path
                        d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3zM7.5 1H3.75L1.5 4h6zm1 0v3h6l-2.25-3zM15 5H1v10h14z" />
                </svg>
            </div>
            <div class="stat-title text-sm">Sản Phẩm</div>
            <div id="totalOrder" class="stat-value text-lg">0</div>
            <div class="stat-desc text-sm">Giao thành công</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-people" viewBox="0 0 16 16">
                    <path
                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                </svg>
            </div>
            <div class="stat-title text-sm">Khách Hàng</div>
            <div id="totalCustomer" class="stat-value text-lg">0</div>
            <div class="stat-desc text-sm">Đã mua hàng</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-cash" viewBox="0 0 16 16">
                    <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                    <path
                        d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
                </svg>
            </div>
            <div class="stat-title text-sm">Tổng</div>
            <div id="doangThu" class="stat-value text-lg">0</div>
            <div class="stat-desc text-sm">Doanh Thu</div>
        </div>

    </div>
</div>
<div class="lg:w-[66%] mx-auto mt-5 overflow-hidden">
    <div id="imgLoading">
        <img class="mx-auto" src="/assets/image/aniLoadding.gif" alt="">
    </div>
    <canvas id="myChart"></canvas>
</div>


<script>
    const ctx = document.getElementById('myChart');
    async function getDasboard() {
        const data = await axios.get('/dasboard');
        return data.data
    }

    async function getChart(params) {
        const {
            customer,
            order,
            doanhThu,
            pendingOrder,
            beingOrder
        } = await getDasboard();
        document.getElementById('totalOrder').innerText = order.totalOrder;
        document.getElementById('totalCustomer').innerText = customer.totalCustomer;
        document.getElementById('doangThu').innerText = Number(doanhThu.total).toLocaleString() + ' đ'
        document.querySelectorAll('.pendingOrder').forEach(element => {
            element.innerHTML =
                `<span class="badge badge-secondary text-base-content">${pendingOrder}</span>`
        });
        document.querySelectorAll('.beingOrder').forEach(element => {
            element.innerHTML = `<span class="badge badge-secondary text-base-content">${beingOrder}</span>`
        });
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7',
                    'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                ],
                datasets: [{
                    data: order.dataOrder,
                        label: 'Số đơn hàng',
                        borderColor: 'green',
                        backgroundColor: 'green',
                        borderWidth: 1
                    },
                    {
                        data: doanhThu.data,
                        type: 'bar',
                        label: 'Doanh thu',
                        borderColor: '#d1a317d6',
                        backgroundColor: '#d1a317d6',
                        borderWidth: 1,
                        yAxisID: "right",
                    }
                ]
            },
            options: {
                // animations: {
                //     tension: {
                //         duration: 1000,
                //         easing: 'linear',
                //         from: 1,
                //         to: 2,
                //         loop: true
                //     }
                // },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Đơn hàng",
                            color: "#636363"
                        },
                        ticks: {
                            color: "#fff",
                            // stepSize: 1,
                            padding: 10,
                        },
                        grid: {
                            color: '#63636363',
                            borderColor: '#63636363',
                            tickColor: '#63636363'
                        },
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Biểu Đồ: Thống Kê Đơn Hàng, Doanh Thu Năm 2024'
                        },
                    },
                    right: {
                        type: "linear",
                        position: "right",
                        deginAtZero: true,
                        title: {
                            display: true,
                            text: "Doanh Thu",
                            color: "#636363"

                        },
                        ticks: {
                            color: "#fff",
                            // callback: function(value, index, values) {
                            //     return value == value.toFixed(0) ? value.toLocaleString() + ' VNĐ' : '';
                            // }
                        }
                    }
                },
            }
        });
    }
    window.addEventListener('resize', () => {
        location.reload();
    });

    function getCountDown() {
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() + 1;
        const currentYear = currentDate.getFullYear();
        return {
            days: getLastDayOfMonth(currentYear, currentMonth) -
                currentDate.getDate(),
            hours: 23 - currentDate.getHours(),
            minutes: 60 - currentDate.getMinutes(),
            seconds: 60 - currentDate.getSeconds(),
            currentMonth: currentMonth
        }
    }

    function getLastDayOfMonth(year, month) {
        return new Date(year, month, 0).getDate();
    }
    const _seconds = document.querySelector('#seconds');
    const _day = document.querySelector('#day');
    const _hours = document.querySelector('#hours');
    const _minutes = document.querySelector('#minutes');

    setInterval(() => {
        const {
            seconds,
            days,
            hours,
            minutes
        } = getCountDown()
        _seconds.style.setProperty('--value', seconds);
        _day.style.setProperty('--value', days);
        _hours.style.setProperty('--value', hours);
        _minutes.style.setProperty('--value', minutes);
    }, 1000);

    async function main() {
        let count = 0
        const setScroll = setInterval(() => {
            window.scrollTo(0, count += 2);
            if (count == 60)
                clearInterval(setScroll);
        }, 0.1);
        await getChart();
        document.querySelector("#imgLoading").innerHTML = ""
    }
    main();
</script>
