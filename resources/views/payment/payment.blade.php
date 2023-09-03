@extends('layouts.app')

@section('content')
    <section class="card">
        <div class="card__wrapper">
            <form class="card__form" method="post" id="payment-form" action="{{ route('subscribe', ['subscriptionId' => $subscription->id]) }}">
                @csrf
            <h3 class="visually-hidden">Оплата картой</h3>
                <input class="card__field card__field--error" data-number="0" type="text" id="numCard"
                       placeholder="Номер карты" autocomplete="off" data-valid="0" data-cp="cardNumber" autofocus=""
                       value="5205000000003055">
                <label class="card__check card__check--num" for="numCard"><span
                        class="visually-hidden">Номер карты</span></label>
                <input class="card__field card__field--nameOwner" data-number="1" type="text" id="nameOwner"
                       data-valid="0" data-cp="name" value="Walter White">
                <label class="card__check card__check--nameOwner" for="nameOwner"><span class="visually-hidden">Walter White</span></label>
                <div class="card__cvv-section">
                    <input class="card__field card__field--month" data-number="2" maxlength="2" type="text" id="month"
                           placeholder="ММ" autocomplete="off" data-valid="0" data-cp="expDateMonth" value="12">
                    <label class="card__check card__check--month" for="month"><span
                            class="visually-hidden">Месяц и год</span></label>
                    <input class="card__field card__field--year" data-number="3" maxlength="2" type="text" id="year"
                           placeholder="ГГ" autocomplete="off" data-valid="0" data-cp="expDateYear" value="24">
                    <label class="card__check card__check--year" for="year"><span
                            class="visually-hidden">Месяц и год</span></label>
                    <input class="card__field card__field--cvv" data-number="4" type="text" id="cvvCard"
                           placeholder="CVC / CVV2" autocomplete="off" data-valid="0" maxlength="3" data-cp="cvv"
                           value="123">
                    <label class="card__check card__check--cvv" for="cvvCard"><span
                            class="visually-hidden">CVV карты</span></label>
                    <input type="hidden" name="cryptogram" id="cryptogram">
                </div>

                <button class="card__btn-pay" id="payButton" type="submit">Оплатить&nbsp;<span
                        class="card__sum-pay">{{ round($subscription->price) }}</span>&nbsp;тг.
                </button>
            </form>
        </div>
    </section>
@endsection

@section('js')
    <link href="https://show.cloudpayments.ru/assets/css/style.min.css" rel="stylesheet">
    <script src="https://checkout.cloudpayments.ru/checkout.js"></script>
    <script>
        document.addEventListener('submit', function (e) {
            e.preventDefault();
            const form = e.target;


            const checkout = new cp.Checkout({
                publicId: 'pk_9cd515fbae45c8a3f25fe6cf03a5f',
                container: form,
            });

            checkout.createPaymentCryptogram().then((cryptogram) => {
                document.getElementById('cryptogram').value = cryptogram;
                form.submit();
            }).catch((errors) => {
                console.log(errors)
            });
        });
    </script>
@endsection
