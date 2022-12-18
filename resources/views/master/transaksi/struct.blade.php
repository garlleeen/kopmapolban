<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title></title>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	</head>
	<body>
		<div class="container text-center">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Product</th>
						<th scope="col">Quantity</th>
						<th scope="col">Total</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                        $no = 1;
                    ?>

                    @foreach($DetailTransaksi as $DT)
                        <tr>
                            <td scope="row">{{ $no++; }}</td>
                            <td scope="row">{{ $DT->product_name }}</td>
                            <td scope="row">{{ $DT->qty }}</td>
                            <td scope="row">{{ $DT->subtotal }}</td>
                        </tr>
                    @endforeach

                    @foreach($Transaksi as $T)
					<tr>
						<td>Total</td>
						<td colspan="3">{{ $T->total_pembayaran }}</td>
					</tr>
                    #endforeach
				</tbody>
			</table>
		</div>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>