<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <title>Listig | Sign up</title>
</head>

<body class="h-screen bg-gradient-to-t from-yellow-200 to-rose-200 box-border">




    <main class="w-full h-full flex flex-col justify-center items-center">
        <img src="images/logo.svg" alt="" class=" w-50">

        <div class="w-72 bg-white/25 mt-3 rounded-xl flex flex-col justify-center items-center shadow-lg shadow-rose-400/10">
            <h2 class="font-raleway-light text-2xl mt-6">Sign up</h2>

            <form action="/signup" method="post" class="w-full h-60 pl-6 pr-6 flex flex-col justify-center items-center">
                {{csrf_field()}}
                <div class="flex flex-col mb-4">
                    <label for="email" class="text-sm">Email</label>
                    <input type="email" name="email" id="email" class="rounded-md w-52 h-8 bg-white/80">
                    @if ($errors->first('email'))
                    <p class="text-sm text-red-600">{{$errors->first('email')}}</p>
                    @endif
                    @if (isset($userexisterror))
                    <p class="text-sm text-red-600">{{$userexisterror}}</p>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label for="password" class="text-sm">Password</label>
                    <input type="password" name="password" id="password" class="rounded-md w-52 h-8 bg-white/80">
                    @if ($errors->first('password'))
                    <p class="text-sm text-red-600">{{$errors->first('password')}}</p>
                    @endif
                </div>
                <button type="submit" class="bg-mainblue-600 my-6 w-36 h-12 text-sm text-white rounded-md">Sign up</button>
            </form>

            <a href="{{url('/')}}" class="mb-6 text-sm text-mainblue-600">Back</a>
        </div>

    </main>



</body>

</html>