<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #wrapper {
            min-height: 100vh;
            display: flex;
        }

        #sidebar {
            min-height: 100vh;
            width: 250px;
        }

        #content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>

<body>
    <!-- Sidebar & Content Wrapper -->
    <div id="wrapper">
        <div class="bg-dark text-white p-3" id="sidebar">
            <h2 class="text-center">Admin Panel</h2>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('admin.logout') }}" class="d-inline w-100">
                        @csrf
                        <button type="submit" class="nav-link text-white bg-transparent border-0 w-100 text-start">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @yield('body')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
