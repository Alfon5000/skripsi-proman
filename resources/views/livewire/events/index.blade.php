<div class="overflow-auto">

  <div class="mb-5">
    <x-primary-button wire:click="$dispatch('open-modal', 'create-event')"><i class="fa-solid fa-plus-square"></i><span
        class="hidden sm:inline sm:ms-2">Create</span></x-primary-button>
  </div>

  <div>
    <div id="calendar"></div>
  </div>

</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new Calendar(calendarEl, {
      events: @json($events),
      firstDay: 1,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,timeGridDay',
      },
      height: 620,
      initialView: 'dayGridMonth',
      eventClick: function(clicked) {
        window.dispatchEvent(new CustomEvent('set-event', {
          detail: {
            eventId: clicked.event.id,
          },
        }));
      },
    });
    calendar.render();
  });
</script>
