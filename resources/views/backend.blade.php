<html>
<head>
<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/assets2/img/logo/icon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="/assets2/img/logo/icon.png">
    <script src="/ckeditor/ckeditor.js"></script>
    <title>不老松</title>
    <link href="/assets/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" />
    <!-- <script src="/assets/plugins/jstree/dist/jstree.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

    @vite('resources/css/app.css')
</head>
<body>
    <div id="app"></div>

    @vite('resources/js/backend.js')
</body>
</html>