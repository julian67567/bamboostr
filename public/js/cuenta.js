function openDialog(){
  $(".ui-dialog-titlebar-close").hide();
  $('.ui-dialog-content').show();
  $("#cargando").dialog("open");
  $("#cargando").dialog('option', 'title', txt115+"...");
  var loadStats = '<div class="Knight-Rider-loader animate">';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '</div>';
  $("#cargando").html(txt201+""+loadStats);
}
function general(){
  openDialog();
    var cuentaHtml = '';
             if(txt10O == "595e85c50ef0b0e20ce03d0a6ad0c7594b9a051b"){
               cuentaHtml += '<div style="display: table; width: 100%;">';
                 cuentaHtml += '<div style="display: table-row; width: 100%;">';
                   cuentaHtml += '<div style="text-align: center; display: table-cell; width: 100%;">';
                     cuentaHtml += '<button type="button" class="btn btn-danger">'+txt433+': PRO</button>';
                   cuentaHtml += '</div>';
                 cuentaHtml += '</div>';
               cuentaHtml += '</div>';
             }
             else if(txt10O=="c4fdd99c0706c3de99f5dd6d7365b293b223e25f"){
               cuentaHtml += '<div style="display: table; width: 100%;">';
                 cuentaHtml += '<div style="display: table-row; width: 100%;">';
                   cuentaHtml += '<div style="text-align: center; display: table-cell; width: 100%;">';
                     cuentaHtml += '<button type="button" class="btn btn-danger">'+txt433+': ENTERPRISE</button>';
                   cuentaHtml += '</div>';
                 cuentaHtml += '</div>';
               cuentaHtml += '</div>';
             } else {
               cuentaHtml += '<div style="display: table; width: 100%;">';
                 cuentaHtml += '<div style="display: table-row; width: 100%;">';
                   cuentaHtml += '<div style="text-align: center; display: table-cell; width: 100%;">';
                     cuentaHtml += '<button type="button" class="btn btn-danger">'+txt433+': FREE</button>';
                   cuentaHtml += '</div>';
                 cuentaHtml += '</div>';
               cuentaHtml += '</div>';
             }
               cuentaHtml += '<div style="margin-top: 10px;" class="col-md-12">';

                 cuentaHtml += '<div style="text-align: center;" class="col-md-4">';
                   cuentaHtml += '<div style="text-align: center;" class="col-md-12">';
                     cuentaHtml += '<img onclick="capturaCuenta(1);" id="basicoPack" style="cursor: pointer; width: 250px;" src="images/basic.png" />';
                   cuentaHtml += '</div>';
                 cuentaHtml += '</div>';

                 cuentaHtml += '<div style="text-align: center;" class="col-md-4">';
                   cuentaHtml += '<div style="text-align: center;" class="col-md-12">';
                     cuentaHtml += '<img onclick="capturaCuenta(2);" id="proPack" style="cursor: pointer; width: 250px;" src="images/professional.png" />';
                   cuentaHtml += '</div>';
                 cuentaHtml += '</div>';

                 cuentaHtml += '<div style="text-align: center;" class="col-md-4">';
                   cuentaHtml += '<div style="text-align: center;" class="col-md-12">';
                     cuentaHtml += '<img onclick="capturaCuenta(3);" id="entPack" style="cursor: pointer; width: 250px;" src="images/enterprise.png" />';
                   cuentaHtml += '</div>';
                 cuentaHtml += '</div>';

               cuentaHtml += '</div>';

  $("#tab1").html(cuentaHtml);
$(document).ready(function(){
  $('#basicoPack').hover(function(){
	 $('#basicoPack').attr("src","images/basic2.png");
  }, function(){
	 $('#basicoPack').attr("src","images/basic.png");
  });
  $('#proPack').hover(function(){
	 $('#proPack').attr("src","images/professional2.png");
  }, function(){
	 $('#proPack').attr("src","images/professional.png");
  });
  $('#entPack').hover(function(){
	 $('#entPack').attr("src","images/enterprise2.png");
  }, function(){
	 $('#entPack').attr("src","images/enterprise.png");
  });
});
  $(".ui-dialog-titlebar-close").show();
  $("#cargando").dialog("close");
}
function capturaCuenta(option){
openDialog();
var cuentaHtml = '';
 cuentaHtml += '<div style="display: table; width: 100%;">';
 
    cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: center; display: table-cell; width: 100%;">';
       cuentaHtml += ''+txt443+'';
     cuentaHtml += '</div>';
   cuentaHtml += '</div>';
 
   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += ''+txt442+':';
     cuentaHtml += '</div>';
   cuentaHtml += '</div>';
   
   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += '<input type="text" style="width: 100%;">';
     cuentaHtml += '</div>';
   cuentaHtml += '</div>';

   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += ''+txt354+':';
     cuentaHtml += '</div>';
   cuentaHtml += '</div>';
   
   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += '<input type="text" style="width: 100%;">';
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';
   
   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += ''+txt444+':';
     cuentaHtml += '</div>';
   cuentaHtml += '</div>';
   
   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       if(option==1){
         cuentaHtml += '<select id="paquetes" onchange="preciosCambiar();" style="width: 100%;"><option value="1" selected>Bamboostr Basic</option>';
       } else if(option==2){
         cuentaHtml += '<select id="paquetes" onchange="preciosCambiar();" style="width: 100%;"><option value="2" selected>Bamboostr Professional</option>';
       } else if(option==3){
         cuentaHtml += '<select id="paquetes" onchange="preciosCambiar();" style="width: 100%;"><option value="3" selected>Bamboostr Enterprise</option>';
       }
       cuentaHtml += '<option value="1">Bamboostr Basic</option><option value="2">Bamboostr Professional</option><option value="3">Bamboostr Enterprise</option></select>';
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';
   
   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += ''+txt394+':';
     cuentaHtml += '</div>';
   cuentaHtml += '</div>';
   
   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += '<select style="width: 100%;" id="CountryCuenta" name="Country"><option selected="selected" value="Mexico">Mexico</option><option value="United States">United States</option><option value="Canada">Canada</option><option value="United Kingdom" >United Kingdom</option><option value="Ireland" >Ireland</option><option value="Australia" >Australia</option><option value="New Zealand" >New Zealand</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote Divoire">Cote Divoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-bissau">Guinea-bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option><option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea">Korea</option><option value="Korea">Korea</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao Peoples Democratic Republic">Lao Peoples Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option> <option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestinian">Palestinian</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia and Montenegro">Serbia and Montenegro</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Timor-leste">Timor-leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela">Venezuela</option><option value="Viet Nam">Viet Nam</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>';
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';

   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += ''+txt445+':';
     cuentaHtml += '</div>';
   cuentaHtml += '</div>';
   
   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += '<input type="text" style="width: 100%;" />';
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';

   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += ''+txt446+':';
     cuentaHtml += '</div>';
   cuentaHtml += '</div>';
   
   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += '<select onchange="preciosCambiar();" style="width: 100%;" id="cicloCuenta"><option value="1">'+txt447+'</option><option value="2">'+txt448+'</option></select>';
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';
   
   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%; padding-top: 0.5em; padding-bottom: 0.5em; border-bottom: 2px solid black;">';
       cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;"><div style="display: inline-block;">'+txt451+': </div><div style="display: inline-block;" id="mensualPay"></div></div>';
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';

   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%; padding-top: 0.5em;"><div id="totalTexto" style="display: inline-block;">'+txt450+': </div><div id="anualPay" style="display: inline-block;"></div></div>'; 
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';

   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%; padding-top: 0.5em;">';
       cuentaHtml += '<b>'+txt452+':</b>';
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';
/*
   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += '<div><input type="radio" name="pagoCuenta"> '+txt453+'</div><br />';
       cuentaHtml += '<div style="display: inline-block;"><input style="width: 25em;" type="text" placeholder="'+txt455+'" name="pagoCuenta"></div>';
       cuentaHtml += '<div style="display: inline-block; margin-left: 0.2em;"><input id="pagoCuenta" style="width: 10em;" type="text" placeholder="'+txt456+'" name="pagoCuenta"></div><br />';
       cuentaHtml += '<div style="display: inline-block; margin-left: 0.2em; padding-top: 0.5em;"><select id="mesCuenta"><option>'+txt457+'</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option></select></div>';
      var d = new Date();
      var tmp = '<select id="anoCuenta"><option>'+txt458+'</option>';
      for(var xcsd3=d.getFullYear(); xcsd3<=d.getFullYear()+15; xcsd3++){
        tmp += '<option>'+xcsd3+'</option>';
      }
      tmp += '</select>';
      cuentaHtml += '<div style="display: inline-block; margin-left: 0.2em;">'+tmp+'</div><br /><br />';
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';
*/

   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += '<div style="display: inline-block;"><input id="pagoPaypal" type="radio" name="pagoCuenta" checked> '+txt454+'</div>';
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';

   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="padding-top: 3em; text-align: center; display: table-cell; width: 100%;">';
       cuentaHtml += '<button type="button" onclick="realizarPago();" class="btn btn-success">'+txt57+'</button>';
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';

   cuentaHtml += '<div style="display: table-row; width: 100%;">';
     cuentaHtml += '<div style="padding-top: 3em; text-align: left; display: table-cell; width: 100%;">';
       cuentaHtml += txt459;
     cuentaHtml += '</div>';     
   cuentaHtml += '</div>';
   
  cuentaHtml += '</div><br /><br /><br /><br />';
  $("#tab1").html(cuentaHtml);
  $('#tabs').tabs({ active: 2 });
  $(".ui-dialog-titlebar-close").show();
  $("#cargando").dialog("close");
  preciosCambiar();
}
function realizarPago(){
  window.location="paypal/procesarPago.php?facturacion="+$('#cicloCuenta').val()+"&plan="+$('#paquetes').val()+"";
}
function preciosCambiar(){
  openDialog();
  var parametros = {facturacion:$('#cicloCuenta').val(), plan:$('#paquetes').val()};
  $.ajax({data: parametros,
          url:   "scripts/cuenta/get-preciosDeCuenta.php",
	  type:  'POST',
	  success:  function (response) {
            obj = JSON.parse(response);
            if(obj.errors){
              toastr["error"](txt90);
              $("#tab1").html(txt90);
            } else {
              if($('#cicloCuenta').val()==1){
                  var anual = obj.pago*12;
                  $("#mensualPay").html(obj.pago+" USD");
                  $("#anualPay").html(anual.toFixed(2)+" USD");
                  $("#totalTexto").html(txt450+": ");
              } else if($('#cicloCuenta').val()==2){
                  $("#mensualPay").html(obj.pago+" USD");
                  $("#anualPay").html(obj.pago+" USD");
                  $("#totalTexto").html(txt460+": ");
              }
            } 
            $(".ui-dialog-titlebar-close").show();
            $("#cargando").dialog("close");
          }, error: function (response) {
            $(".ui-dialog-titlebar-close").show();
            $("#cargando").dialog("close");
            toastr["error"](txt90);
          }
  });
}