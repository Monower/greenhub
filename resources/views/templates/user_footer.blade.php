
  {!! Toastr::message() !!}

</body>
<script>
  $(document).ready(function(){
    $('#search').keyup(function(){
      console.log(this.value);

      $('#result').append().html("<p>"+this.value+"</p>")

    })
  })
</script>
</html>