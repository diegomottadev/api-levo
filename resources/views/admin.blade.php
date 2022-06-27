<h1> Transaccione de las ultimas 48 hs  </h1>
<table class="" style="border:1px solid #ccc">
    <thead>
    <tr>
        <th style="text-align: center">id</th>
        <th style="width:5%;text-align: center">event</th>
        <th style="width:5%;text-align: center">amount</th>
        <th style="width:5%;text-align: center">date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $value)
    <tr>
        <th style="text-align: center">{{ $value['id'] }} </th>
        <th style="width:5%;text-align: center">{{ $value['event'] }}</th>
        <th style="width:5%;text-align: center">{{ $value['ammount'] }}</th>
        <th style="width:5%;text-align: center">{{ $value['account_id'] }}</th>
        <th style="width:5%;text-align: center">{{ $value['created_at'] }}</th>
    </tr>
    @endforeach
    </tbody>
</table>
