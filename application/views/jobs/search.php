<!doctype html>
<html>
<head>
<title>Search Jobs - <?= $site_settings->site_name?></title>
<?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
<?php $this->load->view('includes/header'); ?>

<main>
<section id="sBanner">
    <div class="contain">
        <div class="content">
            <h1>Find your students online</h1>
            <p>Then book one-to-one Online Lessons to fit your schedule.</p>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Jobs</li>
            </ul>
        </div>
    </div>
</section>
<!-- sBanner -->


<section id="search">
    <div id="layer"></div>
    <div class="circleBtn">
        <a href="javascript:void(0)" id="rsltBtn" class="webBtn">Result</a>
        <a href="javascript:void(0)" id="fltrBtn" class="webBtn">Filter</a>
    </div>
    <div class="contain">
        <div class="flexRow flex">
            <div class="col col1">
                <div class="filters blk">
                    <div class="_header">
                        <h3>Filter By</h3>
                    </div>
                    <form action="" method="" id="searchForm">
                        <input type="hidden" name="lat" id="map_lat">
                        <input type="hidden" name="lng" id="map_lng">
                        <!-- <div class="inBlk">
                            <p>Budget</p>
                            <input type="text" name="price" id="price" value="">
                        </div> -->
                        <div class="inBlk">
                            <p>Distance</p>
                            <input type="text" name="distance" id="distance" value="">
                        </div>
                        <div class="inBlk">
                            <p>Grade Levels</p>
                            <ul class="ctgLst">
                                <li>
                                    <input type="checkbox" id="gradeAll" name="grade" value="all" checked="">
                                    <label for="gradeAll">All / Any</label>
                                </li>
                                <?php foreach ($grade_levels as $key => $grade_level): ?>
                                    <li>
                                        <input type="checkbox" id="grade<?= $grade_level->slug?>" name="grades[]" value="<?= $grade_level->name?>">
                                        <label for="grade<?= $grade_level->slug?>"><?= $grade_level->name?></label>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <!-- <div class="inBlk">
                            <p>Lesson Type</p>
                            <ul class="btnLst">
                                <li><button type="button" class="webBtn">Online</button></li>
                                <li><button type="button" class="webBtn colorBtn">In Person</button></li>
                            </ul>
                        </div>
                        <div class="inBlk">
                            <p>Rating</p>
                            <ul class="ctgLst">
                                <li><div class="rateYo" data-rateyo-rating="20%" data-rateyo-read-only="true"></div></li>
                                <li><div class="rateYo" data-rateyo-rating="40%" data-rateyo-read-only="true"></div></li>
                                <li><div class="rateYo" data-rateyo-rating="60%" data-rateyo-read-only="true"></div></li>
                                <li><div class="rateYo" data-rateyo-rating="80%" data-rateyo-read-only="true"></div></li>
                                <li><div class="rateYo" data-rateyo-rating="100%" data-rateyo-read-only="true"></div></li>
                            </ul>
                        </div>
                        <div class="inBlk">
                            <p>Subject</p>
                            <ul class="ctgLst">
                                <li>
                                    <input type="checkbox" id="subjAll" name="subjAll" checked="">
                                    <label for="subjAll">All / Any</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjAlgebra" id="subjAlgebra">
                                    <label for="subjAlgebra">Algebra</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjPrealgebra" id="subjPrealgebra">
                                    <label for="subjPrealgebra">Prealgebra</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjLinearAlgebra" id="subjLinearAlgebra">
                                    <label for="subjLinearAlgebra">Linear Algebra</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjChemistry" id="subjChemistry">
                                    <label for="subjChemistry">Chemistry</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjOrganicChemistry" id="subjOrganicChemistry">
                                    <label for="subjOrganicChemistry">Organic Chemistry</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjBiochemistry" id="subjBiochemistry">
                                    <label for="subjBiochemistry">Biochemistry</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjSpanish" id="subjSpanish">
                                    <label for="subjSpanish">Spanish</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjEnglish" id="subjEnglish">
                                    <label for="subjEnglish">English</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjACTEnglish" id="subjACTEnglish">
                                    <label for="subjACTEnglish">ACT English</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjEnglishACTReading" id="subjEnglishACTReading">
                                    <label for="subjEnglishACTReading">English - ACT Reading</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjEnglishBibleStudies" id="subjEnglishBibleStudies">
                                    <label for="subjEnglishBibleStudies">English - Bible Studies</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjAccounting" id="subjAccounting">
                                    <label for="subjAccounting">Accounting</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjTaxAccounting" id="subjTaxAccounting">
                                    <label for="subjTaxAccounting">Tax Accounting</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjFinancialAccounting" id="subjFinancialAccounting">
                                    <label for="subjFinancialAccounting">Financial Accounting</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjMedicalCoding" id="subjMedicalCoding">
                                    <label for="subjMedicalCoding">Medical Coding</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjGuitar" id="subjGuitar">
                                    <label for="subjGuitar">Guitar</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="subjStudySkills" id="subjStudySkills">
                                    <label for="subjStudySkills">Study Skills</label>
                                </li>
                            </ul>
                        </div> -->
                    </form>
                </div>
            </div>
            <div class="col col2">
                <form action="" method="post" class="srchBar" id="manualSearch">
                    <ul class="srchLst relative">
                        <li>
                            <input type="text" name="subject" id="subject" class="txtBox" placeholder="Search Subject" value="<?= $get['subject']; ?>">
                        </li>
                        <li>
                            <input type="text" name="zip" id="zip" value="<?= $get['zip']; ?>" class="txtBox" placeholder="Zip Code">
                        </li>
                        <li><button type="submit" class="webBtn colorBtn"><i class="fi-search"></i></button></li>
                    </ul>
                </form>
                <div class="topHead">
                    <h2></h2>
                    <!-- <div class="miniBtn">
                        <select name="sorting" id="sorting" class="txtBox selectpicker">
                            <option value="">Sort By</option>
                            <option value="asc">Price (Low - High)</option>
                            <option value="desc">Price (High - Low)</option>
                        </select>
                    </div> -->
                </div>
                <div class="appLoad"><div class="appLoader"><span class="spiner"></span></div></div>
                <ul class="_job_list" id="srchDta">
                </ul>
                <div id="lstPaging">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- search -->
</main>


<!-- Ion Slider Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/ion.slider.min.css') ?>">
<!-- Ion Slider Js -->
<script type="text/javascript" src="<?= base_url('assets/js/ion.slider.min.js') ?>"></script>
<script type="text/javascript">
    var loop_start = 0, loop_end = 15, per_page = 15, total = 0, paging = '', itemsList = {};

    var xhr = new window.XMLHttpRequest();
    var ajaxSearch = false;
    function searchJobs() {
        $("#searchForm").append('<input type="hidden" name="subject" value="'+$('#subject').val()+'">');
        $("#searchForm").append('<input type="hidden" name="zip" value="'+$('#zip').val()+'">');
        // $("#searchForm").append('<input type="hidden" name="sort" value="'+$('#sorting').val()+'">');

        if(xhr && xhr.readyState != 4){
            xhr.abort();
        }
        if(ajaxSearch)
            return;
        ajaxSearch=true;

        $('#srchDta').hide();
        $('.topHead>h2').html("");
        $('#lstPaging').hide();
        $('#layer, .appLoad').show();
        var params = $("#searchForm").serialize();
        loop_start = 0, loop_end = 15, paging = '', total = 0, itemsList = {};
        $.ajax({
            url: base_url + "/search-jobs",
            data: params,
            dataType: "json",
            method: "POST",
            success: function (rs) {
                if (rs.lstData != undefined && rs.lstData != '') {
                    itemsList = rs.lstData;
                    total = rs.total;
                    paging = rs.paging;
                    per_page = rs.per_page;
                    loop_end = rs.per_page;
                }
                $('#lstPaging').html(paging);
                initRankings();

            },error: function (rs) {
                console.log(rs)
            },
            xhr : function(){
                return xhr;
            }
        })
    }
    function initRankings() {
        $('#srchDta').html('');
        $('#lstPaging').hide();
        $('#layer, .appLoad').show();
        setTimeout(function () {
            if (itemsList && itemsList.length > 0) {
                $.each(itemsList, function (index, obj) {
                    if (loop_start <= index && index < loop_end) {
                        $('#srchDta').append(obj);
                    }
                });
                // refresh_rateYo();
            } else {
                $('#srchDta').append('<li style="width:100%;"><div class="col-md-12 alert alert-info">We couldn\'t find job matching your search criteria Try a searching a different level or a new location.</div></li>');
            }
            $('.topHead>h2').html(total+" matching search.");
            $('#layer, .appLoad').hide();
            $('#srchDta').show();
            $('#lstPaging').show();
            ajaxSearch=false;
        }, 1500);
    }
    $(document).ready(function () {
        $(document).on('click', '#searchPaging li a', function (e) {
            e.preventDefault();
            var page_id = parseInt($(this).data('page'));
            loop_start = (page_id - 1) * per_page;
            loop_end = loop_start + per_page;
            initRankings();
            $('#searchPaging li>a').removeClass('active');
            $(this).addClass('active');
        });

        $('#manualSearch').on('submit',function(e){
            e.preventDefault();
            searchJobs();
        })
        /*$(document).on('change','#sorting',function(){
            searchJobs();
        });*/

        $(document).on('change','#searchForm input[name="grades[]"]',function(){
            if($('#gradeAll').prop('checked'))
                $('#gradeAll').prop('checked',false);
            searchJobs();
        });
        $(document).on('change','#gradeAll',function(){
            if (this.checked) {
                $('input[name="grades[]"]').prop('checked',false)
            }
            searchJobs();
        });

        $('#distance').ionRangeSlider({
            min: 5,
            max: 30,
            from: 30,
            // disable: true,
            // type: 'double',
            // from_fixed: true,
            prettify: function (num) {
                return num+' Miles';
            },
            onFinish: function (data) {
                searchJobs();
            },
            // prefix: 'Km',
            grid: true
        });

        /*$('#price').ionRangeSlider({
            from: 10,
            to: 250,
            min: 10,
            max: 250,
            type: 'double',
            prettify: function (num) {
                return '$' + num;
            },
            onFinish: function (data) {
                searchJobs();
            },
            grid: true
        });
        searchJobs();*/
        var startLat =0, startLng =0;
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                startLat = position.coords.latitude;
                startLng = position.coords.longitude;
                // console.log('Your latitude is :' + startLat + ' and longitude is ' + startLng);
                $('#map_lat').val(startLat);
                $('#map_lng').val(startLng);
                searchJobs();
            }, function () {
            // Do Nothing
                searchJobs();
            });
        }
    });
</script>


<?php $this->load->view('includes/footer'); ?>
</body>
</html>