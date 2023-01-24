<html moznomarginboxes mozdisallowselectionprint>

<head>
    <title>
        Nota Order
    </title>
    <style type="text/css">
        html {
            font-family: "Inter";
        }

        .content {
            width: 80mm;
            font-size: 10px;
            padding: 20px;
        }

        .content .title {
            text-align: center;
            padding-bottom: 13px
        }

        .content .separate {
            margin-top: 10px;
            margin-bottom: 15px;
            border-top: 1px dashed #000;
        }

        .content .transaction-table {
            width: 100%;
            font-size: 10px;
        }

        .content .transaction-table .text-right {
            text-align: right;
        }

        .content .transaction-table .text-center {
            text-align: center;
        }


        .content .transaction-table tr td {
            vertical-align: top;
        }

        .content .transaction-table .table-tr td {
            padding-top: 7px;
            padding-bottom: 7px;
        }

        .content .transaction-table .border-line {
            height: 1px;
            border-top: 1px dashed #000;
        }

        .content .closing {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
    <script>
        window.print();
        window.onafterprint = function() {
            setTimeout(function() {
                window.close();
            }, 1000);
        }
    </script>
</head>

<body>
    <div class="content">
        <div class="title">
            <div style="text-transform: uppercase;font-size: 15px">
                Sekolah Laravel
            </div>
            <div>
                Jl Pegangsaan Timur No. 15
            </div>
            <div>
                0858-0123-0123
            </div>
        </div>

        <div style="border-top: 1px dashed #000;height: 1px;margin-bottom: 5px"></div>
        <table class="transaction-table" cellspacing="0" cellpadding="0">
            <tr>
                <td>DATE</td>
                <td>:</td>
                <td>{{ $data->created_at }}</td>
            </tr>
            <tr>
                <td>INVOICE</td>
                <td>:</td>
                <td>{{ $data->invoice_code }}</td>
            </tr>
            <tr>
                <td>CASHIER</td>
                <td>:</td>
                <td>{{ $data->cashier->name ?? '' }}</td>
            </tr>
        </table>

        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0">
                <tr class="table-tr">
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                </tr>
                @foreach ($data->transaction_details as $item)
                    <tr>
                        <td>{{ $item->product['name'] }}</td>
                        <td style='text-center'>{{ $item->qty }}</td>
                        <td style='text-center'>{{ (int) $item->product['price'] }}</td>
                        <td class='text-right' colspan="5">{{ number_format($item->price) }}</td>
                    </tr>
                @endforeach
                <tr class="table-tr">
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">
                        TOTAL
                    </td>
                    <td colspan="3" class="text-right">
                        :
                    </td>
                    <td class="text-right">
                        {{ number_format($data->grand_total) }}
                    </td>
                </tr>

                <tr>
                    <td colspan="3" class="text-right">
                        CASH
                    </td>
                    <td colspan="3" class="text-right">
                        :
                    </td>
                    <td class="text-right">
                        {{ number_format($data->cash) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">
                        CHANGE
                    </td>
                    <td colspan="3" class="text-right">
                        :
                    </td>
                    <td class="text-right">
                        {{ number_format($data->change) }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="closing">
            THANK YOU <br>
            SEE YOU LATER
        </div>
    </div>
</body>

</html>
