<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table class="table table-bordered">
    @foreach($Data as $U)
      <tr>
        <td>
          {{$U->fullname}}
        </td>
        <td>
          {{$U->email}}
        </td>
      </tr>
      @endforeach
    </table>
  </body>
</html>