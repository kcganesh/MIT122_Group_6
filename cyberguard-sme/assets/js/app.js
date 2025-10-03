document.addEventListener('DOMContentLoaded', () => { 
  // === Mark Training as Complete ===
  document.querySelectorAll('.mark-training').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      fetch('actions/mark_training.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'training_id=' + encodeURIComponent(id)
      })
      .then(res => res.text())
      .then(txt => {
        txt = (txt || '').trim().toLowerCase();
        if (txt.includes("success")) {
          btn.outerHTML = '<div class="status done">Completed</div>';
        } else {
          alert("Error marking training: " + txt);
        }
      });
    });
  });

  // === Announcements: Mark as Read (permanent) ===
  document.querySelectorAll('.announcement').forEach(div => {
    const markBtn = div.querySelector('.mark-read-btn');
    const status = div.querySelector('.read-status');

    if (markBtn) {
      markBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (markBtn.disabled) return;

        const id = div.dataset.id;
        fetch('actions/mark_announcement.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'id=' + encodeURIComponent(id)
        })
        .then(r => r.text())
        .then(txt => {
          txt = (txt || '').trim().toLowerCase();
          if (txt.includes('success')) {
            div.classList.remove('unread');
            div.classList.add('read');
            markBtn.disabled = true;
            markBtn.textContent = 'Read';
            if (status) status.textContent = 'Read';
          } else {
            alert('Failed to mark as read: ' + txt);
          }
        })
        .catch(() => alert('Network error'));
      });
    }
  });
});
