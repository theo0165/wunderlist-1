<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
</head>

<body class="h-screen bg-gradient-to-t from-yellow-200 to-rose-200 box-border">

    <main class="w-full h-full flex flex-col justify-center items-center">

        <img src="images/logo.svg" alt="" class="mb-6 w-50">

        <div class="w-72 h-96 bg-white/25 rounded-xl flex flex-col justify-center items-center">
            <h2 class="font-raleway-light text-2xl mt-6">Log in</h2>


            <form action="" method="post" class="w-full h-60 pl-6 pr-6 flex flex-col justify-center items-center">
                <div class="flex flex-col mb-4">
                    <label for="email" class="text-sm">Email</label>
                    <input type="email" name="email" id="email" class="rounded-md h-8">
                </div>
                <div class="flex flex-col">
                    <label for="password" class="text-sm">Password</label>
                    <input type="password" name="password" id="password" class="rounded-md h-8">
                </div>
                <input type="button" value="Log in" class="bg-blue-800 my-6 w-36 h-12 text-sm text-white rounded-md">
            </form>

            <p class="text-sm">No account?</p>
            <button class="bg-transparent mb-6 mt-3 w-36 h-12 text-sm text-black rounded-md border border-black">Sign up!</button>
        </div>

    </main>


</body>

</html>