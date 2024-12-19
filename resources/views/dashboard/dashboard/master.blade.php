<!DOCTYPE html>


<!-- beautify ignore:start -->
<html  lang="en"  class="light-style layout-menu-fixed"  dir="ltr"  data-theme="theme-default"  data-assets-path="{{ asset('dashboard/assets') }}/"  data-template="vertical-menu-template-free">
{{-- Section Head --}}
        @include('dashboard.layouts.head')
{{-- End  Section Head --}}

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- Menu -->

            @include('dashboard.layouts.saidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

        @include('dashboard.layouts.navbar')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

        @yield('content')
            <!-- / Content -->

            <!-- Footer -->
        @include('dashboard.layouts.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div>

    <!-- Core JS -->
        @include('dashboard.layouts.js')
  </body>
</html>
