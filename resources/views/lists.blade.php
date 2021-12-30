<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | Tasks</title>
</head>

<body class="m-0 bg-gradient-to-t from-purple-400 to-sky-200 bg-no-repeat bg-fixed box-border">

    <div class="w-72 h-64 bg-gradient-to-t from-purple-200 to-sky-100 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 top-72 rounded-md absolute flex flex-col items-center z-50 shadow-lg shadow-rose-400/10" id="create-panel">
        <h2 class="font-raleway-light text-2xl mt-6">Create list</h2>
        <form action="/lists" method="post" class="w-full h-60 pl-6 pr-6 flex flex-col justify-center items-center">
            {{csrf_field()}}
            <div class="flex flex-col mb-4">
                <label for="title" class="text-sm">Title</label>
                <input type="text" name="title" id="title" class="rounded-md w-52 h-8">
            </div>
            <button type="submit" class="bg-mainblue-600 my-6 w-36 h-12 text-sm text-white rounded-md">Done</button>
        </form>
        <button class="mb-6 text-sm text-mainblue-600" id="cancel-button">Cancel</button>
    </div>

    <main class="max-w-sm m-auto">

        <nav class="w-full h-12 flex p-2">
            <div class="w-1/3 h-full"><a href="{{url('profile')}}"><img src="images/home-icon.svg" alt="" class="h-full">
                </a></div>
            <div class="w-1/3 h-full">

            </div>
            <div class="w-1/3 h-full flex justify-end items-center">

            </div>
        </nav>

        <button class="w-full flex flex-col items-center mt-12 mb-8" id="create-list-button">
            <p>Lists</p>
            <img src="images/add-icon.svg" alt="" class="w-12 h-12 m-4 mb-1">
            <p class="text-sm">New list</p>
        </button>


        @if(empty($lists))
        <p class="text-gray-600 text-center text-sm mt-20">There are no lists.<br>Click above to add a new one.</p>
        @else
        <p class="ml-3 mb-2 ">Tasks</p>


        @endif

        @foreach($lists as $list)
        @include('includes.listcard')
        @endforeach

        <script src="js/animateforms.js"></script>


    </main>

    <script>
        const createListButton = document.getElementById("create-list-button");
        const createPanel = document.getElementById('create-panel');
        const main = document.querySelector('main');
        createPanel.classList.add('hidden');
        createListButton.addEventListener('click', () => {
            createPanel.classList.toggle('hidden');
            main.classList.toggle('blur-sm');
        });
        const cancelButton = document.getElementById('cancel-button');

        cancelButton.addEventListener('click', () => {
            createPanel.classList.toggle('hidden');
            main.classList.toggle('blur-sm');
        });
    </script>


</body>

</html>