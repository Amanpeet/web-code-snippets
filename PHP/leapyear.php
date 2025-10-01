<!DOCTYPE html>
<html>
<body>
<form method="post" action="">
<br> Birthday
      <br>
      <select id="day" name="day">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option id="29" value="29">29</option>
        <option id="30" value="30">30</option>
        <option id="31" value="31">31</option>
      </select>
      <select id="month" name="month">
        <option value="January">January</option>
        <option class = "feb" value="February">February</option>
        <option value="March">March</option>
        <option value="April">April</option>
        <option value="May">May</option>
        <option value="June">June</option>
        <option value="July">July</option>
        <option value="August">August</option>
        <option value="September">September</option>
        <option value="Octuber">Octuber</option>
        <option value="November">November</option>
        <option value="December">December</option>
      </select>
      <select id="year" name="year">
        <option value="1989">1989</option>
        <option value="1990">1990</option>
        <option value="1991">1991</option>
        <option value="1992">1992</option>
        <option value="1993">1993</option>
        <option value="1994">1994</option>
        <option value="1995">1995</option>
        <option value="1996">1996</option>
        <option value="1997">1997</option>
        <option value="1998">1998</option>
        <option value="1999">1999</option>
        <option value="2000">2000</option>
        <option value="2001">2001</option>
        <option value="2002">2002</option>
        <option value="2003">2003</option>
        <option value="2004">2004</option>
        <option value="2005">2005</option>
        <option value="2006">2006</option>
        <option value="2007">2007</option>
        <!-- <input type="text" name="year" /> -->
        <input type="submit" />
    </form>
</body>
</html>
 
<?php 
 
    if( $_POST ) {   
        //get the year
        $year = $_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        //check if entered value is a number
        if(!is_numeric($year)) {
            echo "Strings not allowed, Input should be a number";
            return;
        }
        
        //multiple conditions to check the leap year
        if( (0 == $year % 4) and (0 != $year % 100) or (0 == $year % 400)) {
           
            if ($month == 'February' && $day > 29) {
                 echo $day ."Date is not valid";
            }
           } //not leap yaer
            if($month == 'February' && $day > 28) {
                echo $day ."date is not valid";
            }

        elseif ($month == 'April'|| $month == 'June' || $month == 'September' || $month =='November' && $day > 30) {
            echo $day ."date is not valid";
        }
         else {
            echo "Date is valid";
        }



 
    }
    
?>
        <!-- <option value="2002">2002</option>
        <option value="2003">2003</option>
        <option value="2004">2004</option>
        <option value="2005">2005</option>
        <option value="2006">2006</option> -->