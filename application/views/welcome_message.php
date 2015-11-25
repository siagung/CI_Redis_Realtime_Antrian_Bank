<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Antrian BAnk</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/script/soundmanager2-nodebug-jsmin.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/script/terbilang.js"></script>
    <script type="text/javascript">

        var vint=100;
        var vint2=200;
        var descp=1;
        soundManager.url='<?php echo base_url();?>assets/swf/'; //harus ada

        soundManager.onready(function(){

            var tmb = document.getElementById('tes1');
            var tmb2 = document.getElementById('tes2');
            var tmb3 = document.getElementById('tes3');
            tmb.onclick = function(){
                descp=1;
                vint++;
                nilai= (vint).toString();
                    //document.getElementById('nilai').value;
                obj = new Array();
                nilaiString = terbilang(nilai).trim();
                // hapus spasi
                nilaiString=nilaiString.replace(/(\s+)/g,"-");
                daftarSuara = nilaiString.split("-");
                obj = buatSuara(daftarSuara);
                obj[0].play()};

            tmb2.onclick = function(){
                descp=2;
                vint++;
                nilai= (vint).toString();
                //document.getElementById('nilai').value;
                obj = new Array();
                nilaiString = terbilang(nilai).trim();
                // hapus spasi
                nilaiString=nilaiString.replace(/(\s+)/g,"-");
                daftarSuara = nilaiString.split("-");
                obj = buatSuara(daftarSuara);
                obj[0].play()};

            tmb3.onclick = function(){
                descp=3;
                vint2++;
                nilai= (vint2).toString();
                //document.getElementById('nilai').value;
                obj = new Array();
                nilaiString = terbilang(nilai).trim();
                // hapus spasi
                nilaiString=nilaiString.replace(/(\s+)/g,"-");
                daftarSuara = nilaiString.split("-");
                obj = buatSuara(daftarSuara);
                obj[0].play()};

            //alert(nilaiString);
        });
        function buatSuara(daftarSuara){
            i = 0;	j = 0;
            while( i < daftarSuara.length ){
                j =i.toString();
                if( i != daftarSuara.length - 1) {
                    obj[i]=soundManager.createSound({
                        id:j,
                        volume:100,
                        url:'<?php echo base_url();?>assets/audio/'+daftarSuara[i]+'.mp3',
                        onfinish:function(){
                            //alert(this.sID);
                            var next = parseInt(this.sID) + 1;
                            obj[next].play();
                            this.destruct();

                        }
                    })
                }
                else {
                    obj[i]=soundManager.createSound({
                        id:i.toString(),
                        volume:100,
                        url:'<?php echo base_url();?>assets/audio/'+daftarSuara[i]+'.mp3',
                        onfinish: function(){this.destruct();}
                    })
                }
                i++;
            }
            $.ajax({
                url: "<?php echo site_url();?>/welcome/terbilang",
                type: "POST",
                data: {
                    nilai : vint,
                    nilai2 : vint2,
                        //$("input[name='loket01']").val(),
                    desc :descp
                }
            })
            ;
            return obj;
        }
    </script>
    <script type="text/javascript" src="http://localhost:8085/socket.io/socket.io.js"></script>
    <script type="text/javascript">

        var socket = null;

            socket = io.connect('http://localhost:8085/');

            socket.on('connect', function(data){
                setStatus('connected');
                socket.emit($('txtid').val(), {channel:'realtime'});
            });

            socket.on('reconnecting', function(data){
                setStatus('reconnecting');
            });

            socket.on('message', function (data) {
               // console.log('received a message: ', data);
                addMessage(data);
            });


        function addMessage(data) {
            vdt = data.split("-");
            $('#online').html(vdt[1]);
        }

        function setStatus(msg) {
          //  alert('Connection Status : ' + msg);
           /// console.log('Connection Status : ' + msg);
        }


    </script>
</head>
<body>

<div id="container">
	<!--<h1><input type="text" name="txtid" id="txtid" value="" placeholder="your id"/><a href="#" class="connect">CONNECT</a> </h1>-->

	<div id="body">
        <table>
            <tr style="width:100%; height: 200px;">
                <td align="center" style="width: 30%; height: 100%; border: 1px solid #000;" >
                    <p id="online" style="font-size: 100px;">100</p>
                </td>
            </tr>
        </table>
    </div>
	<!--<b><?php //print_r($message);?></b>
	<br/>
	<form action="<?php echo site_url();?>/welcome/index2" method="post">
	<input type="text" name="cmd" value="" placeholder="command"/>
	<input type="submit" value="kirim"/>
	</form>



    <input type="text" name="cmdajax" value="" placeholder="command"/>
    <input type="submit" value="kirim Ajax" name="btnAjax" id="btnAjax"/>
    <form action="<?php echo site_url();?>/welcome/index3" method="post">
        <input type="text" name="publish" value="" placeholder="command"/>
        <input type="submit" value="command"/>
    </form>

    Masukkan bilangan saja : <br />
  <!--<form action="<?php echo site_url();?>/welcome/terbilang" method="post">-->
   <!-- <input type=text id='nilai' name="loket01"> -->
    <button  type="submit" id="tes1"> Panggil - Loket 1</button>
    <button  type="submit" id="tes2"> Panggil - Loket 2</button>
    <button  type="submit" id="tes3"> Panggil - Kasir </button>
    <!--  </form> -->
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>

</div>
<script type="text/javascript">
 $(document).ready(function() {

      /*  var MaxInputs       = 8; //maximum input boxes allowed
        var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
        var AddButton       = $("#AddMoreFileBox"); //Add button ID

        var x = InputsWrapper.length; //initlal text box count
        var FieldCount=1; //to keep track of text box added

        $(AddButton).click(function (e)  //on add input button click
        {
            if(x <= MaxInputs) //max input box allowed
            {
                FieldCount++; //text box added increment
                //add input box
                $(InputsWrapper).append('<div><input type="text" name="mytext[]" id="field_'+ FieldCount +'" value="Text '+ FieldCount +'"/><a href="#" class="removeclass">&times;</a></div>');
                x++; //text box increment
            }
            return false;
        });
*/
        $("#btnAjax").on("click", function(e){ //user click on remove text

            $.ajax({
                url: "<?php echo site_url();?>/welcome/indexr",
                type: "GET",
                data: {
                    //cmdajax :   $("input[name=cmdajax]").val(),
                    desc : "The description"
                }
            })
            ;
            return false;
        })

    });

</script>
</body>
</html>