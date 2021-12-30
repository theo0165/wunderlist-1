<!-- Task card -->

<form action="/edittask" method="post" class="mb-0.5 opacity-0 rounded-md hover:bg-white/20">
    {{csrf_field()}}
    <button class="w-full max-w-sm m-auto block">
        <input type="hidden" name="task_id" value="{{$task['id']}}">
        <input type="hidden" name="back_route" value="{{basename($_SERVER['PHP_SELF']);}}">
        @if(!$task['completed'])
        <div class="w-full h-28 bg-white/50 flex rounded-md ">
            <div class="w-3 h-full bg-red-400 rounded-l-md"></div>
            @else
            <div class="w-full h-28 bg-white/50 flex rounded-md text-black text-opacity-50">
                <div class="w-3 h-full bg-green-400 rounded-l-md"></div>
                @endif
                <div class="w-full h-full flex">
                    <div class="w-4/6 h-full px-1 flex flex-col items-start">
                        <p class="font-semibold text-left">{{$task['title']}}<span class="text-sm">{{$task['list_title']}}</span></p>
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