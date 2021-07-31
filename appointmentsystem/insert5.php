

<script>
const picker = document.getElementById('date1');
picker.addEventListener('input', function(e){
  var day = new Date(this.value).getUTCDay();
  if([6,0].includes(day)){
    e.preventDefault();
    this.value = '';
    alert('Weekends not allowed');
  }
});

</script>
<input name="date1" id="date1" size="60" type="date" format="MM/DD/YYYY" placeholder="MM/DD/YYYY" />