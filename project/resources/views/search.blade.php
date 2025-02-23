<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Medicines</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Search Medicines</h1>
    <input type="text" id="searchInput" placeholder="Search for medicines...">
    <div id="results"></div>
    <script src="{{ asset('js/search.js') }}"></script>
</body>
</html>
