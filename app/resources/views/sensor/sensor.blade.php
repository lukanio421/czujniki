<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="30" >


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Pomiary czujnika</title>
  </head>
  <body>
    <div class="container">

      <div class="row justify-content-center">
        <div class="col-8">
          <table class="table table-striped">
            <thead>
              <tr class="text-center">
                <th scope="col">Lp.</th>
                <th scope="col">Temperatura [°C]</th>
                <th scope="col">Wilgotność [%]</th>
                <th scope="col">Godzina</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pagination['content'] as $index => $row)
                @php
                    $index++;
                @endphp
                <tr class="text-center">
                    <td>{{$index}}</td>
                    <td >{{$row['temperature']}}</td>
                    <td>{{$row['humidity']}}</td>
                    <td>{{$row['time']}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="/results/{{$pagination['prev']}}">Poprzedni</a></li>
                @for ($i = 1; $i < $pagination['pagination']; $i++)
                    @if ($i == $pagination['page'])
                        <li class="page-item"><a class="page-link bg-primary text-white" href="/results/{{$i}}">{{$i}}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="/results/{{$i}}">{{$i}}</a></li>
                    @endif
                @endfor
              <li class="page-item"><a class="page-link" href="/results/{{$pagination['next']}}">Nastęny</a></li>
            </ul>
          </nav>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
