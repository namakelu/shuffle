<!-- resources/views/pairings/index.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Pairings</title>
</head>
<body>
    <h1>Generated Pairings</h1>
    
    @foreach ($newPairings as $pairing)
        <ul>
            @foreach ($pairing as $person)
                <li>{{ $person }}</li>
            @endforeach
        </ul>
    @endforeach
</body>
</html>