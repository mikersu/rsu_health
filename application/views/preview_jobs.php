<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title = ( ! empty( $page_title ) ) ? $page_title : 'MABIN' ; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <?php echo $meta_tag = ( ! empty( $meta_tag ) ) ? $meta_tag : '' ; ?>
    <meta name="Rating" content="general" />
    <meta name="ROBOTS" content="index, follow" />
    <meta name="GOOGLEBOT" content="index, follow" />
    <meta name="FAST-WebCrawler" content="index, follow" />
    <meta name="Scooter" content="index, follow" />
    <meta name="Slurp" content="index, follow" />
    <meta name="REVISIT-AFTER" content="15 days" />
    <meta name="distribution" content="global" />
    <meta name="copyright" content="Copyright" />
    <meta property="og:image" content="<?php echo $this->theme_path; ?>public/images/logo.png"/>
    <link rel="image_src" href="<?php echo $this->theme_path; ?>public/images/logo.png" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->theme_path; ?>public/images/logo.png">

    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/component/galleriffic/css/galleriffic.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/css/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/component/sliderkit/css/sliderkit-core.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/component/selectbox/css/customSelectBox.css" charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/css/front.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/css/bootstrap-responsive-custom.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/js/fancybox/jquery.fancybox.css" />

    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/jquery.easing-1.3.pack.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/jquery.placeholder.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/script.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/component/cufon/cufon-yui.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/component/cufon/web-font.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/component/sliderkit/js/jquery.sliderkit.1.9.2.pack.js"></script>

    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/component/selectbox/js/SelectBox.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/component/gmap3/js/gmap3.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/fancybox/jquery.fancybox.pack.js"></script>
    <script src="<?php echo $this->theme_path; ?>public/js/jwplayer/jwplayer.js"></script>
    <script src="<?php echo $this->theme_path; ?>public/js/jwplayer/jwplayer.html5.js"></script>

<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/html5shiv.js"></script>
<script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/respond.min.js"></script>
<script>
$(document).ready(function() {
$('input, textarea').placeholder();
});
</script>
<![endif]-->

</head>
<body>


    <div id="job" class="main_content default page_preview">
        <div class="container">
            <h1>
                <span class="Helve_BdC page_name">
                    ข้อมุลการสมัครของคุณ : <?php echo $data_config->first_name_th ?> <?php echo $data_config->last_name_th ?>
                </span>
                <a  target="_blank"  href="<?php echo site_url( 'jobs/print_jobs/'.$this_id ) ?>" style="display: block; float: right;">
                    <img style="width: 50px; margin-top: 18px;" src="<?php echo base_url( 'public/themes/mabin/public/images/icons/pdf_print.png' ) ?>" alt="">
                </a>
            </h1>

            <h2>แบบฟอร์มสมัครงาน</h2>
            <?php  
            $jobs_1 = '';
            $jobs_2 = '';        
            foreach ( $data_category as $key => $value ) {
                if ( $value->id == $data_config->jobs_id1 ) {
                    $jobs_1 = $value->title;
                }
                if ( $value->id == $data_config->jobs_id2 ) {
                    $jobs_2 = $value->title;
                }
            }
            ?>
            <div class="form-group">
                <div class="col1">
                    <label>ตำแหน่ง  1 :<span class="require">*</span> :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $jobs_1 ?>" type="text" name="salary1" id="salary1" class="required"></div>
                </div>
                <div class="col2">
                    <label>เงินเดือนที่ต้องการ   :<span class="require">*</span> :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $data_config->salary1 ?>" type="text" name="salary1" id="salary1" class="required"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col1">
                    <label>ตำแหน่ง  2 :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $jobs_2 ?>" type="text" name="salary1" id="salary1" class="required"></div>
                </div>
                <div class="col2">
                    <label>เงินเดือนที่ต้องการ   :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $data_config->salary1 ?>" type="text" name="salary2" id="salary2"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col1">
                    <label>วันที่สามารถเริ่มงานได้   <span class="require">*</span> :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $data_config->start_date ?>" type="text" name="start_date" id="start_date" class="datepicker required hasDatepicker"></div>
                </div>
            </div>

            <h2>ข้อมูลส่วนตัว </h2>
            <div class="form-group">
                <div class="col1">
                    <label>คำนำหน้าชื่อ  <span class="require">*</span> :</label>
                    <div class="wrap_input">
                        <div>
                        <input disabled="" type="radio" value="Mr." <?php echo $retVal = ( $data_config->title_name == 'Mr.' ) ? 'checked="' : '' ; ?> class="regular-radio" name="title_name" id="radio-1-1">
                            <label for="radio-1-1"></label>นาย                                        
                        </div>
                        <div>
                        <input disabled="" type="radio" value="Ms." <?php echo $retVal = ( $data_config->title_name == 'Ms.' ) ? 'checked="' : '' ; ?> class="regular-radio" name="title_name" id="radio-1-2">
                            <label for="radio-1-2"></label>นางสาว                                        
                        </div>
                        <div>
                        <input disabled="" type="radio" value="Mrs." <?php echo $retVal = ( $data_config->title_name == 'Mrs.' ) ? 'checked="' : '' ; ?> class="regular-radio" name="title_name" id="radio-1-3">
                            <label for="radio-1-3"></label>นาง                                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col1">
                    <label>ชื่อ <span class="require">*</span> :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $data_config->first_name_th ?>" type="text" class="required" name="first_name_th" id="first_name_th"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col1">
                    <label>First Name <span class="require">*</span> :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $data_config->first_name_en ?>" type="text" class="required" name="first_name_th" id="first_name_en"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col1">
                    <label>นามสกุล <span class="require">*</span> :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $data_config->last_name_th ?>" type="text" class="required" name="last_name_th" id="last_name_th"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col1">
                    <label>Last Name <span class="require">*</span> :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $data_config->last_name_en ?>" type="text" class="required" name="last_name_en" id="last_name_en"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col1">
                    <label>วัน/เดือน/ปี เกิด   <span class="require">*</span> :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $data_config->birthday ?>" type="text" name="birthday" id="birthday" class="datepicker required hasDatepicker"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col1">
                    <label>เบอร์โทรศัพท์  <span class="require">*</span> :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $data_config->phone ?>" type="text" class="required" name="phone" id="phone"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col1">
                    <label>อีเมล   <span class="require">*</span> :</label>
                    <div class="wrap_input"><input disabled="" value="<?php echo $data_config->email ?>" type="text" class="required email" name="email" id="email"></div>
                </div>
            </div>

            <h2>ประวัติการศึกษา  </h2>

            <div id="accordion2" class="panel-group">
               
                <?php foreach ( $data_education as $key => $value ): ?>

                    <?php  

                    if (  empty( $value->certificate ) AND empty( $value->major ) AND empty( $value->institution ) AND empty( $value->gpa ) ) {
                        continue;
                    }

                    ?>


                    <?php switch ( $value->accordion ) {
                        case '1':
                            $tname = 'มัธยม / ปวช.';
                            break;
                        case '2':
                            $tname = 'อนุปริญญา / ปวส.';
                            break;
                        case '3':
                            $tname = 'ปริญญาตรี';
                            break;
                        case '4':
                            $tname = 'ปริญญาโท';
                            break;
                        case '5':
                            $tname = 'ปริญญาเอก';
                            break;    
                        
                        default:
                            $tname = '-'; 
                            break;

                    } ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#st_<?php echo $value->accordion ?>" data-parent="#accordion" class="collapsed" data-toggle="collapse"><?php echo $tname ?></a>
                                <input disabled="" value="<?php echo $value->accordion ?>" type="hidden" value="2" id="accordion" name="accordion[]">
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="st_<?php echo $value->accordion ?>">
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col1">
                                        <label>วุฒิการศึกษา :</label>
                                        <div class="wrap_input"><input disabled="" value="<?php echo $value->certificate ?>" type="text" name="certificate[]" id="certificate"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col1">
                                        <label>สาขา :</label>
                                        <div class="wrap_input"><input disabled="" value="<?php echo $value->major ?>" type="text" name="major[]" id="major"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col1">
                                        <label>วิชาเอก :</label>
                                        <div class="wrap_input"><input disabled="" value="<?php echo $value->institution ?>" type="text" name="institution[]" id="institution"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col1">
                                        <label>เกรดเฉลี่ย :</label>
                                        <div class="wrap_input"><input disabled="" value="<?php echo $value->gpa ?>" type="text" name="gpa[]" id="gpa"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.panel --- -->
                    
                <?php endforeach ?>


            </div>

            <h2>ประวัติการทำงาน                                 
            <div class="wrap_input">
                <div>
                <input disabled="" type="radio" <?php echo $retVal = ( $data_config->working == 1 ) ? 'checked' : '' ; ?> value="Y" class="regular-radio" name="working" id="radio-1-4">
                    <label for="radio-1-4"></label>Yes
                </div>
                <div>
                <input disabled="" type="radio" <?php echo $retVal = ( $data_config->working == 0 ) ? 'checked' : '' ; ?> value="N" class="regular-radio" name="working" id="radio-1-5">
                    <label for="radio-1-5"></label>No
                </div>
            </div>
        </h2>
        <div id="box_form_work">

        
            <?php foreach ( $data_work as $key => $value ): ?>
                
            <div class="form-group">
                <div class="col1">
                    <label>ประสบการณ์การทำงาน :</label>
                    <input disabled="" type="text" style="width:80px; margin:0 5px 0 10px;" name="work_yy[]" value="<?php echo $value->work_yy ?>" id="work_yy"><span>ปี</span>
                    <input disabled="" type="text" style="width:80px; margin:0 5px 0 10px;" name="work_dd[]" value="<?php echo $value->work_dd ?>" id="work_dd"><span>เดือน</span>
                </div>
            </div>    
            <div class="box_form ">
                <div class="form-group">
                    <div class="col1">
                        <label>วัน/เดือน/ปี เริ่มงาน :</label>
                        <div class="wrap_input"><input disabled="" type="text" name="work_start[]" id="work_start" value="<?php echo $value->work_start ?>" class="datepicker hasDatepicker"></div>
                    </div>
                    <div class="col2">
                        <label>วัน/เดือน/ปี สิ้นสุด :</label>
                        <div class="wrap_input"><input disabled="" type="text" name="work_end[]" id="work_end" value="<?php echo $value->work_end ?>" class="datepicker hasDatepicker"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col1">
                        <label>ชื่อบริษัท :</label>
                        <div class="wrap_input"><input disabled="" type="text" name="work_company[]" id="work_company" value="<?php echo $value->work_company ?>" class=""></div>
                    </div>
                    <div class="col2">
                        <label>ประเภทธุรกิจ :</label>

                        <?php 
                        foreach ( $business_type as $key_type => $value_type ) {
                            
                            if ( $value_type['id_type'] == $value->work_type ) {
                                $name_type = $value_type['name_type'];
                            }
                        }

                         ?>

                        <div class="wrap_input"><input disabled="" type="text" id="work_phone"  value="<?php echo $name_type ?>" name="work_phone[]" class=""></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col1">
                        <label>ที่อยู่  :</label>
                        <div class="wrap_input"><textarea disabled="" id="work_address" name="work_address[]"><?php echo $value->work_address ?></textarea></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col1">
                        <label>โทรศัพท์  :</label>
                        <div class="wrap_input"><input disabled="" type="text" id="work_phone" name="work_phone[]" value="<?php echo $value->work_phone ?>" class=""></div>
                    </div>
                    <div class="col2">
                        <label>บุคคลอ้างอิง :</label>
                        <div class="wrap_input"><input disabled="" type="text" id="work_reference" name="work_reference[]" value="<?php echo $value->work_reference ?>" class=""></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col1">
                        <label>ตำแหน่ง  :</label>
                        <div class="wrap_input"><input disabled="" type="text" id="work_position" name="work_position[]" value="<?php echo $value->work_position ?>" class=""></div>
                    </div>
                    <div class="col2">
                        <label>เงินเดือนล่าสุด :</label>
                        <div class="wrap_input"><input disabled="" type="text" id="work_salary" name="work_salary[]" value="<?php echo $value->work_salary ?>" class=""></div>
                    </div>
                </div>
            </div>


            <?php endforeach ?>



        </div>

        <h2>ความสามารถพิเศษ</h2>
        <div class="form-group">
            <div class="col1">
                <label>ตำแหน่ง  :</label>
                <div class="wrap_input">
                    <div>
                    <input disabled="" type="checkbox" value="" class="regular-checkbox" name="excel" id="checkbox-1-1" <?php echo $retVal = ( $data_config->excel == 1 ) ? 'checked' : '' ; ?> >
                        <label for="checkbox-1-1"></label>Excel
                    </div>
                    <div>
                    <input disabled="" type="checkbox" value="" class="regular-checkbox" name="powerpoint" id="checkbox-1-2" <?php echo $retVal = ( $data_config->powerpoint == 1 ) ? 'checked' : '' ; ?>  >
                        <label for="checkbox-1-2"></label>Power Point
                    </div>
                    <div>
                    <input disabled="" type="checkbox" value="" class="regular-checkbox" name="word" id="checkbox-1-3"  <?php echo $retVal = ( $data_config->word == 1 ) ? 'checked' : '' ; ?> >
                        <label for="checkbox-1-3"></label>Word
                    </div>
                    <div>
                    <input disabled="" type="checkbox" value="" class="regular-checkbox" name="openoffice" id="checkbox-1-4"  <?php echo $retVal = ( $data_config->openoffice == 1 ) ? 'checked' : '' ; ?> >
                        <label for="checkbox-1-4"></label>Open Office
                    </div>
                    <div>
                    <input disabled="" type="checkbox" value="" class="regular-checkbox" name="other" id="checkbox-1-5"  <?php echo $retVal = ( $data_config->other == 1 ) ? 'checked' : '' ; ?> >
                        <label for="checkbox-1-5"></label>อื่นๆ                                        
                    </div>
                    <textarea disabled="" id="other_detail" name="other_detail"><?php echo $data_config->other_detail ?></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col1">
                <label>ด้านภาษาอังกฤษ :</label>
                <div class="wrap_input">
                    <div>
                    <input disabled="" type="radio" value="4" <?php echo $retVal = ( $data_config->english == 4 ) ? 'checked' : '' ; ?> class="regular-radio" name="english" id="radio-1-6">
                        <label for="radio-1-6"></label>ดีมาก                                         
                    </div>
                    <div>
                    <input disabled="" type="radio" value="3" <?php echo $retVal = ( $data_config->english == 3 ) ? 'checked' : '' ; ?> class="regular-radio" name="english" id="radio-1-7">
                        <label for="radio-1-7"></label>ดี                                        
                    </div>
                    <div>
                    <input disabled="" type="radio" value="2" <?php echo $retVal = ( $data_config->english == 2 ) ? 'checked' : '' ; ?> class="regular-radio" name="english" id="radio-1-8">
                        <label for="radio-1-8"></label>ปานกลาง                                        
                    </div>
                    <div>
                    <input disabled="" type="radio" value="1" <?php echo $retVal = ( $data_config->english == 1 ) ? 'checked' : '' ; ?> class="regular-radio" name="english" id="radio-1-9">
                        <label for="radio-1-9"></label>พอใช้                                        
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col1">
                <label>ด้าน Linux :</label>
                <div class="wrap_input">
                    <div>
                    <input disabled="" type="radio" value="4" <?php echo $retVal = ( $data_config->linux == 4 ) ? 'checked' : '' ; ?> class="regular-radio" name="linux" id="radio-1-10">
                        <label for="radio-1-10"></label>ดีมาก                                         
                    </div>
                    <div>
                    <input disabled="" type="radio" value="3" <?php echo $retVal = ( $data_config->linux == 3 ) ? 'checked' : '' ; ?> class="regular-radio" name="linux" id="radio-1-11">
                        <label for="radio-1-11"></label>ดี                                        
                    </div>
                    <div>
                    <input disabled="" type="radio" value="2" <?php echo $retVal = ( $data_config->linux == 2 ) ? 'checked' : '' ; ?> class="regular-radio" name="linux" id="radio-1-12">
                        <label for="radio-1-12"></label>ปานกลาง                                        
                    </div>
                    <div>
                    <input disabled="" type="radio" value="1" <?php echo $retVal = ( $data_config->linux == 1 ) ? 'checked' : '' ; ?> class="regular-radio" name="linux" id="radio-1-13">
                        <label for="radio-1-13"></label>พอใช้                                        
                    </div>
                </div>
            </div>
        </div>

        <h2>ข้อมูลเพิ่มเติม</h2>
        <div class="form-group">
            <div class="col1">
                <label>เอกสารแนบ :</label>
                <?php foreach ( $data_file as $key => $value ): ?>
                    <br><br><a href="<?php echo base_url( $value->file_name ) ?>"> Download File </a>
                <?php endforeach ?>
            </div>
        </div>
    </div>

</div><!-- /.form --- -->                

</div>
</div>


</body>
</html>



