<!doctype html>
<html>
<head>
    <title>Tutor Sign Up - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page" class="register_tutor_page">
    <?php $this->load->view('includes/header'); ?>


    <section id="logOn" style="background-image: url('<?= SITE_IMAGES.'images/'.$register_content['page_image']?>')">
        <div class="flexDv">
            <div class="contain">
                <div class="ouTer">
                    <div class="lSide ckEditor">
                        <h1 style="color: #fff; margin-top: 38%; font-size: 60px;">Start tutoring</h1>
                        <p style="color: #fff; font-size: 24px; letter-spacing: -1px; font-weight: 400;">Start making extra money in your spare time while sharing your knowledge with others. Get started today!</p>
                    </div>
                    <div class="logBlk">
                        <?php if($this->session->flashdata('success')) { ?>
                            <span style="padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;color: #8a6d3b;background-color: #fcf8e3;border-color: #faebcc;"><?php echo $this->session->flashdata('success'); ?></span>
                        <?php } ?>
                        <form action="" method="post" autocomplete="off" class="frmAjax" id="frmSignup_tutor" enctype="multipart/form-data">
                            <h2>Tutor Sign Up</h2>
                            <div class="custom_tab">
                                <p>
                                    <input type="text" id="fname" name="fname" class="txtBox" placeholder="First Name" autofocus required="">
                                    <span class="fname_error"></span>
                                </p>
                                <p>
                                    <input type="text" name="lname" id="lname" class="txtBox" placeholder="Last Name">
                                    <span class="lname_error"></span>
                                </p>
                                <p>
                                    <input type="email" id="email" name="email" class="txtBox" placeholder="Email Address">
                                    <span class="email_error"></span>
                                </p> 
                                <p>
                                    <input type="text" id="phone" name="phone" class="txtBox" placeholder="US Phone Number">
                                    <span class="phone_error"></span>
                                </p>
                                <p>
                                    <input type="password" id="password" name="password" class="txtBox" placeholder="Password min 8 character">
                                    <span class="password_error"></span>
                                </p> 
                            </div>
                            <div class="rememberMe">
                                <div class="lblBtn">
                                    <label for="confirm">Become a Tutor and Create an account to get started, By signing up you agree to our 
                                        <a href="<?= site_url('terms-services')?>">Terms and Conditions</a>,
                                        and
                                        <a href="<?= site_url('privacy-policy')?>">Privacy Policy.</a>
                                    </label>
                                </div>
                            </div>
                            <div class="bTn text-center">
                                <button type="submit" class="webBtn colorBtn lgBtn" id="nextBtn" >Sign up </button>
                            </div>
                            <div class="alertMsg" style="display:none"></div>
                        </form>
                        <div class="haveAccount text-center">
                            <span>Already have an account?</span>
                            <a href="<?= site_url('login')?>">Sign In</a>
                        </div>
                        <ul class="miniNav">
                            <li><a href="<?= site_url('privacy-policy')?>">Privacy Policy</a></li>
                            <li><a href="<?= site_url('contact-us')?>">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="crainly-section">
        <div class="wrapper">
            <div class="crainly-section-title">
                <h3>Why use Crainly?</h3>
            </div>
            <div class="crainly-section-content">
                <div class="crainly-section-content-inner">
                    <div class="crainly-section-content-inner-img">
                        <div class="crainly-section-content-inner-img-cls">
                            <img src="<?= base_url('assets/images/crainly-img-1_new.jpg') ?>">
                        </div>
                    </div>
                    <div class="crainly-section-content-inner-cnt">
                        <h2>Earn extra income in your spare time</h2>
                        <p>Choose what days you want to work, how many hours you want to work, and where you want to work from.</p>
                    </div>
                </div>
                <div class="crainly-section-content-inner">
                    <div class="crainly-section-content-inner-img">
                        <div class="crainly-section-content-inner-img-cls">
                            <img src="<?= base_url('assets/images/crainly-img-3_new.jpg') ?>">
                        </div>
                    </div>
                    <div class="crainly-section-content-inner-cnt">
                        <h2>Easy Payments</h2>
                        <p>No more tracking down your students for payments. Your payments are direct deposited into your bank account.</p>
                    </div>
                </div>
                <div class="crainly-section-content-inner">
                    <div class="crainly-section-content-inner-img">
                        <div class="crainly-section-content-inner-img-cls">
                            <img src="<?= base_url('assets/images/crainly-img-2_new.jpg') ?>">
                        </div>
                    </div>
                    <div class="crainly-section-content-inner-cnt">
                        <h2>Be your own boss</h2>
                        <p>Become your own boss and earn what you deserve based on your qualifications and experience by setting your own rates</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/footer');?>
    <script src="assets/js/jquery.backstretch.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
  var x, i, j, l, ll, selElmnt, a, b, c;
  /*look for any elements with the class "custom-select":*/
  x = document.getElementsByClassName("custom-select");
  l = x.length;
  for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
      });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>
</body>
</html>