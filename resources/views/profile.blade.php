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
            <div class="w-1/3 h-full"><img src="images/logo.svg" alt="" class="h-full m-auto"></div>
            <div class="w-1/3 h-full flex justify-end items-center">
                <div class="w-9 h-8 mr-2 flex flex-col justify-between" id="hamburger">
                    <div class="w-full h-1/6 bg-mainblue-600 rounded-full"></div>
                    <div class="w-full h-1/6 bg-mainblue-600 rounded-full"></div>
                    <div class="w-full h-1/6 bg-mainblue-600 rounded-full"></div>
                </div>
            </div>
        </nav>

        <div class="w-full right-0 h-[calc(100vh-3rem)] bg-mainblue-600 absolute hidden" id="hamburger-panel">
        </div>

        <main class="max-w-sm m-auto">
            <div class="w-full flex flex-col items-center mt-12">
                <div class="w-24 h-24 bg-gray-400 rounded-full"></div>
                <a href="{{url('tasks')}}" class="bg-transparent mb-6 mt-6 w-36 h-12 text-sm text-mainblue-600 rounded-md border-2 border-mainblue-600 text-center leading-[2.75rem]">Tasks</a>
                <a href="{{url('signup')}}" class="bg-transparent mb-6 w-36 h-12 text-sm text-mainblue-600 rounded-md border-2 border-mainblue-600 text-center leading-[2.75rem]">Lists</a>
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

        <script src="js/animatecards.js"></script>

        <script>
            const hamburger = document.getElementById("hamburger");
            let isOpen = false;
            hamburger.addEventListener('click', () => {
                const hamburgerPanel = document.getElementById("hamburger-panel");
                if (!isOpen) {
                    hamburgerPanel.style.display = "flex";
                    isOpen = true;
                } else {
                    hamburgerPanel.style.display = "none";
                    isOpen = false;
                }
            });
        </script>

</body>

</html>