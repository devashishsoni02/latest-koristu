<script src="{{ asset('js/jquery.min.js') }} "></script>
<script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>

<script>
    function closeScript() {
        setTimeout(function () {
            window.open(window.location, '_self').close();
        }, 1000);
    }

    $( document ).ready(function() {
        var element = document.getElementById('boxes');
        var opt = {
            filename: '{{ \App\Models\Invoice::invoiceNumberFormat($invoice->invoice_id,$invoice->created_by)}}',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A4'}
        };
        html2pdf().set(opt).from(element).save().then(closeScript);
    });

</script>
