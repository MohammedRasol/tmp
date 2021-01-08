<!DOCTYPE html>
<html>

<head>
    <title>Alquds Scout Group</title>
    <?php

    // die(print_r($_SESSION['reg_error']));

    // if (isset($_SESSION['error'])) {
    //     $error = $_SESSION['error'];
    //     unset($_SESSION['error']);
    // }


    $error=(get_error('reg_error'));
    $res = receive('res');

    $old = receive("form_inputs");
 
    ?>
    <style type="text/css">
        .a {
            float: right;
            font-size: 110%;
        }

        .b {
            font-size: 115%;


        }

        .c {
            color: blue;
            font-size: 105%;



        }

        .e {

            font-size: 130%;

        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="icon" href="../../public/img/c.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link rel="icon" type="image/png" href="/content/images/favicon-96x96.png" sizes="96x96">-->

</head>

<body class="w3-image">



    <img src="../../public/img/c.png" style="width: 10%; border-radius: 10%; margin-left: 44%;">
    <form method="post" action="../login/signup">
        <div class=" w3-text-blue" style="margin-right: 16%; margin-left: 16%;">
            <table style=" border-radius: 10px; background-color:#e4e5e8;" class="w3-table w3-striped w3-bordered">
                <tr class="d">



                    <td colspan=4 align=center>
                        <center><span class="e"> معلومات الفرد </span></center>
                    </td>

                </tr>
                <tr class="d">
                    <td></td>
                    <td></td>
                    <td><span class="a"><input style="direction: rtl;" class="c" value="<?php if (isset($old['NID'])) echo $old['NID'];  ?>" name="NID" placeholder="الرقم الوطني"></span></td>
                    <td><span class="a">:الرقم الوطني </span></td>
                </tr>
                <tr class="d">
                    <td><span class="a"><input style="direction: rtl;" class="c" type="" value="<?php if (isset($old['barth'])) echo $old['barth'];  ?>" name="barth" placeholder="1996-1-1"></td>
                    <td><span class="a"> :تاريخ الميلاد </span></td>
                    <td><span class="a"><input style="direction: rtl;" class="c" type="" value="<?php if (isset($old['name'])) echo $old['name'];  ?>" name="name" placeholder="الأسم الرباعي"></td>
                    <td><span class="a"> :الاسم </span></td>
                </tr>
                <tr>
                    <td><span class="a"> <input style="direction: rtl;" class="c" type="" name="phone" value="<?php if (isset($old['phone'])) echo $old['phone'];  ?>" placeholder="********07"></td>
                    <td><span class="a"> :رقم الهاتف </span></td>
                    <td><span class="a" style="margin-right: 46%;"><select class="c" style="direction: rtl; width: 248%; " name="add" required>

                                <?php
                                if (isset($old['add']))
                                    echo " <option value='$old[add]' >$old[add]</option> ";
                                else
                                    echo "<option value='' disabled selected>أختر العنوان</option>";

                                ?>
                                <option value="الزرقاء">الزرقاء</option>
                                <option value="عمان">عمان</option>
                                <option value="عجلون">عجلون</option>
                                <option value="اربد">اربد</option>
                                <option value="جرش">جرش</option>
                                <option value="المفرق">المفرق</option>
                                <option value="البلقاء">البلقاء</option>
                                <option value="مأدبا">مأدبا</option>
                                <option value="العقبة">العقبة</option>
                                <option value="الكرك">الكرك</option>
                                <option value="معان">معان</option>
                                <option value="الطفيلة">الطفيلة</option>
                            </select> </span></td>
                    <td><span class="a"> :العنوان</span></td>
                </tr>
                <tr>

                    <td colspan=3><span class="a"><input size=65 style="direction: rtl; " class="c" type="" value="<?php if (isset($old['hobbies'])) echo $old['hobbies'];  ?>" name="hobbies" placeholder="الرسم,كرة القدم,السباحة,....."></td>
                    <td><span class="a"> الهوايات و المهارات</span></td>
                </tr>
                <tr class="d">



                    <td colspan=4 align=center>
                        <center><span class="e"> معلومات ولي الامر </span></center>
                    </td>

                </tr>
                <tr>
                    <td><span class="a"><input style="direction: rtl;" class="c" type="" value="<?php if (isset($old['sjob'])) echo $old['sjob'];  ?>" name="sjob" placeholder="المسمى الوظيفي"></td>
                    <td><span class="a"> :الوظيفة </span></td>
                    <td><span class="a"><input style="direction: rtl;" class="c" type="" value="<?php if (isset($old['sname'])) echo $old['sname'];  ?>" name="sname" placeholder="الأسم الرباعي"></td>
                    <td><span class="a"> :الاسم </span></td>

                </tr>
                <tr>
                    <td><span class="a"><input style="direction: rtl;" class="c" type="" value="<?php if (isset($old['sphone'])) echo $old['sphone'];  ?>" name="sphone" placeholder="********07"></td>
                    <td><span class="a"> :رقم الهاتف </span></td>
                    <td><span class="a" style="margin-right: 46%;"><select class="c" style="direction: rtl; width: 248%;" name="sadd" required>

                                <?php
                                if (isset($old['sadd']))
                                    echo " <option value='$old[sadd]' >$old[sadd]</option> ";
                                else
                                    echo "<option value='' disabled selected>أختر العنوان</option>";

                                ?>
                                <option value="الزرقاء">الزرقاء</option>
                                <option value="عمان">عمان</option>
                                <option value="عجلون">عجلون</option>
                                <option value="اربد">اربد</option>
                                <option value="جرش">جرش</option>
                                <option value="المفرق">المفرق</option>
                                <option value="البلقاء">البلقاء</option>
                                <option value="مأدبا">مأدبا</option>
                                <option value="العقبة">العقبة</option>
                                <option value="الكرك">الكرك</option>
                                <option value="معان">معان</option>
                                <option value="الطفيلة">الطفيلة</option>
                            </select> </span></td>
                    <td><span class="a"> :العنوان</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><span class="a"><input style="direction: rtl;" class="c" type="" value="<?php if (isset($old['rel'])) echo $old['rel'];  ?>" name="rel" placeholder="أب عم خال أخ"></td>
                    <td><span class="a"> :صلة القرابة</span></td>
                </tr>

            </table>
        </div>
        <div style="margin: auto; width: 200px; margin-top: 3%;margin-bottom: 3%;">
            <input class="w3-button w3-btn bt1" type="submit" name="" value="حفظ " style="background-color: gray; border-radius: 10%;">
            <a href="../login">
                <button type="button" class="w3-button w3-btn bt2" style="border-radius: 10%; background: gray ;"> الغاء </button>
            </a>
        </div>
    </form>
    <?php
    if (isset($error)) {
        echo "<div id='i' class='w3-modal' style='display:block;'>";
        echo "<div class='w3-modal-content' style='width:30%;'>";
        echo "<div class='w3-container'>";
        echo "<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
        echo "&times;";
        echo "</span>";

        echo "<b><center><p style=' margin-top: 7%;color: #990000;'>";
        echo "$error";
        echo "</p></center></b>";
        echo "<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=document.getElementById('i').style.display='none'; > اغلاق </button>
                </center>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    } elseif (isset($res) && $res == 1) {
        echo "<div id='i' class='w3-modal' style='display:block;'>";
        echo "<div class='w3-modal-content' style='width:30%;'>";
        echo "<div class='w3-container'>";
        echo "<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
        echo "&times;";
        echo "</span>";

        echo "<b><center><p style=' margin-top: 7%;color: #009900;'>";
        echo "تم تقديم طلبك بنجاح " . "<br>";
        echo "الرجاء أنتظار رد المجموعة";
        echo "</p></center></b>";
        echo "<center>
                <button type='button'class='w3-button w3-btn w3-red'  style='border-radius:10%; margin-top:1%; margin-bottom:5%;'
                 class='w3-button'onclick=location='../login'; > اغلاق </button>
                </center>";
        echo "</div>";
        echo "</div>";
    }
    //   else
    //   {
    //   		echo"<div id='i' class='w3-modal' style='display:block;'>";
    //     echo"<div class='w3-modal-content' style='width:30%;'>";
    //      echo"<div class='w3-container'>";
    //       echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
    //        echo"&times;";
    //       echo"</span>";

    //       echo"<b><center><p style=' margin-top: 7%;color: #990000;'>";
    //         echo"لم تتم الاضافة هناك مشكلة في الاتصال ";
    //       echo"</p></center></b>";
    //       echo"<center>
    //         <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=document.getElementById('i').style.display='none'; > اغلاق </button>
    //         </center>";
    //       echo"</div>";
    //     echo"</div>";

    //    }

    ?>
    <script type="text/javascript" src="../../public/js/jquery-3.3.1.min.js"></script>
</body>

</html>