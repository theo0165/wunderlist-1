<!-- List card -->
<form action="/list" method="get" class="mb-0.5 opacity-0">
    {{csrf_field()}}
    <input type="hidden" name="list_id" value="{{$list['id']}}">
    <button class="w-full max-w-sm m-auto block">
        <div class="w-full h-14 bg-white/50 pl-3 flex items-center rounded-tl-2xl hover:bg-white/60">
            <p class="font-raleway-light text-2xl">{{$list['title']}}</p>
        </div>
    </button>
</form>