@extends('templates.tpl_default')

@section('content')
    <main class="min-h-screen my-dasboard">
        {{-- style="box-shadow: 3px 3px 6px, 9px 9px 18px" --}}
        <div 
            class="grid lg:border min-h-[600px] lg:overflow-hidden lg:mx-20 lg:my-5 lg:border-base-content lg:rounded-lg grid-cols-12">
            <div class="lg:col-span-2 bg-base-200 my-bg border-e border-base-content lg:block hidden">
                @include('Components.Home.left')
            </div>
            <div class="lg:col-span-10 col-span-full">
                @include('Components.Home.right')
            </div>
        </div>
    </main>
    <script>
       
    </script>
@endsection
