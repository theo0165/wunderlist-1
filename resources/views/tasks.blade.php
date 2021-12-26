<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | Tasks</title>
</head>

<body class="m-0 bg-gradient-to-t from-yellow-200 to-rose-200 bg-no-repeat bg-fixed box-border">

    <main class="max-w-sm m-auto">

        <nav class="w-full h-12 flex p-2">
            <div class="w-1/3 h-full"><a href="{{url('profile')}}"><img src="images/home-icon.svg" alt="" class="h-full">
                </a></div>
            <div class="w-1/3 h-full">
                <a href=""><img src="images/list-icon.svg" alt="" class="h-full m-auto">
                </a>
            </div>
            <div class="w-1/3 h-full flex justify-end items-center">

            </div>
        </nav>

        <div class="w-full flex flex-col items-center mt-12 mb-8">
            <p>All tasks</p>
            <a href="createtask" class="w-12 h-12 m-4 mb-1"><img src="images/add-icon.svg" alt=""></a>
            <p class="text-sm">New task</p>
        </div>


        @if(empty($tasks))
        <p class="text-gray-600 text-center text-sm mt-20">There are no tasks.<br>Click above to add a new one.</p>
        @else
        <p class="ml-3 mb-2 ">Tasks</p>

        @foreach($tasks as $task)
        @include('includes.taskcard')
        @endforeach

        @endif

    </main>

    <script src="js/animatecards.js"></script>

</body>

</html>