// assets/js/app.js
document.addEventListener('DOMContentLoaded', function(){
  document.querySelectorAll('.mark-training').forEach(function(btn){
    btn.addEventListener('click', function(){
      var id = this.dataset.id;
      fetch('actions/mark_training.php', {
        method:'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'training_id=' + encodeURIComponent(id)
      }).then(r=>r.json()).then(j=>{
        if (j.ok) {
          btn.textContent = 'Completed';
          btn.disabled = true;
          btn.classList.add('disabled');
        } else {
          alert('Error: ' + (j.error || 'unknown'));
        }
      });
    });
  });

  // basic client-side incident form validation
  var incForm = document.getElementById('incidentForm');
  if (incForm) incForm.addEventListener('submit', function(e){
    var t = document.getElementById('title').value.trim();
    if (!t) { e.preventDefault(); alert('Please enter a title'); }
  });

});
