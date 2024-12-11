<style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom right, #6a1b9a, #d32f2f);
            font-family: 'Arial', sans-serif;
            margin: 0;
        }
        .card {
            max-width: 400px;
            width: 100%;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s;
            padding: 20px;
        }
        .card-title {
            color: #5e35b1;
            font-size: 24px;
            margin: 0;
            text-align: center;
        }
        .card-description {
            color: #555;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            width: calc(100% - 20px);
            margin: 0 auto;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: #5e35b1;
            box-shadow: 0 0 0 0.2rem rgba(94, 53, 177, 0.25);
        }
        .payment-methods {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .payment-label {
            cursor: pointer;
            flex: 1;
            text-align: center;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            transition: background 0.2s;
            margin: 0 5px;
        }
        .payment-label:hover {
            background: #f0f0f0;
        }
        .payment-label input {
            display: none;
        }
        .payment-icon {
            font-size: 30px;
            margin-bottom: 10px;
            color: #5e35b1;
        }
        .btn-gradient {
            background: linear-gradient(to right, #5e35b1, #d32f2f);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
            transition: background 0.3s;
            cursor: pointer;
            width: 100%;
        }
        .btn-gradient:hover {
            background: linear-gradient(to right, #4a148c, #c62828);
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<div class="card">
    <h2 class="card-title">Complete Your Payment</h2>
    <p class="card-description">Select a payment method</p>
    
    <div class="form-group">
        <label for="amount" class="form-label">Amount</label>
        <input type="text" id="amount" class="form-control" placeholder="0.00" value="12.00">
    </div>

    <div class="payment-methods">
        <label class="payment-label" for="card">
            <input type="radio" name="paymentMethod" value="card" id="card" class="d-none" checked>
            <i class="fas fa-credit-card payment-icon"></i>
            <span>Card</span>
        </label>
        <label class="payment-label" for="paypal">
            <input type="radio" name="paymentMethod" value="paypal" id="paypal" class="d-none">
            <i class="fab fa-paypal payment-icon"></i>
            <span>PayPal</span>
        </label>
        <label class="payment-label" for="bank">
            <input type="radio" name="paymentMethod" value="bank" id="bank" class="d-none">
            <i class="fas fa-university payment-icon"></i>
            <span>Bank</span>
        </label>
    </div>

    <div id="cardDetails">
        <div class="form-group">
            <label for="card-number" class="form-label">Card Number</label>
            <input type="text" id="card-number" class="form-control" placeholder="1234 5678 9012 3456">
        </div>

        <div class="form-group">
            <label for="expiry-date" class="form-label">Expiry Date</label>
            <div style="display: flex; justify-content: space-between;">
                <input type="text" id="expiry-date" class="form-control" placeholder="MM/YY" style="width: 48%;">
                <input type="text" id="cvv" class="form-control" placeholder="CVV" style="width: 48%;">
            </div>
        </div>
    </div>

    <button class="btn-gradient">
        <i class="fas fa-lock"></i> Pay $<span id="amountDisplay">12.00</span>
    </button>
</div>

<script>
    const paymentLabels = document.querySelectorAll('.payment-label');
    const cardDetails = document.getElementById('cardDetails');
    
    paymentLabels.forEach(label => {
        label.addEventListener('click', () => {
            const paymentMethod = label.querySelector('input').value;
            cardDetails.style.display = paymentMethod === 'card' ? 'block' : 'none';
        });
    });

    // Initialize visibility
    cardDetails.style.display = document.querySelector('input[name="paymentMethod"]:checked').value === 'card' ? 'block' : 'none';
</script>