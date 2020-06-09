<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Currency</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>



    @foreach($collection as $currency)
    <div class="container">
        <div class="card m-2">
            <div class="card-header bg-info">
                <h4 class="card-title">{{$currency['title']}} --- {{$currency['baseName']}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>link </th>
                        <td>{{$currency['link']}} </td>
                        <th>description </th>
                        <td>{{$currency['description']}} </td>
                    </tr>
                    <tr>
                        <th>pubDate </th>
                        <td>{{$currency['pubDate']}} </td>
                        <th>baseCurrency </th>
                        <td>{{$currency['baseCurrency']}} </td>
                    </tr>
                    <tr>
                        <th>targetCurrency </th>
                        <td>{{$currency['targetCurrency']}} </td>
                        <th>targetName </th>
                        <td>{{$currency['targetName']}} </td>
                    </tr>
                    <tr>
                        <th>exchangeRate </th>
                        <td>{{$currency['exchangeRate']}} </td>
                        <th>inverseRate </th>
                        <td>{{$currency['inverseRate']}} </td>
                    </tr>
                    <tr>
                        <th>inverseDescription </th>
                        <td>{{$currency['inverseDescription']}} </td>

                    </tr>

                </table>

            </div>
        </div>
    </div>

    @endforeach
</body>

</html>
