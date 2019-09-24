<!doctype html>

<html>
<head>
   <style>
       td{
           padding: 5px;
           text-align:left;
       }
       th{
           padding: 5px;
           text-align:left;
       }
       h2{
           margin-left: 5px;
       }
       h4{
           margin-left: 10px;
       }
       div{
          padding-right: 10px;
           padding-left: 140px;
           padding-bottom: 5px;
           padding-top: 30px;
       }

   </style>
</head>

<body>

<div style="overflow-x: auto" >
    <table >
        <tr>
            <th >
                <h2>
                    Hello, @foreach($user as $name)
                        {{ $name->getUsername()}} !
                    @endforeach
                </h2>
            </th>
        </tr>

        <tr>
            <td>
                <h4> Congratulations !!!! </h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Your Registration has been Accepted </h4>
            </td>
        </tr>
        <tr>
            <td>
                <a class="button button-{{ 'blue' }}" href="{{ 'https://hubsolv.com'}}" target="_blank" rel="noopener">Visit Site</a>
            </td>
        </tr>
    </table>
</div>

<div style="margin-left: 5px">
    <h4> Regrads,<br> Hubsolv </h4>
</div>


</body>

</html>