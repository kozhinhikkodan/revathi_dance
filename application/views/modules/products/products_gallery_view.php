
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->






      <main class="main">
        <div class="container">
          <div class="card">
            <div class="card-image">
              <a href="https://bit.ly/34MdBRc" data-fancybox="gallery" data-caption="Caption Images 1">
                <img src="https://bit.ly/34MdBRc" alt="Image Gallery">
              </a>
            </div>
          </div>
          <div class="card">
            <div class="card-image">
              <a href="https://bit.ly/2Nv9zHh" data-fancybox="gallery" data-caption="Caption Images 1">
                <img src="https://bit.ly/2Nv9zHh" alt="Image Gallery">
              </a>
            </div>
          </div>
          <div class="card">
            <div class="card-image">
              <a href="https://bit.ly/2q0iuay" data-fancybox="gallery" data-caption="Caption Images 1">
                <img src="https://bit.ly/2q0iuay" alt="Image Gallery">
              </a>
            </div>
          </div>
          <div class="card">
            <div class="card-image">
              <a href="https://bit.ly/34PEofp" data-fancybox="gallery" data-caption="Caption Images 1">
                <img src="https://bit.ly/34PEofp" alt="Image Gallery">
              </a>
            </div>
          </div>
          <div class="card">
            <div class="card-image">
              <a href="https://bit.ly/2X4z711" data-fancybox="gallery" data-caption="Caption Images 1">
                <img src="https://bit.ly/2X4z711" alt="Image Gallery">
              </a>
            </div>
          </div>
          <div class="card">
            <div class="card-image">
              <a href="https://bit.ly/2rtIqMl" data-fancybox="gallery" data-caption="Caption Images 1">
                <img src="https://bit.ly/2rtIqMl" alt="Image Gallery">
              </a>
            </div>
          </div>
          <div class="card">
            <div class="card-image">
              <a href="https://bit.ly/33xTVAn" data-fancybox="gallery" data-caption="Caption Images 1">
                <img src="https://bit.ly/33xTVAn" alt="Image Gallery">
              </a>
            </div>
          </div>
          <div class="card">
            <div class="card-image">
              <a href="https://bit.ly/2K3jaDa" data-fancybox="gallery" data-caption="Caption Images 1">
                <img src="https://bit.ly/2K3jaDa" alt="Image Gallery">
              </a>
            </div>
          </div>
          <div class="card">
            <div class="card-image">
              <a href="https://bit.ly/2WZ3fe2" data-fancybox="gallery" data-caption="Caption Images 1">
                <img src="https://bit.ly/2WZ3fe2" alt="Image Gallery">
              </a>
            </div>
          </div>
        </div>
      </main>






      <!--end::Dashboard-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Entry-->
</div>
<!--end::Content-->

<style type="text/css">
/** {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  list-style: none;
  text-decoration: none;
}

body {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  font-size: 1rem;
  font-weight: normal;
  line-height: 1.4;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  background: #ffffff;
  color: #333333;
  }*/

  .container {
    padding: 2rem 1rem;
    margin: 0 auto;
    max-width: 68rem;
    width: 100%;
  }

  .main .container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 1rem;
    justify-content: center;
    align-items: center;
  }
  .main .card {
    background: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 3px rgba(0, 0, 0, 0.24);
    color: #333333;
    border-radius: 2px;
  }
  .main .card-image {
    background: #ffffff;
    display: block;
    padding-top: 70%;
    position: relative;
    width: 100%;
  }
  .main .card-image img {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  @media only screen and (max-width: 600px) {
    .main .container {
      display: grid;
      grid-template-columns: 1fr;
      grid-gap: 1rem;
    }
  }

</style>

<script type="text/javascript">
  $(document).ready(function() {
  // Fancybox Config
  $('[data-fancybox="gallery"]').fancybox({
    buttons: [
    "slideShow",
    "thumbs",
    "zoom",
    "fullScreen",
    "share",
    "close"
    ],
    loop: false,
    protect: true
  });
});

  $('body').on('click', '#gallery_btn', function() {
    $('.card-image a').first().trigger('click');
  });


</script>

<script type="text/javascript">
  $('.menu-item-active').removeClass('menu-item-active');

  <?php if($this->session->userdata('user_role')=='sales_man') { ?>
    $('#products_menu').addClass('menu-item-active');
  <?php } else { ?>
    $('#products_menu').addClass('menu-item-open menu-item-here');
    $('#products_menu_1').addClass('menu-item-active');
  <?php } ?>

</script>
