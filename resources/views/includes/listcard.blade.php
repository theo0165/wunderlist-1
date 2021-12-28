<!-- Task card -->
<form action="/list" method="post" class="mb-0.5 rounded-md hover:bg-white/20">
    {{csrf_field()}}
    <button class="w-full max-w-sm m-auto block">
        <div class="w-full h-14 bg-white/50 flex ">
            <p>List Name</p>
        </div>
    </button>
</form>