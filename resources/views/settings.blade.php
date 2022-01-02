<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | Settings</title>
</head>

<body class="m-0 bg-mainblue-600">


    <nav class="w-full h-12 flex relative">

        <div class="w-1/3 h-full"><a href="{{url('profile')}}"><img src="images/home-icon-white.svg" alt="" class="h-8 m-2">
            </a></div>
        <div class="w-1/3 h-full"><img src="images/logo-white.svg" alt="" class="h-full m-auto z-10 absolute left-1/2 -translate-x-1/2"></div>
        <div class="w-1/3 h-full"></div>
    </nav>


    <main class="w-full h-[calc(100vh-3rem)] flex flex-col justify-center items-center gap-12">

        <form action="/settings" method="post">
            <label for="avatar-img" class="text-white flex flex-col items-center gap-2"><img src="images/add-icon-white.svg" alt="" class="w-12 h-12">
                <p>Upload avatar image</p>
            </label>
            <input type="file" name="avatar-img" id="avatar-img" class="hidden">
        </form>

        <form action="/settings" method="post">
            {{csrf_field()}}
            @method('delete')
            <button class="bg-white my-6 w-36 h-12 text-sm rounded-md">
                <div class="flex gap-1 justify-center">

                    <img src="images/delete-user-icon.svg" alt="" class="w-6 h-6">
                    <p class="text-red-600">Delete Account</p>
                </div>
            </button>
        </form>
    </main>



</body>

</html>