    

    <!-- SCRIPTS -->
    <!-- Global Required Scripts Start -->
    <script src="{{ asset('adminasset/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('adminasset/js/popper.min.js')}}"></script>
    <script src="{{ asset('adminasset/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('adminasset/js/perfect-scrollbar.js')}}"> </script>
    <script src="{{ asset('adminasset/js/jquery-ui.min.js')}}"> </script>
    <!-- Global Required Scripts End -->

    <!-- Page Specific Scripts Start -->
    <script src="{{ asset('adminasset/js/slick.min.js')}}"> </script>
    <script src="{{ asset('adminasset/js/moment.js')}}"> </script>
    <script src="{{ asset('adminasset/js/jquery.webticker.min.js')}}"></script>
    <script src="{{ asset('adminasset/js/Chart.bundle.min.js')}}"> </script>
    <script src="{{ asset('adminasset/js/Chart.Financial.js')}}"> </script>
    <!-- <script src="js/cryptocurrency.js"> </script> -->
    <!-- Page Specific Scripts Finish -->
    <!-- Date picker -->
    <script src="{{ asset('adminasset/js/datepicker.min.js')}}"></script>
    <script src="{{ asset('adminasset/js/select2.min.js')}}"></script>


    <!-- Page Specific Scripts Start -->
    <script src="{{ asset('adminasset/js/datatables.min.js')}}"> </script>
    <script src="{{ asset('adminasset/js/data-tables.js')}}"> </script>
    <!-- Page Specific Scripts End -->
    <!-- Circular Progress Bar -->
    <script src="{{ asset('adminasset/vendors/jquery-circle-progress/dist/circle-progress.min.js')}}"></script>
    <!-- Mystic core JavaScript -->
    <script src="{{ asset('adminasset/js/framework.js')}}"></script>
    <!--sweeter-->
    <script src="{{ asset('adminasset/js/sweetalert2.min.js')}}"></script>
    <!--rich text-->
    <script src="{{ asset('adminasset/js/jquery.richtext.js')}}"></script>
    <!-- Settings -->
    <script src="{{ asset('adminasset/js/main.js')}}"></script>
    <!-- <script src="js/settings.js"></script> -->


  <!-- <script src="js/settings.js"></script> -->
  <script>
// delete alert


 function destroy(thing, id) {
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to restore  "+thing+" back !",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
  	$('#delete_'+id).submit();
  }
})
}

</script>
  @yield('scripts')
</body>
</html>