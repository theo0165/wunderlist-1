<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | Log in</title>
</head>

<body class="h-screen bg-gradient-to-t from-yellow-200 to-rose-200 box-border">

    <main class="w-full h-full flex flex-col justify-center items-center">

        <img src="images/logo.svg" alt="" class="w-50">

        @error('email')
        <p>{{ $message }}</p>
        @enderror

        @isset($success)
        <p class="mx-auto text-sm text-center">{{$success}}<br>Log in below to continue.</p>
        @endisset

        <div class="w-72 mt-3 bg-white/25 rounded-xl flex flex-col justify-center items-center shadow-lg shadow-rose-400/10">
            <h2 class="font-raleway-light text-2xl mt-6">Log in</h2>

            <form action="/" method="post" class="w-full h-60 pl-6 pr-6 flex flex-col justify-center items-center">
                {{csrf_field()}}
                <div class="flex flex-col mb-4">
                    <label for="email" class="text-sm">Email</label>
                    <input type="email" name="email" id="email" class="rounded-md w-52 h-8 bg-white/80">
                </div>
                <div class="flex flex-col">
                    <label for="password" class="text-sm">Password</label>
                    <input type="password" name="password" id="password" class="rounded-md w-52 h-8 bg-white/80">
                </div>
                <button type="submit" class="bg-mainblue-600 my-6 w-36 h-12 text-sm text-white rounded-md">Log in</button>
            </form>

            <p class="text-sm">No account?</p>
            <a href="{{url('signup')}}" class="bg-transparent mb-6 mt-3 w-36 h-12 text-sm text-black rounded-md border border-black text-center leading-[2.75rem]">Sign up!</a>
        </div>
    </main>

</body>

</html>