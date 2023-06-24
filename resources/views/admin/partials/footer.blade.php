</section>

<div id="back-top" style="display: none;">
    <a title="Go to Top" href="#">
        <i class="ti-angle-up"></i>
    </a>
</div>

<script src="{{ asset('style/js/jquery1-3.4.1.min.js') }}"></script>

<script src="{{ asset('style/js/popper1.min.js') }}"></script>

<script src="{{ asset('style/js/bootstrap1.min.js') }}"></script>

<script src="{{ asset('style/js/metisMenu.js') }}"></script>

<script src="{{ asset('style/vendors/count_up/jquery.waypoints.min.js') }}"></script>

<script src="{{ asset('style/vendors/chartlist/Chart.min.js') }}"></script>

<script src="{{ asset('style/vendors/count_up/jquery.counterup.min.js') }}"></script>

<script src="{{ asset('style/vendors/niceselect/js/jquery.nice-select.min.js') }}"></script>

<script src="{{ asset('style/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('style/vendors/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('style/vendors/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('style/vendors/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('style/vendors/datatable/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('style/vendors/datatable/js/jszip.min.js') }}"></script>
<script src="{{ asset('style/vendors/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('style/vendors/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('style/vendors/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('style/vendors/datatable/js/buttons.print.min.js') }}"></script>



<script src="{{ asset('style/vendors/calender_js/core/main.js') }}"></script>
<script src="{{ asset('style/vendors/calender_js/interaction/main.js') }}"></script>
<script src="{{ asset('style/vendors/calender_js/daygrid/main.js') }}"></script>
<script src="{{ asset('style/vendors/calender_js/timegrid/main.js') }}"></script>
<script src="{{ asset('style/vendors/calender_js/list/main.js') }}"></script>
<script src="{{ asset('style/js/chart.min.js') }}"></script>


<script src="{{ asset('style/vendors/progressbar/jquery.barfiller.js') }}"></script>

<script src="{{ asset('style/vendors/tagsinput/tagsinput.js') }}"></script>

<script src="{{ asset('style/vendors/text_editor/summernote-bs4.js') }}"></script>
<script src="{{ asset('style/vendors/am_chart/amcharts.js') }}"></script>

<script src="{{ asset('style/vendors/scroll/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('style/vendors/scroll/scrollable-custom.js') }}"></script>
<script src="{{ asset('style/vendors/chart_am/core.js') }}"></script>
<script src="{{ asset('style/vendors/chart_am/charts.js') }}"></script>
<script src="{{ asset('style/vendors/chart_am/animated.js') }}"></script>
<script src="{{ asset('style/vendors/chart_am/kelly.js') }}"></script>
<script src="{{ asset('style/vendors/chart_am/chart-custom.js') }}"></script>

<script src="{{ asset('style/js/custom.js') }}"></script>

<script>
    function goBack() {
        window.history.back();
    }

    const urlParams = new URLSearchParams(window.location.search);
    console.log(urlParams);
    const searchQuery = urlParams.get('search');
    if (searchQuery) {
        // Display the "Go Back" button
        document.getElementById('goBackButton').style.display = 'block';
    } else {
        // Hide the "Go Back" button
        document.getElementById('goBackButton').style.display = 'none';
    }
</script>
