@extends('templates.tpl_default')
@section('content')
    <div id="test" class="relative mx-auto w-fit">
        <div id="icon" class="absolute top-[-16px] left-[-16px] text-2xl">🙂</div>
        <svg id="animePath" xmlns="http://www.w3.org/2000/svg" fill="cyan" class="bi bi-arrow-up-circle-fill size-20"
            viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z" />
        </svg>
    </div>
    <div>
        <svg class="bg-yellow-900 mx-auto" id="eV4nAx9k7XJ1" width='400' height='400' xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 400 400" shape-rendering="geometricPrecision"
            text-rendering="geometricPrecision">
            <path style="stroke:cyan;stroke-width:3"
                d="M98.693549,259.493695l-.996827,123.606636l36.882625.996828-1.993656-56.81918l59.809661-.996828-.996827,48.844558l33.892142,3.987311l3.98731-129.587603-35.885798-3.98731L196.382661,300h-60.806491l.996826-52.468238-37.879447,11.961933Z"
                transform="translate(11.96194 1.993656)" fill="none" stroke="#3f5787" stroke-width="1.2" />
            <path d="M300,261.487351v115.632014h42.916339l-.000001-115.632014h-42.916338Z"
                style="stroke:cyan;stroke-width:3" transform="matrix(1 0 0 0.87931 0.000003 47.508171)" fill="none"
                stroke="#3f5787" stroke-width="1.2" />
            <path style="stroke:cyan;stroke-width:3"
                d="M300,222.611069q.000003-2.990483,42.916342,0l-.000001,24.920694L300,249.525418q-.000003-23.923867,0-26.914349Z"
                transform="translate(.000003 19.064277)" fill="none" stroke="#3f5787" stroke-width="1.2" />
        </svg>
    </div>
    <div class="w-fit mx-auto">
        <svg id="demo-svg" height="600" width="800" xmlns="http://www.w3.org/2000/svg">
            <polygon points=" 400 250,450 100,500 250,700 250,550 350,600 500,450 400,300 500,350 350,200 250 "
                style="fill:yellow;stroke:cyan;stroke-width:3" />
        </svg>
    </div>
    <script>
        anime({
            targets: '#eV4nAx9k7XJ1  path',
            strokeDashoffset: [anime.setDashoffset, 0],
            easing: 'easeInOutSine',
            duration: 1500,
            delay: (el, i, t) => {
                console.log(t);
                return i * 1500
            },
            loop: true,
        })
        const pathAnime = anime.path('#animePath path');
        anime({
            targets: "#icon",
            translateX: pathAnime('x'),
            translateY: pathAnime('y'),
            easing: "linear",
            rotate: pathAnime('angle'),
            duration: 5000,
            loop: true
        });
        anime({
            targets: "#demo-svg polygon",
            points: [{
                    value: " 400 250,450 100,500 250,700 250,550 350,600 500,450 400,300 500,350 350,200 250 "
                },
                {
                    value: " 300 150, 450 100, 600 150, 700 250, 700 400, 600 500, 450 500, 300 500, 200 400, 200 250 "
                },
                {
                    value: "250 100, 450 100, 650 100, 700 250, 700 400, 600 600, 450 500, 300 600, 200 400, 200 250"
                }
            ],
            easing: "linear",
            duration: 2000,
            loop: true,
            direction: 'alternate',
        });
    </script>
@endsection
