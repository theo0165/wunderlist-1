<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | Profile</title>
</head>

<body class="h-screen bg-gradient-to-t from-yellow-200 to-rose-200 box-border">

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

    <div class="w-full flex flex-col items-center mt-12">
        <div class="w-24 h-24 bg-gray-400 rounded-full"></div>
        <a href="{{url('tasks')}}" class="bg-transparent mb-6 mt-6 w-36 h-12 text-sm text-mainblue-600 rounded-md border-2 border-mainblue-600 text-center leading-[2.75rem]">Tasks</a>
        <a href="{{url('signup')}}" class="bg-transparent mb-6 w-36 h-12 text-sm text-mainblue-600 rounded-md border-2 border-mainblue-600 text-center leading-[2.75rem]">Lists</a>
        <p class="mb-4">Due today</p>
    </div>

    <div class="max-w-sm m-auto">

        <div class="w-full h-28 bg-white/90 flex mt-1 rounded-md">
            <div class="w-3 h-full bg-red-400 rounded-l-md"></div>
            <div class="w-full h-full flex">
                <div class="w-4/6 h-full px-1 flex flex-col">
                    <p class="font-semibold">Task Title</p>
                    <p class="text-sm">Make an appointment somewhere.</p>
                </div>
                <div class="w-2/6 h-full px-1 flex flex-col items-end">
                    <p class="font-semibold">Due date</p>
                    <p class="text-sm">10 Dec -21</p>
                    <p class="text-sm">10.00 am</p>
                </div>
            </div>
        </div>

    </div>

</body>

</html>