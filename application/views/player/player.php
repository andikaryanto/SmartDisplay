<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
html,body {
	margin: 0;
	padding: 0;
}
.slider {
	/* width: 1024px; */
	/* margin: 2em auto; */
	
}

.slider-wrapper {
	width: 100%;
	height: 90%;
	position: absolute;
}

.slide {
	float: left;
	position: absolute;
	width: 100%;
	height: 100%;
	opacity: 0;
	transition: opacity 3s linear;
}
.ticker{
    
    background:<?= $tickersetting->BackGroundColor ?>;
	width: 100%;
	height: <?= $tickersetting->Height ?>%;
	position: absolute;
    top: <?= 100 - $tickersetting->Height ?>%;
}

.slider-wrapper > .slide:first-child {
	opacity: 1;
}

.imgRunning
{
	position: initial;
	width: 40px;
	height: 40px; 
	max-width: 50px !important;
	padding-left: 5px;
	padding-right: 5px;
	float: left;
	margin: 10px 20px;
	
}

.textRunning{
	color: <?= $tickersetting->FontColor ?>;
	font-size: 1em;
	margin-top: auto;
	margin-bottom: auto;
	//padding: 5px;
	line-height: 50px;
	float: left;
	display: flex;
	justify-content: center;
	flex-direction: row;
	text-align: center;
	margin: 5px 0px;
	}

.example1 {
 height: 100%;	
 overflow: hidden;
 position: relative;
 margin : auto;
 /* padding:6px; */
}
.example1 .mover {
 font-size: 3em;
 position: absolute;
 width: 100%;
 height: 100%;
 margin: 0;
 line-height: 50px;
 text-align: center;
 -moz-transform:translateX(100%);
 -webkit-transform:translateX(100%);	
 transform:translateX(100%);
 -moz-animation: example1 15s linear infinite;
 -webkit-animation: example1 15s linear infinite;
 animation: example1 15s linear infinite;
}

/* .example1 {
        top : 85%;
        height: 15%;
        overflow: hidden;
        position: fixed;
        width: 100%;
        z-index: 1;
        white-space: nowrap;
        overflow-x: hidden
    }
    
    .example1 .mover {
        //font-size: 3em;
        color: white;
        position: absolute;
        height: 100%;  
        margin: 0;
        text-align: left;
        //display: inline-block;
        width: max-content;
        // display: flex;
        // justify-content: center;
        // flex-direction: row;
        // text-align: center;
        //padding: 5px;
        transform:translateX(100%);
        //animation: example1 40s linear infinite;
        
        .imgRunning
        {
            //left: -50px;
            position: initial;
            width: 40px;
            height: 40px; 
            max-width: 50px !important;
            padding-left: 5px;
            padding-right: 5px;
            float: left;
            margin: auto;
            
        }
        .textRunning{
            color: white;
            font-size: 1.5em;
            margin-top: auto;
            margin-bottom: auto;
            //padding: 5px;
            line-height: 50px;
            float: left;
            display: flex;
            justify-content: center;
            flex-direction: row;
            text-align: center;
            
        }
    }
    .imageTextWrapper{
        text-align: center;
        justify-content: center;
        float: left;
        flex-direction: row;
        display: flex;
        height: 100% ;
        
    } */
/* Move it (define the animation) */
@-moz-keyframes example1 {
 0%   { -moz-transform: translateX(100%); }
 100% { -moz-transform: translateX(-100%); }
}
@-webkit-keyframes example1 {
 0%   { -webkit-transform: translateX(100%); }
 100% { -webkit-transform: translateX(-100%); }
}
@keyframes example1 {
 0%   { 
 -moz-transform: translateX(100%); /* Firefox bug fix */
 -webkit-transform: translateX(100%); /* Firefox bug fix */
 transform: translateX(100%); 		
 }
 100% { 
 -moz-transform: translateX(-100%); /* Firefox bug fix */
 -webkit-transform: translateX(-100%); /* Firefox bug fix */
 transform: translateX(-100%); 
 }
}

</style>
</head>
<body>
<input hidden id = "playerid" name ="playerid"  value="<?= $playerId?>">
<input hidden id = "playername" name ="playername"  value="<?= $playerName?>">
<div class="slider" id="main-slider"><!-- outermost container element -->
	<div class="slider-wrapper"><!-- innermost wrapper element -->
		<?php
		foreach($model as $data){
			?>
			
				<img src="<?= base_url('resources/'.$data->Url)?>" alt="<?= $data->Id?>" class="slide" />
			<?php
		}
		?>
		<!-- <img src="<?= base_url('resources/uploads/images/20190325_100426_screencapture-localhost-8889-Sahara-cart-2019-03-22-13_59_04.png')?>" alt="First" class="slide" />
		<img src="<?= base_url('resources/uploads/images/20190325_101945_screencapture-localhost-8889-Sahara-shop-2019-03-22-13_54_06.png')?>" alt="Second" class="slide" />
	 -->
	</div>
</div>	
<div class="ticker">
    <div class="example1">
			
            <div class="mover">
				<!-- <img class = "imgRunning" src="<?= base_url('resources/uploads/tickers/20190329_112710_img_358304.png')?>">
				<div class = "textRunning"><?= $ticker ?></div> -->
				<?= $ticker ?>
			</div>
	</div>
	<!-- <div class="example1">
		<div class = "mover">
			<div id='wraper' class ="imageTextWrapper" >
					<img class ="imgRunning" src = "assets/logo/murni.png" >
					<div class = "textRunning" >aaaa </div>
			</div>
		</div>
	</div> -->
</div>

<script src="<?= base_url('assets/bootstrapdashboard/vendor/jquery/jquery.min.js');?>"></script>
<script src="<?= base_url('assets/bootstrapdashboard/vendor/popper.js/umd/popper.min.js');?>"> </script>
<script src="<?= base_url('assets/bootstrapdashboard/vendor/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?= base_url('assets/bootstrapdashboard/vendor/bootstrap/js/plugins/bootstrap-select.min.js');?>"></script>
<script src="<?= base_url('assets/bootstrapdashboard/js/grasp_mobile_progress_circle-1.0.0.min.js');?>"></script>
<script src="<?= base_url('assets/bootstrapdashboard/vendor/jquery.cookie/jquery.cookie.js');?>"> </script>
<script src="<?= base_url('assets/bootstrapdashboard/vendor/chart.js/Chart.min.js');?>"></script>
<script src="<?= base_url('assets/bootstrapdashboard/vendor/jquery-validation/jquery.validate.min.js');?>"></script>
<script src="<?= base_url('assets/bootstrapdashboard/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js');?>"></script>
<!-- Main File-->
<script src="<?= base_url('assets/bootstrapdashboard/js/front.js');?>"></script>

<script>
$( document ).ready(function() {
    // console.log( "ready!" );
	// getMultimedia();
	// slide();
});

// function getMultimedia(){
// 	var player = $("#playername").val();
// 	$.get("<?= base_url('api/player/multimedia?isbrowser=true&playername=')?>" +player, function(data, status){
// 		var html = "";
// 		var base_url= "<?= base_url('resources')?>"
// 		if(data['result'] != null)
// 		$.each(data['result']['multimedia'],function( index, value ) {
// 			html += "<img src='"+base_url+value['Url']+"'alt='First' class='slide' />";
// 		});

// 		$( ".slider-wrapper" ).append(html);

// 	})
// }

// function slide(){
(function() {
	
	function Slideshow( element ) {
		this.el = document.querySelector( element );
		
		this.getMultimedia();
		// setTimeout(() => {
		this.init();
			
		// }, 5000);
	}
	
	Slideshow.prototype = {
		init: function() {

			this.wrapper = this.el.querySelector( ".slider-wrapper" );
			this.slides = this.el.querySelectorAll( ".slide" );
			this.previous = this.el.querySelector( ".slider-previous" );
			this.next = this.el.querySelector( ".slider-next" );
			this.index = 0;
			this.total = this.slides.length;
			this.timer = null;

			<?php if(count($model) > 0 ){
				?>
			this.action();
			this.stopStart();	
				<?php
			}?>
		},
		_slideTo: function( slide ) {
			var currentSlide = this.slides[slide];
			currentSlide.style.opacity = 1;
			// console.log(slide);
			for( var i = 0; i < this.slides.length; i++ ) {
				var slide = this.slides[i];
				if( slide !== currentSlide ) {
					slide.style.opacity = 0;
				}
			}
		},
		action: function() {
			var self = this;
			self.timer = setInterval(function() {
				self.index++;
				if( self.index == self.slides.length ) {
					self.index = 0;
				}
				self._slideTo( self.index );
				
			}, 5000);
		},
		stopStart: function() {
			var self = this;
			self.el.addEventListener( "mouseover", function() {
				clearInterval( self.timer );
				self.timer = null;
				
			}, false);
			self.el.addEventListener( "mouseout", function() {
				self.action();
				
			}, false);
		},
		getMultimedia:function(){
			var player = $("#playername").val();
			setInterval(function() {
				$.get("<?= base_url('api/player/multimedia?isbrowser=true&playername=')?>" +player, function(data, status){
					if(data['result'] != null){
						location.reload();
					}			
				});
			}, 5000);
		},
		loadMultimedia: function(){

			var html = "";
			var base_url= "<?= base_url('resources')?>";
			var idmulmed = [];
			var player = $("#playername").val();
			
			if(data['result'] != null){
				$.each(data['result']['multimedia'],function( index, value ) {
					var singleid = data['result']['playerId']+"~"+value['MultimediaId'];
					if(value['IsDeleted'] == 0){
						idmulmed.push(singleid);
						
						// found = idmulmed.find(function(element) {
						// 	return element == singleid;
						// });
						// console.log(found);
						// if(found != undefined){
							var elem = document.getElementById(singleid);
							if(elem)
								elem.src = base_url+value['Url'];
						// } else {
							else 
								html += "<img id = "+singleid+" src='"+base_url+value['Url']+"'alt='"+singleid+"' class='slide' />";
						// }
					} else {

						var elem = document.getElementById(singleid);
						if(elem){
							elem.parentNode.removeChild(elem);
						}			

						idmulmed = idmulmed.filter(function(ele){
							return ele != singleid;
						});
					}
				});

				$( ".slider-wrapper" ).append(html);	
			}
		}
	};
	
	document.addEventListener( "DOMContentLoaded", function() {
		
		var slider = new Slideshow( "#main-slider" );
		
	});
	
	
})();
// }

</script>
</body>
</html> 