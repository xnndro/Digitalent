    <!-- Library Bundle Script -->
    <script src="{{asset('../../assets/js/core/libs.min.js')}}"></script>

    <!-- External Library Bundle Script -->
    <script src="{{asset('../../assets/js/core/external.min.js')}}"></script>

    <!-- Widgetchart Script -->
    <script src="{{asset('../../assets/js/charts/widgetcharts.js')}}"></script>

    <!-- mapchart Script -->
    <script src="{{asset('../../assets/js/charts/vectore-chart.js')}}"></script>
    <script src="{{asset('../../assets/js/charts/dashboard.js')}}"></script>

    <!-- fslightbox Script -->
    <script src="{{asset('../../assets/js/plugins/fslightbox.js')}}"></script>

    <!-- Settings Script -->
    <script src="{{asset('../../assets/js/plugins/setting.js')}}"></script>

    <!-- Slider-tab Script -->
    <script src="{{asset('../../assets/js/plugins/slider-tabs.js')}}"></script>

    <!-- Form Wizard Script -->
    <script src="{{asset('../../assets/js/plugins/form-wizard.js')}}"></script>

    <!-- AOS Animation Plugin-->
    <script src="{{asset('../../assets/vendor/aos/dist/aos.js')}}"></script>

    <!-- App Script -->
    <script src="{{asset('../../assets/js/hope-ui.js')}}" defer></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
   <script>
   $(document).on('click', '.btn-danger', function (e) {
   e.preventDefault();
   Swal.fire({
        title: 'Are You Sure??',
        text: "Deleted Data Can't Be Recovered!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Sure!',
        cancelButtonText: 'Cancel'
   },function isConfirm(){
       if (isConfirm) {
           Swal.fire(
               'Terhapus!',
               'Data berhasil dihapus.',
               'success'
           )
       }
   }).then((result) => {
       if (result.value) {
           $(this).closest('form').submit();
       }
   })
});
   
   </script>

