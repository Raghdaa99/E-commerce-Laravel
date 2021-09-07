@if(Session::has('success'))
{{--    <h1>success</h1>--}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire(
        'Added to Cart!',
        '{{Session::get('success')}}',
        'success'
    )
</script>

@endif
@if(Session::has('success_order'))
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire(
            'Thank you For Your Order',
            '{{Session::get('success_order')}}',
            'You will recieve an email of your order details'
        )
    </script>

@endif
