<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="generator" content="Hugo 0.83.1">

<title>Elearning</title>

<!-- side bar 範例 -->
<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
<!-- Bootstrap core CSS -->
<link href="{{asset('../assets/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('../sidebars.css')}}" rel="stylesheet">

<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>

<!-- Custom fonts for this template-->
<link href="{{asset('/home/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{asset('/home/css/sb-admin-2.min.css')}}" rel="stylesheet">

<!-- Topbar Navbar -->
<style>
    * {box-sizing: border-box;}
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .topnav {
        overflow: hidden;
        background-color: #e9e9e9;
    }

    .topnav a {
        float: left;
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    .topnav a.active {
        background-color: #2196F3;
        color: white;
    }

    .topnav .search-container {
        float: right;
    }

    .topnav input[type=text] {
        padding: 6px;
        margin-top: 8px;
        font-size: 17px;
        border: none;
    }

    .topnav .search-container button {
        float: right;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background: #ddd;
        font-size: 17px;
        border: none;
        cursor: pointer;
    }

    .topnav .search-container button:hover {
        background: #ccc;
    }

    @media screen and (max-width: 600px) {
        .topnav .search-container {
            float: none;
        }
        .topnav a, .topnav input[type=text], .topnav .search-container button {
            float: none;
            display: block;
            text-align: left;
            width: 100%;
            margin: 0;
            padding: 14px;
        }
        .topnav input[type=text] {
            border: 1px solid #ccc;
        }
    }
</style>

<script>
    function prink_check(){
        var txt;
        if(confirm("一旦儲存就無法還原!!")){
            txt = 1;
            return then(txt);
        }else{
            txt = 0
            return then(txt);
        }
    }

    function then (txt){
        if (txt == 1 ){
            alert("正在更新~~~~");
        }else {
            alert('NO NO NO 不能反悔')
        }
    }

    function serious_check(){
        var txt;
        if(confirm("一旦儲存就無法還原!!")){
            txt = 1;
            return then(txt);
        }else{
            txt = 0
            return then(txt);
        }
    }
</script>
</head>
