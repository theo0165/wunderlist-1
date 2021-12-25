<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | Task</title>
</head>

<body class="h-screen m-0 bg-gradient-to-t from-yellow-200 to-rose-200 bg-no-repeat bg-fixed box-border">

    <main class="w-full h-full flex flex-col justify-center items-center">

        <div class="w-72 bg-white/25 rounded-xl flex flex-col justify-center items-center relative">

            <form method="post" id="deletetaskform" class="absolute top-2 right-2">
                {{csrf_field()}}
                <button type="submit"><img src="images/trash-icon.svg" alt="" class=" w-8 h-8"></button>
                <input type="hidden" name="id" value="{{$task['id']}}">
                <input type="hidden" name="request" value="delete">
                <input type="hidden" name="back_url" value="{{$task['back_url']}}">
            </form>

            <h2 class="font-raleway-light text-2xl mt-6">Task</h2>

            <form action="" method="post" id="taskform" class="w-full px-6 flex flex-col justify-center items-center">
                {{csrf_field()}}
                <div class="flex flex-col mb-4">
                    <label for="title" class="text-sm">Title</label>
                    <input type="text" name="title" id="title" value="{{$task['title']}}" class="rounded-md w-52 h-8">
                </div>
                <div class="flex flex-col mb-4">
                    <label for="description" class="text-sm">Description</label>
                    <textarea name="description" id="description" cols="30" rows="4" form="taskform" class="rounded-md w-52 resize-none">{{$task['description']}}</textarea>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="deadline" class="text-sm">Due date</label>
                    <input type="datetime-local" name="deadline" id="deadline" value="{{$task['deadline']}}" class="rounded-md w-52 h-8">
                </div>
                <div class="flex flex-col mb-4">
                    <label for="listid" class="text-sm">Add to list</label>
                    <select name="listid" id="listid" class="rounded-md w-52 h-8 bg-white">
                        <option value="">---</option>
                    </select>
                </div>

                <div class="flex flex-col w-52 mb-4">
                    <label for="completed" class="text-sm">Completed</label>
                    @if($task['completed'] === 0)
                    <input type="checkbox" name="completed" id="completed" class="mr-auto">
                    @else
                    <input type="checkbox" name="completed" id="completed" checked class="mr-auto">
                    @endif

                </div>

                <input type="hidden" name="id" value="{{$task['id']}}">
                <input type="hidden" name="request" value="update">
                <input type="hidden" name="back_url" value="{{$task['back_url']}}">


                <button type="submit" class="bg-mainblue-600 my-6 w-36 h-12 text-sm text-white rounded-md">Done</button>
            </form>

            <a href="{{url()->previous()}}" class="mb-6 text-sm text-mainblue-600">Cancel</a>
        </div>
    </main>

</body>

</html>