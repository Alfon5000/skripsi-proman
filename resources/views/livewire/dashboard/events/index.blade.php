<div class="overflow-auto">
  <h2 class="font-semibold text-xl mb-3">
    <a href="{{ route('events') }}">My Events</a>
  </h2>
  <div id="calendar"></div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'today',
      },
      initialView: 'dayGridMonth',
      firstDay: 1,
      events: @json($events),
      height: 500,
      eventClick: function(clicked) {
        window.dispatchEvent(new CustomEvent('set-event', {
          detail: {
            eventId: clicked.event.id,
          }
        }));
      },
    });
    calendar.render();
  });
</script>
