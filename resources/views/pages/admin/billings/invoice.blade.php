<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $billing->id }} - {{ \Carbon\Carbon::parse($billing->billing_month)->format('F Y') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 14px; }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            line-height: 18px;
            color: #555;
            background: #fff;
        }
        h1, h2, h3, h4, h5, h6 { color: #333; }
        .invoice-header { border-bottom: 2px solid #eee; padding-bottom: 15px; margin-bottom: 20px; }
        .invoice-table th, .invoice-table td { padding: 8px; border: 1px solid #eee; }
        .total-box { background-color: #f7f7f7; padding: 10px; border-top: 2px solid #000; }
        .paid-stamp { 
            border: 3px solid green; 
            color: green; 
            padding: 5px 10px; 
            font-size: 20px; 
            font-weight: bold; 
            transform: rotate(-15deg); 
            display: inline-block; 
            margin-left: 20px;
        }
        @media print {
            .no-print { display: none; }
            .invoice-box { box-shadow: none; border: none; }
        }
    </style>
</head>
<body>

    <div class="no-print text-center my-3">
        <button onclick="window.print()" class="btn btn-success me-2">Print Invoice</button>
        <a href="{{ route('billings.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="invoice-box">
        <div class="invoice-header row">
            <div class="col-6">
                <img src="{{ asset('admin-src/assets/img/logo/my_logo.png') }}" alt="Company Logo" 
         style="width: 48px; 
                height: 48px; 
                margin-bottom: 10px;">
                <h3>SwiftNet</h3>
                <p>
                    Dhanmondi Road 4 <br>
                    01717-211311<br>
                    support@swiftnet.com
                </p>
            </div>
            <div class="col-6 text-end">
                <h4 class="mb-0">INVOICE</h4>
                <p class="mb-0">Invoice #{{ $billing->id }}</p>
                <p class="mb-0">Created: {{ \Carbon\Carbon::parse($billing->created_at)->format('d M, Y') }}</p>
                <p>Due Date: {{ \Carbon\Carbon::parse($billing->due_date)->format('d M, Y') }}</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <h5 class="border-bottom pb-1">Billed To:</h5>
            </div>
            <div class="col-6">
                <p class="mb-1"><strong>Customer:</strong> {{ $billing->customer->name ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Phone:</strong> {{ $billing->customer->phone ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Address:</strong> {{ $billing->customer->address ?? 'N/A' }}</p>
            </div>
            <div class="col-6">
                <p class="mb-1"><strong>Username:</strong> {{ $billing->connection->username ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Package:</strong> {{ $billing->package->package_name ?? 'N/A' }} ({{ $billing->package->speed ?? '' }} Mbps)</p>
                <p class="mb-1"><strong>Area:</strong> {{ $billing->connection->distributionBox->area->name ?? 'N/A' }}</p>
            </div>
        </div>

        <table class="table table-sm invoice-table mb-4">
            <thead>
                <tr class="table-secondary">
                    <th width="50%">Description</th>
                    <th class="text-center" width="20%">Billing Month</th>
                    <th class="text-end" width="30%">Amount (BDT)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Monthly Internet Service Fee ({{ $billing->package->package_name ?? 'N/A' }})</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($billing->billing_month)->format('F, Y') }}</td>
                    <td class="text-end">{{ number_format($billing->amount, 2) }}</td>
                </tr>
                @if($billing->discount > 0)
                <tr>
                    <td>Discount Applied</td>
                    <td></td>
                    <td class="text-end text-danger">({{ number_format($billing->discount, 2) }})</td>
                </tr>
                @endif
                <tr class="table-primary">
                    <td colspan="2" class="text-end"><strong>NET AMOUNT PAYABLE</strong></td>
                    <td class="text-end"><strong>৳ {{ number_format($netAmount, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="row">
            <div class="col-7">
                <h5 class="border-bottom pb-1">Payment History:</h5>
                @if($billing->payments->count() > 0)
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Method</th>
                                <th class="text-end">Paid (BDT)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($billing->payments as $payment)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M y') }}</td>
                                <td>{{ ucfirst($payment->payment_method) }}</td>
                                <td class="text-end">{{ number_format($payment->amount, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No payments recorded yet.</p>
                @endif
            </div>
            
            <div class="col-5">
                <div class="total-box">
                    <p class="d-flex justify-content-between mb-1">
                        <span>Net Bill Amount:</span>
                        <strong>৳ {{ number_format($netAmount, 2) }}</strong>
                    </p>
                    <p class="d-flex justify-content-between mb-1 text-success">
                        <span>Total Paid:</span>
                        <strong>৳ {{ number_format($totalPaid, 2) }}</strong>
                    </p>
                    <p class="d-flex justify-content-between h4 border-top pt-2">
                        <span>Amount Due:</span>
                        <strong class="{{ $dueAmount > 0 ? 'text-danger' : 'text-success' }}">৳ {{ number_format($dueAmount, 2) }}</strong>
                    </p>
                    
                    @if($dueAmount == 0 && $netAmount > 0)
                        <div class="paid-stamp">PAID</div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="border-top mt-4 pt-3 text-center">
            <small class="text-muted">Thank you for your timely payment!</small>
        </div>
    </div>

</body>
</html>