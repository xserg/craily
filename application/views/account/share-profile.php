<!doctype html>
<html>

<head>
  <title>Share Profile - <?= $site_settings->site_name ?></title>
  <?php $this->load->view('includes/site-master'); ?>
</head>

<body id="home-page">
  <?php $this->load->view('includes/header'); ?>


  <section id="dash">
    <div class="contain-fluid">
      <div class="lBar ease">
        <?php $this->load->view('includes/sidebar'); ?>
      </div>
      <div id="inviteFrnd" class="inSide regular">
        <div class="blk">
          <div class="_header">
            <h3>Share Profile</h3>
          </div>
          <form action="" method="post" autocomplete="off" class="frmAjax" id="frmInvtFrnd">


            <div class="Invite-section">
              <div class="formBlk text-center">
                <div class="Invite-section-tittle">
                  <h5>Share your link</h5>
                </div>

                <div class="refLnk relative" style="margin-top:19px">
                  <!--    <input type="text" name="" id="" class="txtBox" value="-->
                  <?//= site_url('profile/'.doEncode($mem_data->mem_id).'/'.toSlugUrl($mem_data->mem_fname.' '.$mem_data->mem_lname))?>
                  <!--" disabled="">-->
                  <input type="text" name="" id="" class="txtBox" value="<?= site_url('tutor/' . doEncode($mem_data->mem_id)) ?>" disabled="">
                  <!--    <button type="button" class="webBtn colorBtn cpyLink" data-clipboard-text="-->
                  <?//= site_url('profile/'.doEncode($mem_data->mem_id).'/'.toSlugUrl($mem_data->mem_fname.' '.$mem_data->mem_lname)) ?>
                  <!--">Copy </button>-->
                  <button type="button" class="webBtn colorBtn cpyLink" data-clipboard-text="<?= site_url('tutor/' . doEncode($mem_data->mem_id)) ?>">Copy </button>
                </div>
              </div>
              <div class="formBlk text-center">
                <div class="Invite-section-tittle">
                  <h5>Share via Email</h5>
                  <p>We will send your friends an email with your link.</p>
                </div>
                <div class="refLnk relative">
                  <input type="text" name="emails" id="emails" class="txtBox" placeholder="Add friends Email addresses, separated by commas">
                  <button type="submit" class="webBtn colorBtn">Send <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                </div>
                <span class="emailError" style="color:red;"></span>
              </div>
            </div>
            <div class="alertMsg" style="display:none"></div>


          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- dash -->


  <?php $this->load->view('includes/footer'); ?>

  <!-- Clipboard Js -->
  <script type="text/javascript" src="<?= base_url('assets/js/clipboard.min.js') ?>"></script>
  <script type="text/javascript">
    $(function() {
      var clipboard = new ClipboardJS('.cpyLink');
      clipboard.on('success', function(e) {
        $(e.trigger).addClass('copied');
        setTimeout(function() {
          $('.cpyLink').removeClass('copied');
        }, 1500)
      });

      $("#emails").keyup(function() {
        if (IsEmail($(this).val())) {
          $('.emailError').html('');
          $('.webBtn').prop('disabled', false);
        } else {
          $('.webBtn').prop('disabled', true);
          $('.emailError').html('Not a Valid Email!');
        }

        if ($(this).val() == '') {
          $('.emailError').html('');
        }
      });


      function IsEmail(email) {
        // var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var regex = /^([\w+-.%]+@[\w.-]+\.[A-Za-z]{2,4})(,[\w+-.%]+@[\w.-]+\.[A-Za-z]{2,4})*$/;
        if (!regex.test(email)) {
          return false;
        } else {
          return true;
        }
      }

    });
  </script>
</body>

</html>