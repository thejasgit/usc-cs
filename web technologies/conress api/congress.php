<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sunlight Congress API</title>
    <style>
        form {
            text-align: center;
            margin-bottom: 30px;
        }
        
        table {
            margin: 0px auto;
            border: 1px solid black;
            padding: 10px;
        }
        .phptable{
        border-collapse: collapse;
            width:50%;
        }
        .phptable th,.phptable td{
            border: 1px solid black;
            text-align: center;
        }
        
        .tab {
           border: none;
          
        }
        .tab td{
           width:50%;
          
        }
        .details {
            border: 1px solid black;
            margin: 0px auto;
            width: 50%;
            display: none;
        }
        .display-pic{
            margin: 0px auto;
            width: 43%;
           margin-top: 20px;
            margin-bottom: 20px;
            
        }
        .dp-img{
            
            margin-top: 20px;
            margin-bottom: 20px;
        }
        
        .name-align{
    text-align: left !important;
    padding-left: 50px;
        }
    </style>
</head>
<body>
   
   
    <form id="myForm" action="" method="post">
        <h2>Congress Infromation Search</h2>

        <table>
            <tr>
                <td>
                    <label for="congressDatabase">Congress Database</label>
                </td>
                <td>
                    <select name="congressDatabase" id="congressDatabase" >
                       <option selected disabled>select your option</option>
                        <option value="legislators" <?php echo isset($_POST["congressDatabase"])&& ($_POST["congressDatabase"]=="legislators") ?
"selected" : "" ?> >Legislators</option>
                        <option value="committees" <?php echo isset($_POST["congressDatabase"])&&($_POST["congressDatabase"]=="committees" )?
"selected" : "" ?> >Committees</option>
                        <option value="bills" <?php echo isset($_POST["congressDatabase"])&&($_POST["congressDatabase"]=="bills") ?
"selected" : "" ?> >Bills</option>
                        <option value="amendments" <?php echo isset($_POST["congressDatabase"])&&($_POST["congressDatabase"]=="amendments" )?
"selected" : "" ?> >Amendments</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="chamber">Chamber</label>
                </td>
                <td>
                    <input id="chamber1" name="chamber" type="radio" value="senate" checked >Senate
                    <input id="chamber2" name="chamber" type="radio" value="house" <?php echo isset($_POST["chamber"])&& ($_POST["chamber"]=="house" )?
"checked" : "" ?> >House
                </td>
            </tr>
            <tr>
                <td>
                    <label id="keywordLabel" for="keyword"><?php echo isset($_POST["keywordName"])?
$_POST["keywordName"] : "Keyword*" ?></label>
                    <input id="keywordName" name="keywordName" type="hidden" value="<?php echo isset($_POST["keywordName"])?
$_POST["keywordName"] : "" ?>">
                </td>
                <td>
                    <input id="keywordValue" name="keywordValue" type="text" value="<?php echo isset($_POST["keywordValue"]) ?
$_POST["keywordValue"] : "" ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Search" id="search">
                    <input type="button" name="clear" value="Clear" id="clear"> </td>
            </tr>
            <tr>
                <td colspan="2"><a href="http://sunlightfoundation.com/" target="_blank">Powered by Sunlight Foundation</a></td>
            </tr>
        </table>


    </form>
    <div class="details" id="memberdetail">
    <div class="display-pic" >
    <img id="dp" src="" alt="">
    </div>
    <table class="tab">
    <tr>
        <td>Full Name</td>
        <td id="fullName"></td>
    </tr>
    <tr>
        <td>Term Ends on</td>
        <td id="term"></td>
    </tr>
    <tr>
        <td>Website</td>
        <td><a  target="_blank" id="website"></a></td>
    </tr>
    <tr>
        <td>Office</td>
        <td id="office"></td>
    </tr>
    <tr>
        <td>Facebook</td>
        <td><a  target="_blank" id="facebook"></a></td>
    </tr>
    <tr>
        <td>Twitter</td>
        <td><a  target="_blank" id="twitter"></a></td>
    </tr>    
        
    </table>
    </div>
    
    <div class="details" id="bills">
   
    <table class="tab">
    <tr>
        <td>Bill ID</td>
        <td id="billid"></td>
    </tr>
    <tr>
        <td>Bill Title</td>
        <td id="billtitle"></td>
    </tr>
    <tr>
        <td>Sponsor</td>
        <td id="sponsor"></td>
    </tr>
    <tr>
        <td>Introduced On</td>
        <td id="intro"></td>
    </tr>
    <tr>
        <td>Last action with date</td>
        <td id="lastaction"></td>
    </tr>
    <tr>
        <td>Bill URL</td>
        <td><a  target="_blank" id="billurl"></a></td>
    </tr>    
        
    </table>
    </div>
    <div id="contents">
    <?php 
    error_reporting(0);
    
    $state_array = array(
"ALABAMA" =>  "AL",
"MONTANA" =>  "MT",
"ALASKA" =>  "AK",
"NEBRASKA" =>  "NE",
"ARIZONA" =>  "AZ",
"NEVADA" =>  "NV",
"ARKANSAS" =>  "AR",
"NEW HAMPSHIRE" =>  "NH",
"CALIFORNIA" =>  "CA",
"NEW JERSEY" =>  "NJ",
"COLORADO" =>  "CO",
"NEW MEXICO" =>  "NM",
"CONNECTICUT" =>  "CT",
"NEW YORK" =>  "NY",
"DELAWARE" =>  "DE",
"NORTH CAROLINA" =>  "NC",
"DISTRICT OF COLUMBIA" =>  "DC",
"NORTH DAKOTA" =>  "ND",
"FLORIDA" =>  "FL",
"OHIO" =>  "OH",
"GEORGIA" =>  "GA",
"OKLAHOMA" =>  "OK",
"HAWAII" =>  "HI",
"OREGON" =>  "OR",
"IDAHO" =>  "ID",
"PENNSYLVANIA" =>  "PA",
"ILLINOIS" =>  "IL",
"RHODE ISLAND" =>  "RI",
"INDIANA" =>  "IN",
"SOUTH CAROLINA" =>  "SC",
"IOWA" =>  "IA",
"SOUTH DAKOTA" =>  "SD",
"KANSAS" =>  "KS",
"TENNESSEE" =>  "TN",
"KENTUCKY" =>  "KY",
"TEXAS" =>  "TX",
"LOUISIANA" =>  "LA",
"UTAH" =>  "UT",
"MAINE" =>  " ME",
"VERMONT" =>  "VT",
"MARYLAND" =>  " MD",
"VIRGINIA" =>  "VA",
"MASSACHUSETTS" =>  "MA",
"WASHINGTON" =>  "WA",
"MICHIGAN" =>  "MI",
"WEST VIRGINIA" =>  "WV",
"MINNESOTA" =>  "MN",
"WISCONSIN" =>  "WI",
"MISSISSIPPI" =>  " MS",
"WYOMING" =>  "WY",
"MISSOURI" =>  "MO"
 );
    
     $end_point = 'http://congress.api.sunlightfoundation.com/';
     $api_key = '&per_page=50&apikey=91ab9c55bc1b46e08dd7860add802edf';
    ?>
   
  
    <?php if(isset($_POST['submit'])){
    
    $congress = $_POST['congressDatabase'];
        $chamber = $_POST['chamber'];
    if($congress == 'legislators'){
        
         if(!empty($state_array[strtoupper(trim($_POST['keywordValue']))])){
  $state =  $state_array[strtoupper($_POST['keywordValue'])];
                
        $url = $end_point . $congress . '?chamber=' . $chamber . '&state=' . $state . $api_key;
            
        }
        else {
            
            if(sizeof(preg_split('/\s+/', trim($_POST['keywordValue'])))>1){
                
                //$nameslice = explode(' ',trim($_POST['keywordValue']));
               $nameslice= preg_split('/\s+/', trim($_POST['keywordValue']));
                
                //var_dump($nameslice);
              //  $complete_name = '';
               $nameslice = array_map("make_ucfirst" , $nameslice);
                $complete_name = implode("+", $nameslice);
               // echo $complete_name;
               
                $url = $end_point . $congress . '?chamber=' . $chamber . '&aliases=' .$complete_name . $api_key;
                
                
                
            }else{
            
            $url = $end_point . $congress . '?chamber=' . $chamber . '&query=' . rawurlencode(trim($_POST['keywordValue'])) . $api_key;
            }
            
        }
        
        
        $response = call_sunlight_api($url);
        if(sizeof($response)==0 && isset($complete_name)){
            //calling lastname with 2 lastname
            $url = $end_point . $congress . '?chamber=' . $chamber . '&last_name=' .$complete_name . $api_key; 
             $response = call_sunlight_api($url);
           // echo 'calling lastname';
            
            
        }
       print_legislator_table($response);
        
      
    }else if($congress == 'committees'){
        
        $committee_id  = strtoupper(trim($_POST['keywordValue']));
        $url = $end_point . $congress . '?chamber=' . $chamber . '&committee_id=' . rawurlencode($committee_id) . $api_key;
         $response = call_sunlight_api($url);
       print_committee_table($response);
        
    }else if($congress == 'bills'){
        
         $bill_id  = (trim($_POST['keywordValue']));
        $url = $end_point . $congress . '?chamber=' . $chamber . '&bill_id=' . rawurlencode(strtolower($bill_id)) . $api_key;
         $response = call_sunlight_api($url);
       print_bills_table($response);
        
    }else if($congress == 'amendments'){
        
        $amendment_id  = (trim($_POST['keywordValue']));
        $url = $end_point . $congress . '?chamber=' . $chamber . '&amendment_id=' . rawurlencode(strtolower($amendment_id)) . $api_key;
         $response = call_sunlight_api($url);
       print_amends_table($response);
        
    }
}
    
        
        function make_ucfirst($word){
            
            return ucfirst(trim(strtolower($word)));
        }
        
        function call_sunlight_api($url){
            
            
            
             $response = file_get_contents($url);
        $response = json_decode($response,true);
         $results_array = $response['results'];
            
            if($response['count']>50){
           
                for($page = 2; $page<= ceil($response['count']/50); $page++ ){
                    
                    $url .= '&page=' . $page;
                 
                    $response2 = file_get_contents($url);
                     $response2 = json_decode($response2,true);
                    if(sizeof($response2['results'])>0)
                    $results_array=array_merge($results_array, $response2['results']);
                }
                
            }
            
            return $results_array;
            
        }
        
    function print_legislator_table($response){
        
       
        if(sizeof($response)!=0){
       
            
            echo '<table id="phptable" class="phptable"><tr><th>Name</th><th>State</th><th>Chamber</th><th>Details</th></tr>';
            for($i=0;$i<sizeof($response);$i++){
                echo '<tr>';
                echo '<td class="name-align" >' .$response[$i]['first_name'] . ' ' . $response[$i]['last_name'] . '</td>';
                echo '<td>' .$response[$i]['state_name'] . '</td>';
                 echo '<td>' . $response[$i]['chamber'] . '</td>';
               
                 echo "<td> <a href='javascript:void(0)' onclick='getDetails(".json_encode($response[$i], JSON_HEX_APOS).")' >View Details</a></td>";
                       echo '</tr>';
            }
        echo '</table>';
        }
        else echo '<p style="text-align:center"><b>The API returned zero
results for the request.</b></p>';
        
    }
        
    function print_committee_table($response){
        
        
         if(sizeof($response)!=0){
        echo '<table id="phptable" class="phptable"><tr><th>Committee ID</th><th>Committee Name</th><th>Chamber</th></tr>';
            for($i=0;$i<sizeof($response);$i++){
                echo '<tr>';
                echo '<td>' .$response[$i]['committee_id']  . '</td>';
                echo '<td>' .(isset($response[$i]['name'])? $response[$i]['name'] : 'NA') . '</td>';
                 echo '<td>' . $response[$i]['chamber'] . '</td>';
                       echo '</tr>';
            
            }
        echo '</table>';
        }
        else echo '<p style="text-align:center"><b>The API returned zero
results for the request.</b></p>';
        
    }
        
        
        function print_bills_table($response){
        
            $pattern = "/'/";
        
        if(sizeof($response)!=0){
        echo '<table id="phptable" class="phptable"><tr><th>Bill ID</th><th>Short Title</th><th>Chamber</th><th>Details</th></tr>';
            for($i=0;$i<sizeof($response);$i++){
                echo '<tr>';
                echo '<td>' .$response[$i]['bill_id'] .  '</td>';
                echo '<td>' . (isset($response[$i]['short_title'])? $response[$i]['short_title'] : 'NA') . '</td>';
                 echo '<td>' . $response[$i]['chamber'] . '</td>';
               
                 echo "<td> <a href='javascript:void(0)' onclick='getBill(".json_encode($response[$i], JSON_HEX_APOS).")' >View Details</a></td>";
                       echo '</tr>';
            
            }
        echo '</table>';
        }
        else echo '<p style="text-align:center"><b>The API returned zero
results for the request.</b></p>';
        
    }
        
        function print_amends_table($response){
        
        
        if(sizeof($response)!=0){
        echo '<table id="phptable" class="phptable"><tr><th>Amendment ID</th><th>Amendment Type</th><th>Chamber</th><th>Introduced on</th></tr>';
            for($i=0;$i<sizeof($response);$i++){
                echo '<tr>';
                echo '<td>' .$response[$i]['amendment_id'] .  '</td>';
                echo '<td>' .(isset($response[$i]['amendment_type'])? $response[$i]['amendment_type'] : 'NA') . '</td>';
                 echo '<td>' . (isset($response[$i]['chamber'])? $response[$i]['chamber'] : 'NA' ). '</td>';
               
                 echo '<td>'.(isset($response[$i]['introduced_on'])? $response[$i]['introduced_on'] : 'NA' ).' </td>';
                       echo '</tr>';
            
            }
        echo '</table>';
        }
        else echo '<p style="text-align:center"><b>The API returned zero
results for the request.</b></p>';
        
    }
        
    ?>    
    </div>
    
    <script>
        
        function getBill(bill){
            
            document.getElementById('bills').style.display = 'block';
            document.getElementById('phptable').style.display = 'none';
            
            document.getElementById('billid').innerHTML = (bill.bill_id)? bill.bill_id : 'NA';
            
                
            document.getElementById('billtitle').innerHTML = (bill.short_title)? bill.short_title : 'NA';
            document.getElementById('intro').innerHTML = (bill.introduced_on)? bill.introduced_on : 'NA';
            document.getElementById('sponsor').innerHTML = ((bill.sponsor.title)? bill.sponsor.title : '') + ' ' + ((bill.sponsor.first_name)? bill.sponsor.first_name : '') +' '+ ((bill.sponsor.last_name)? bill.sponsor.last_name : '');
            document.getElementById('lastaction').innerHTML = bill.last_version.version_name + ', '+ bill.last_action_at;
           if(bill.last_version.urls.pdf){
               
            document.getElementById('billurl').innerHTML = (bill.short_title)? bill.short_title : bill.bill_id;
            document.getElementById('billurl').href = bill.last_version.urls.pdf;
           }else{
               document.getElementById('billurl').innerHTML = 'NA';
           }
            
        }
        
        function getDetails(details){
                
                document.getElementById('memberdetail').style.display = 'block';
            
                document.getElementById('fullName').innerHTML = ((details.title)? details.title : '')  + ' ' +((details.first_name)? details.first_name : '' )+ ' '+ ((details.last_name)? details.last_name : '');
                 document.getElementById('office').innerHTML = (details.office)? details.office : 'NA';
                  document.getElementById('term').innerHTML = (details.term_end)? details.term_end : 'NA';
                   if(details.facebook_id){
                    document.getElementById('facebook').href = "https://facebook.com/"+details.facebook_id;
                 document.getElementById('facebook').innerHTML = ((details.first_name)? details.first_name : '' )+ ' '+ ((details.last_name)? details.last_name : '');
                   }else{
                        document.getElementById('facebook').innerHTML = 'NA';
                   }
            if(details.twitter_id){
             document.getElementById('twitter').href = (details.twitter_id)? "https://twitter.com/"+details.twitter_id : 'NA';
                 document.getElementById('twitter').innerHTML = ((details.first_name)? details.first_name : '' )+ ' '+ ((details.last_name)? details.last_name : '');
            }else{
                document.getElementById('twitter').innerHTML = 'NA';
            }
                     
            if(details.website){
            document.getElementById('website').innerHTML = details.website;
             document.getElementById('website').href = details.website;
            }else {
                 document.getElementById('website').innerHTML = 'NA';
            }
            document.getElementById('dp').src = "https://theunitedstates.io/images/congress/225x275/"+details.bioguide_id+'.jpg';
            document.getElementById('dp').alt = details.bioguide_id;
            document.getElementById('phptable').style.display = 'none';
            
            
            }
        window.onload = function () {
            
           
            var keywords = {
                
                legislators : "State/Representative*",
                committees : "Committee ID*",
                 bills : "Bill ID*",
                amendments: "Amendment ID*"
                
            }
           
            //select
            document.getElementById('congressDatabase').addEventListener('change' ,function(){
                
                var keywordLabel = document.getElementById('keywordLabel');
                document.getElementById("keywordName").value = keywords[this.value];
                document.getElementById('keywordValue').value = "";
                keywordLabel.innerHTML = keywords[this.value];
                
            });
            
            
            //form submit validation
            document.getElementById('myForm').addEventListener('submit',function(event){
                
                errorMsg = "";
                if(document.getElementById('congressDatabase').value=="select your option")
                    errorMsg += "Congress Databse";
               if(!document.getElementById('keywordValue').value || document.getElementById('keywordValue').value.trim()=="")
                   errorMsg += "\n"+document.getElementById('keywordLabel').innerHTML;
                 if(!document.getElementById('chamber1').checked && !document.getElementById('chamber2').checked)
                     errorMsg+= "\n Chamber";
                
                if(errorMsg){
                    errorMsg = "Please enter the following missing information: \n" + errorMsg;
                    alert(errorMsg);
                    event.preventDefault();
                }
               
                return true;
                
            });
            
            //clear button
            document.getElementById('clear').addEventListener('click',function(){
                document.getElementById('keywordValue').value ="";
                document.getElementById('chamber1').checked=true;
                document.getElementById('chamber2').checked=false;
               document.getElementById('keywordLabel').innerHTML="Keyword*";
               document.getElementById('congressDatabase').selectedIndex =0;
                document.getElementById('contents').innerHTML="";
                document.getElementById('memberdetail').style.display = 'none';
                 document.getElementById('bills').style.display = 'none';
                
            });
            

            


        }
    </script>
</body>

</html>