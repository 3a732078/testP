<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enote</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</head>
<body>
@if(session('errors'))
    <div class="alert alert-success">
        {{session('errors')}}
    </div>
@endif
<div align="center">
    <div  class="card" style="background-color: #F0F0F0 ;width: 1200px;height: 600px;overflow:auto;" >
        <div class="card-body text-left">
            <form action="store" enctype="multipart/form-data" class="form-control-file">
                @csrf
                <table class="table  border-bottom-secondary border-5">
                    <thead>
                    <th width="500px"><h3>收件者: {{$receiver -> name}}</h3></th>

                    <td width="500px" align="right">
                        <button type="submit" class="btn btn-outline-secondary">
                            <b>
                                送出   <img class="mb-1" style="height: 20px" src="https://img.icons8.com/ios/50/000000/check-file.png"/>
                            </b>
                        </button>
                    </td>
                    </thead>

                    <tbody>
                    <tr>
                        <td height="25px" valign="middle">
                        </td>

                        <td height="25px" valign="middle">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

</body>
</html>
