<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | Tasks</title>
</head>

<body class="h-screen bg-gradient-to-t from-yellow-200 to-rose-200 box-border">

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
            <a href="" class="w-12 h-12 m-4 mb-1"><img src="images/add-icon.svg" alt=""></a>
            <p class="text-sm">New task</p>
        </div>

        <p class="ml-3">Tasks</p>

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
    </main>



</body>

</html>