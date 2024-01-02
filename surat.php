<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur</title>
    <style>
        /* SURAT */
        .invoice {
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoice-header-left {
            display: flex;
            flex-direction: row;
            margin-bottom: 20px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-info {
            font-size: 14px;
            color: #888;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .invoice-total {
            display: flex;
            justify-content: flex-end;
            font-size: 18px;
            font-weight: bold;
        }

        .invoice-total span {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <!-- onload="window.print()" -->
    <div class="invoice">
        <div class="invoice-header">
            <img src="images/logo-pb.png" alt="">
            <div class="invoice-header-left">

                <div class="invoice-title">Invoice</div>
                <div class="invoice-info">Date: 22 Nov 2023</div>
            </div>
        </div>

        <div class="invoice-details">
            <div>Customer: SMA Katolik St Louis 2 Sby</div>
            <div>Invoice Number: 001</div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>QTY</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Mesin Foto Copy IRA 6075</td>
                    <td>30.000.000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Toner</td>
                    <td>30.000.000</td>
                </tr>
            </tbody>
        </table>

        <div class="invoice-total">
            <span>Total:</span>
            <span>Rp. 60.000.000</span>
        </div>
    </div>
</body>

</html>