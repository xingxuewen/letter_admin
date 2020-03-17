<div class="visible-print text-center">
    {!! QrCode::size(200)->encoding('UTF-8')->generate("http://47.93.57.128/") !!}
    <p>Scan me to return to the original page.</p>
</div>