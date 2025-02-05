<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form method="GET">
            <div class="input-group mb-3">
                <input placeholder="search" class="form-control" type="text" name="name" aria-label="Search nama" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <div class="mt-5">
            <h1 class="text-center">User List</h1>
            @foreach ($users as $user)
                <li>{{ $user->name  }}</li>
            @endforeach
        </div>
    </div>
    
    
</body>
</html>