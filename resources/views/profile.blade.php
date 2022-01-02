<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | Profile</title>
</head>

<body class="m-0 bg-gradient-to-t from-yellow-200 to-rose-200 bg-no-repeat bg-fixed box-border">

    <div>
        <nav class="max-w-[720px] h-12 m-auto flex relative">
            <div class="w-1/3 h-full"></div>
            <div class="w-1/3 h-full relative"><img src="images/logo.svg" alt="" class="h-full m-auto z-10 absolute left-1/2 -translate-x-1/2"></div>
            <div class="w-1/3 h-full flex justify-end items-center relative z-10">
                <div class="w-7 h-6 mr-2 flex flex-col justify-between absolute" id="hamburger">
                    <div class="w-full h-1/6 bg-mainblue-600 rounded-full"></div>
                    <div class="w-full h-1/6 bg-mainblue-600 rounded-full"></div>
                    <div class="w-full h-1/6 bg-mainblue-600 rounded-full"></div>
                </div>
            </div>
            <div class="w-full m-auto right-0 h-screen bg-mainblue-600 absolute z-2 flex justify-center items-center" id="hamburger-panel">
                <div class="flex flex-col gap-6">
                    <a href="{{url('settings')}}" class="flex gap-1"><img src="images/gear-icon.svg" alt="" class="w-6 h-6">
                        <p class="text-white">Settings</p>
                    </a>
                    <form action="/profile" method="post">
                        {{csrf_field()}}
                        <button class="flex gap-1"><img src="images/logout-icon.svg" alt="" class="w-6 h-6">
                            <p class="text-white">Log out</p>
                        </button>

                    </form>

                </div>
            </div>
        </nav>


        <main class="max-w-sm m-auto">
            <div class="w-full flex flex-col items-center mt-12">
                <div class="w-24 h-24 bg-gray-400 rounded-full"></div>
                <a href="{{url('tasks')}}" class="bg-transparent mb-6 mt-6 w-36 h-12 text-sm text-mainblue-600 rounded-md border-2 border-mainblue-600 text-center leading-[2.75rem]">Tasks</a>
                <a href="{{url('lists')}}" class="bg-transparent mb-6 w-36 h-12 text-sm text-mainblue-600 rounded-md border-2 border-mainblue-600 text-center leading-[2.75rem]">Lists</a>
                <p class="mb-4">Due today</p>
            </div>
            @if(empty($tasks))
            <p class="text-gray-600 text-center text-sm">There are no tasks due today.</p>
            @else

            @foreach($tasks as $task)
            @include('includes.taskcard')
            @endforeach

            @endif
        </main>

        <script src="js/animateforms.js"></script>

        <script>
            const hamburger = document.getElementById("hamburger");
            const bars = hamburger.querySelectorAll("div");
            const hamburgerPanel = document.getElementById("hamburger-panel");
            const logo = document.querySelector("nav img");
            let isOpen = false;
            hamburgerPanel.classList.add('hidden');
            hamburger.addEventListener('click', () => {
                hamburgerPanel.classList.toggle('hidden');
                if (!isOpen) {
                    logo.src = 'images/logo-white.svg';
                    bars.forEach((bar) => {
                        bar.style.backgroundColor = "white";
                    });
                    isOpen = true;
                } else {
                    logo.src = 'images/logo.svg';
                    bars.forEach((bar) => {
                        bar.style.backgroundColor = "#0061BB";
                    });
                    isOpen = false;
                }
            });
        </script>

</body>

</html>