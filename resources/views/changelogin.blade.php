<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | Settings</title>
</head>

<body class="m-0 bg-gradient-to-t from-mainblue-600 to-sky-500 bg-no-repeat bg-fixed box-border">


    <nav class="w-full h-12 flex relative">

        <div class="w-1/3 h-full"><a href="{{url('profile')}}"><img src="images/home-icon-white.svg" alt="" class="h-8 m-2">
            </a></div>
        <div class="w-1/3 h-full"><img src="images/logo-white.svg" alt="" class="h-full m-auto z-10 absolute left-1/2 -translate-x-1/2"></div>
        <div class="w-1/3 h-full"></div>
    </nav>


    <main class="w-full h-[calc(100vh-3rem)] flex flex-col justify-center items-center gap-12">

        <form action="/changelogin" method="post" class="w-full pl-6 pr-6 flex flex-col justify-center items-center">
            {{csrf_field()}}
            @method('patch')
            <div class="flex flex-col mb-4">
                <label for="email" class="text-sm text-white">New email</label>
                <input type="email" name="email" id="email" class="rounded-md w-52 h-8 bg-white/80">
                @if ($errors->first('email'))
                <p class="text-sm text-red-600">{{$errors->first('email')}}</p>
                @endif
                @if (isset($userexisterror))
                <p class="text-sm text-red-600">{{$userexisterror}}</p>
                @endif
            </div>
            <div class="flex flex-col">
                <label for="password" class="text-sm text-white">New password</label>
                <input type="password" name="password" id="password" class="rounded-md mb-4 w-52 h-8 bg-white/80">

                <label for="password-confirm" class="text-sm text-white">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password-confirm" class="rounded-md w-52 h-8 bg-white/80">

                @if ($errors->first('password'))
                <p class="w-52 text-sm text-red-600">{{$errors->first('password')}}</p>
                @endif
            </div>
            <button type="submit" class="bg-mainblue-600 my-6 w-36 h-12 text-sm text-white rounded-md">Done</button>
        </form>

        <a href="{{url()->previous()}}" class="mb-6 text-sm text-white">Cancel</a>


    </main>

</body>

</html>