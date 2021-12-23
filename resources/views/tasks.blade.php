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
            <a href="createtask" class="w-12 h-12 m-4 mb-1"><img src="images/add-icon.svg" alt=""></a>
            <p class="text-sm">New task</p>
        </div>

        <p class="ml-3 mb-2 ">Tasks</p>

        @foreach($tasks as $task)
        <!-- Task card -->
        <form action="/edittask" method="post" class="mb-0.5">
            {{csrf_field()}}
            <button class="w-full max-w-sm m-auto block">
                <input type="hidden" name="task_id" value="{{$task['id']}}">
                @if(!$task['completed'])
                <div class="w-full h-28 bg-white/90 flex rounded-md">
                    <div class="w-3 h-full bg-red-400 rounded-l-md"></div>
                    @else
                    <div class="w-full h-28 bg-white/50 flex rounded-md text-black text-opacity-50">
                        <div class="w-3 h-full bg-green-400 rounded-l-md"></div>
                        @endif
                        <div class="w-full h-full flex">
                            <div class="w-4/6 h-full px-1 flex flex-col items-start">
                                <p class="font-semibold text-left">{{$task['title']}}</p>
                                <p class="text-sm text-left">{{$task['description']}}</p>
                            </div>
                            <div class="w-2/6 h-full px-1 flex flex-col items-end">
                                <p class="font-semibold text-right">Due date</p>
                                <p class="text-sm text-right">{{$task['deadline']}}</p>
                            </div>
                        </div>
                    </div>
            </button>
        </form>
        @endforeach

    </main>



</body>

</html>