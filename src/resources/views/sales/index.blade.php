<h4> Daily Report</h4>
<hr/>
<p>Total daily sales value {{ $totalValue }}</p>

<hr/>
<h4> Sales Details </h4>
<hr/>
@foreach ($sales as $sale)
    <p>Sale id: {{ $sale->id }}</p>
    <p>Seller Name: {{ $sale->name }}</p>
    <p>Seller Email: {{ $sale->email }}</p>
    <p>Sale Value: {{ $sale->value }}</p>
    <p>Sale Comission: {{ $sale->comission }}</p>
    <hr/>
@endforeach