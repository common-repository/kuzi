<?php

function outputSource($obj){
    $baseUrl = $obj["BaseUrl"];
    $reelAry = $obj["ReelAry"];
    
    $reelStr = "";
    foreach ($reelAry as $tmpReel) {
        if ($reelStr != "") {
            $reelStr .= ",";
        }
        $reelStr .= '"' . $tmpReel . '"';
    }

    echo <<<EOF
<script type="text/javascript">
(function($) {
    $(document).ready(function () {
        $("body").append('<scr' + 'ipt type="text/javascript" src="{$baseUrl}kuzi.js"></scr' + 'ipt>');
        $("body").append('<link rel="stylesheet" href="{$baseUrl}kuzi.css" type="text/css" />');

        try{
                 var koVer = ko.version;
        }
        catch(e){
            $("body").append('<scr' + 'ipt type="text/javascript" src="{$baseUrl}knockout-2.1.0.js"></scr' + 'ipt>');
        }

        ko.applyBindings(new ViewModel(new Array($reelStr)));
    });
})(jQuery);
</script>

<div data-bind="visible: lotReel">
    <div class="reel">
        <div class="rA" data-bind="text: ReelTop"></div>
        <div class="rB" data-bind="text: ReelT_M"></div>
        <div class="rC" data-bind="text: ReelMid"></div>
        <div class="rB" data-bind="text: ReelM_B"></div>
        <div class="rA" data-bind="text: ReelBtm"></div>
    </div>
    <a class="btn" href="#" data-bind="click: loop, text: btnLabel"></a>
</div>
EOF;
}
?>
