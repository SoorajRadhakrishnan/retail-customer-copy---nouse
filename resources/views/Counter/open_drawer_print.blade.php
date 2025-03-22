<style>
    @media print {
        body {font-family: Arial;}
        #wrapper_pr {width: 100%; margin:0 auto; text-align:center; color:#000; font-family: Arial; font-size:12px;}
        .bdd{border-top: 1px solid #000;}
    }
</style>
<meta charset="UTF-8" />
<div id="wrapper_pr">
</div>
<script type="text/javascript">
    var content = document.getElementById('wrapper_pr').innerHTML;
    var win = window.open();
    win.document.write(content);
    win.print(content);
    win.window.close();
    window.location.href = "{{ url('home') }}";
</script>

