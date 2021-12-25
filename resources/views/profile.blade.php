<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | Profile</title>
</head>

<body class="m-0 bg-gradient-to-t from-yellow-200 to-rose-200 bg-no-repeat bg-fixed box-border">

    <nav class="w-full h-12 flex">
        <div class="w-1/3 h-full"></div>
        <div class="w-1/3 h-full"><img src="images/logo.svg" alt="" class="h-full m-auto"></div>
        <div class="w-1/3 h-full flex justify-end items-center">
            <div class="w-10 h-8 mr-2 flex flex-col justify-between">
                <div class="w-full h-1/6 bg-mainblue-600 rounded-full"></div>
                <div class="w-full h-1/6 bg-mainblue-600 rounded-full"></div>
                <div class="w-full h-1/6 bg-mainblue-600 rounded-full"></div>
            </div>
        </div>
    </nav>

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

</body>

</html>