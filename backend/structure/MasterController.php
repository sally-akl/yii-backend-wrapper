<?php
class MasterController
{
	public $sendUrl;
	public $sendData;
	
	
	public function loadScriptFiles()
	{
	
		$cs = Yii::app()->clientScript;
		$mode = Yii::app()->params['AymaXJS.Production'];

		$styleFiles = [
						'AymaXTrack/css/jquery-ui.css',
						'AymaXTrack/css/site/bootstrap.min.css',
						'AymaXTrack/css/jquery.qtip.css',
						'AymaXTrack/libs/js/datetimepicker/jquery.datetimepicker.css',
						// 'AymaXTrack/libs/free-jqgrid/ui.jqgrid.min.css',
						'AymaXTrack/css/multiple-select.css',
						'AymaXTrack/css/leaflet/leaflet.css',
						'AymaXTrack/css/leaflet/leaflet.label.css',
						'AymaXTrack/css/leaflet/markercluster.css',
						'AymaXTrack/libs/js/leaflet/PruneCluster/LeafletStyleSheet.css',
						'AymaXTrack/libs/js/leaflet/leaflet.draw/leaflet.draw.css',
						'AymaXTrack/css/font-awesome/css/font-awesome.css',
						// 'AymaXTrack/css/purecss/build/pure-min.css',
						'AymaXTrack/libs/intro.js/introjs-ltr.css',
						'AymaXTrack/libs/select2/select2.min.css',
						'AymaXTrack/libs/jquery.fs.dropper.css',
						// 'AymaXTrack/libs/nprogress/nprogress.css',
						'AymaXTrack/libs/webui-popover/dist/jquery.webui-popover.css',
						'AymaXTrack/css/site/loading.css',
						'AymaXTrack/libs/jsonform/deps/jquery-multi-step-form.css',
						//'AymaXTrack/libs/wijmo/css/jquery-wijmo.css',
						'AymaXTrack/libs/wijmo/css/wijmo.min.css',
						'AymaXTrack/libs/spectrum/spectrum.css',
						'AymaXTrack/css/site/bootstrap-material-design.min.css',
						'AymaXTrack/css/site/ripples.min.css',
						'AymaXTrack/css/site/animate.min.css',
						'AymaXTrack/css/site/hover-min.css',
						'AymaXTrack/css/site/ion.rangeSlider.css',
						'AymaXTrack/css/site/ion.rangeSlider.skinFlat.css',
						'AymaXTrack/css/site/main_sass.css',
						'AymaXTrack/css/site/common.css',
						'AymaXTrack/css/site/custom.css',
						'AymaXTrack/css/site/notification.css',
						'AymaXTrack/css/site/grid.css',
						'AymaXTrack/css/site/jquery.scrolling-tabs.css',
						'AymaXTrack/libs/js/leaflet/leaflet-locatecontrol-0.61.0/dist/L.Control.Locate.min.css',
						'AymaXTrack/libs/js/leaflet/Leaflet-MiniMap/dist/Control.MiniMap.min.css',
						'AymaXTrack/libs/bootstrap-popover-x/css/bootstrap-popover-x.min.css',
						'AymaXTrack/css/site/track.css',
						'AymaXTrack/libs/jquery.mCustomScrollbar/jquery.mCustomScrollbar.min.css',
						'AymaXTrack/libs/bootstrap-daterangepicker/daterangepicker.css'
					];

					//AymaXTrack/css/gridStyles.css
					$styleFiles[] = 'AymaXTrack/css/site/cssKitStyle.css';
					$styleFiles[] = 'AymaXTrack/css/site/standaredComponents.css';
					$styleFiles[] = 'AymaXTrack/css/site/responsive.css';
					//  $styleFiles[] = 'AymaXTrack/css/site/nprogress.css';
					if (Yii::t('app', 'DIR') == 'rtl') {
						$styleFiles[] = 'AymaXTrack/css/site/bootstrap-rtl.min.css';
						$styleFiles[] = 'AymaXTrack/css/site/commonrtl.css';
						$styleFiles[] = 'AymaXTrack/css/site/customrtl.css';
						$styleFiles[] = 'AymaXTrack/css/site/rtlstyles.css';
					}

		foreach ($styleFiles as $style) {

			$cs->registerCssFile($style . '?v=' . Yii::app()->params['VERSION_ID']);
		 }  

		 
		$mode = true;

        $javascripts = [
            'AymaXTrack/js-src/misc/sails.io.js',
            // 'AymaXTrack/js-src/aymax.nodeselect.js',
            'AymaXTrack/js-src/misc/moment.min.js',
            //'AymaXTrack/libs/fast-search/defiant.min.js',
            'AymaXTrack/libs/js-search/dist/umd/js-search.js',
            'AymaXTrack/js-src/misc/underscore-min.js',
                //'AymaXTrack/js-src/TrackMap.js',
                // 'AymaXTrack/js-src/track-new.js'
        ];

        if ($mode) {
            if (Yii::t('app', 'DIR') == 'rtl') {
                $javascripts[] = 'AymaXTrack/moment.ar.js';
                $javascripts[] = 'AymaXTrack/build/main_ar.js';
            } else {
                $javascripts[] = 'AymaXTrack/build/main_en.js';
            }

            $javascripts[] = 'AymaXTrack/libs/wijmo/wijmo.min.js';
            $javascripts[] = 'AymaXTrack/libs/wijmo/wijmo.grid.min.js';
            $javascripts[] = 'AymaXTrack/libs/wijmo/wijmo.nav.min.js';
            $javascripts[] = 'AymaXTrack/libs/wijmo/wijmo.input.min.js';
        } else {
            // $javascripts[] = 'AymaXTrack/libs/nprogress.js';
            $javascripts[] = 'AymaXTrack/libs/require.js';
            $javascripts[] = 'AymaXTrack/main.js';
        }

        foreach ($javascripts as $js) {

            $cs->registerScriptFile($js . '?v=' . Yii::app()->params['VERSION_ID'], CClientScript::POS_END);
        }
 
	}
	
	
	public function index() {
        if(isset($_GET) && isset($_GET["r"]) && $_GET["r"] == "users/logout")
		{
			$_SESSION['tokenVal'] = "";
			$this->sendUrl = Yii::app()->params['remoteServer']."/index.php?r=users/logout";
			$this->sendData = array();
			$result = $this->sendRequestData();	   
			$base_path = Yii::app()->request->getFullPath();
			header("Location:$base_path");
		
		}
    }
	
	function sendRequestData()
	{
		$curl = curl_init();
	    curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_URL,  $this->sendUrl);  
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$send_data = http_build_query($this->sendData);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $send_data);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
	
	
	
	
	
}


?>
