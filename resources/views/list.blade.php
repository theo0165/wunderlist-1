<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | {{$list['title']}}</title>
</head>

<body class="m-0 bg-gradient-to-t from-purple-400 to-sky-200 bg-no-repeat bg-fixed box-border">
    <main class="max-w-sm m-auto">

        <nav class="w-full h-12 flex p-2">
            <div class="w-1/3 h-full"><a href="{{url('profile')}}"><img src="images/home-icon.svg" alt="" class="h-full">
                </a></div>
            <div class="w-1/3 h-full">
                <a href="{{url('lists')}}"><img src="images/list-icon.svg" alt="" class="h-full m-auto">
                </a>
            </div>
            <div class="w-1/3 h-full flex justify-end items-center">
                <form method="post" id="deletetaskform" class="top-2 right-2">
                    {{csrf_field()}}
                    @method('delete')
                    <!-- Since list_id-key is already in url, it can be fetched in request in controller. -->
                    <!-- So no need to post list_id here in post request. -->
                    <!-- Just make sure you are authorized to delete (Logged in user). -->
                    <button type="submit"><img src="images/trash-icon.svg" alt="" class=" w-8 h-8"></button>
                </form>
            </div>
        </nav>

        <form action="/createtask" method="get">
            <input type="hidden" name="list" value="some">
            <button type="submit" class="w-full flex flex-col items-center mt-12 mb-8">
                <p class="font-raleway-light text-2xl">{{$list['title']}}</p>
                <img src="images/add-icon.svg" alt="" class="w-12 h-12 m-4 mb-1">
                <p class="text-sm">New task</p>
            </button>
        </form>


        @if(empty($tasks))
        <p class="text-gray-600 text-center text-sm mt-20">There are no tasks.<br>Click above to add a new one.</p>
        @else
        <p class="ml-3 mb-2 ">Tasks</p>
        @foreach($tasks as $task)
        @include('includes.taskcard')
        @endforeach

        @endif

    </main>

    <script src="js/animateforms.js"></script>

</body>

</html>