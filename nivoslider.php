<?php
	class NivoSlider{
		private $slides;
		private $base_path;
		private $files_included;
		
		private $width;
		private $height;

		private $options;

		function __construct($base_path,$width,$height){

			$this->base_path=$base_path;
			$this->files_included=false;
			$this->width=$width;
			$this->height=$height;

	}
		function add_slide($img_path,$link,$caption){
			$this->slides[]=array('path'=>$img_path, 'link'=> $link, 'caption'=> $caption);
		}
		function set_option($name,$value){
		}
		function render_includes(){
			$this->files_included=true;
?>
    <link rel="stylesheet" href="<?php echo $this->base_path?>/nivo-slider.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo $this->base_path?>/scripts/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->base_path?>/scripts/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({pauseTime:3500,effect:"sliceDown"});
    });
    </script>
    <style>
		#slider {
			position:relative;
			width:<?php echo $this->width ?>px;
			height:<?php echo $this->height ?>px;
			margin-left:0px;
			background:url(images/loading.gif) no-repeat 50% 50%;
		}
	</style>
<?php
		}
		function render_slides(){
			if(!$this->files_included){
				echo '<span style="color:#f00">Nivo Slider include files are missing, please call render_includes() in the &lt;head&gt; &lt;/head&gt; section</span>';
				return;
		}
?>
<div id="wrapper">
	<div id="slider-wrapper">
		<div id="slider" class="nivoSlider">
		<?php
			foreach($this->slides as $index=>$slide){
				if($slide['link']=='')
					echo '<img src="'.$slide['path'].'" alt="" title="#slide'.$index.'" />';
				else
					echo '<a href="'.$slide['link'].'"><img src="'.$slide['path'].'" alt="" title="#slide'.$index.'" /></a>';
			}
		?>
		</div>
		<?php
			echo "\r\n\r\n";
			reset($this->slides);
			foreach($this->slides as $index=>$slide){
				echo '<div id="slide'.$index.'" class="nivo-html-caption">'.$slide['caption'].'</div>';
			}
		?>
	</div>
</div>
<?php
		}
	}
?>