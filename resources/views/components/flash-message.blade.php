@if (session('status'))
  <div id="flash-message"
    class="w-[97%] mx-auto mt-12 p-6 bg-green-100 text-green-900 text-md text-semibold rounded-md shadow-md flex justify-between items-center">
    <div class="flex justify-start items-center gap-x-3">
      <div class="bg-green-900 text-green-100 size-6 rounded-full flex justify-center items-center">
        <i class="fa-solid fa-check fa-sm"></i>
      </div>
      <div>
        {{ session('status') }}
      </div>
    </div>
    <button onclick="close()">
      <i class="fa-solid fa-xmark fa-lg hover:text-green-600"></i>
    </button>
  </div>

  <script>
    setTimeout(() => {
      document.getElementById('flash-message').classList.add('hidden');
    }, 3000);

    function close() {
      document.getElementById('flash-message').classList.add('hidden');
    }
  </script>
@endif
