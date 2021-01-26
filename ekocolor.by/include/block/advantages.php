
    <section class="pros<?=$lastBlock=='Y' ? ' last': ''?>" id="advantages">
        <div class="container">
            <div class="content">
                <div class="text">
                    <h2 class="subtitle white"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_advantages/h2_title.php", Array(), Array("MODE" => "html")); ?></h2>
                    <div class="desc"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_advantages/description.php", Array(), Array("MODE" => "html")); ?></div>
                </div>
                
                
                    <? $APPLICATION->IncludeComponent(
	"nextype:landing.block", 
	"advantages", 
	array(
		"COMPONENT_TEMPLATE" => "advantages",
		"ITEMS" => "W3sibmFtZSI6Ilx1MDQyMlx1MDQzZVx1MDQzYlx1MDQ0Y1x1MDQzYVx1MDQzZSBcdTA0M2FcdTA0MzBcdTA0NDdcdTA0MzVcdTA0NDFcdTA0NDJcdTA0MzJcdTA0MzVcdTA0M2RcdTA0M2RcdTA0MzBcdTA0NGYgXHUwNDNmXHUwNDQwXHUwNDNlXHUwNDM0XHUwNDQzXHUwNDNhXHUwNDQ2XHUwNDM4XHUwNDRmIiwiaWNvbiI6Imljb24tdHJvcGh5IiwiZGVzY3JpcHRpb24iOiJcdTA0MTJcdTA0NDFcdTA0NGYgXHUwNDNkXHUwNDMwXHUwNDQ4XHUwNDMwIFx1MDQzZlx1MDQ0MFx1MDQzZVx1MDQzNFx1MDQ0M1x1MDQzYVx1MDQ0Nlx1MDQzOFx1MDQ0ZiBcdTA0M2ZcdTA0NDBcdTA0M2VcdTA0NDhcdTA0M2JcdTA0MzAgXHUwNDNlXHUwNDMxXHUwNDRmXHUwNDM3XHUwNDMwXHUwNDQyXHUwNDM1XHUwNDNiXHUwNDRjXHUwNDNkXHUwNDQzXHUwNDRlIFx1MDQ0MVx1MDQzNVx1MDQ0MFx1MDQ0Mlx1MDQzOFx1MDQ0NFx1MDQzOFx1MDQzYVx1MDQzMFx1MDQ0Nlx1MDQzOFx1MDQ0ZSBcdTA0MzggXHUwNDQxXHUwNDNlXHUwNDNlXHUwNDQyXHUwNDMyXHUwNDM1XHUwNDQyXHUwNDQxXHUwNDQyXHUwNDMyXHUwNDQzXHUwNDM1XHUwNDQyIFx1MDQ0MVx1MDQzMFx1MDQzY1x1MDQ0Ylx1MDQzYyBcdTA0MzJcdTA0NGJcdTA0NDFcdTA0M2VcdTA0M2FcdTA0MzhcdTA0M2MgXHUwNDQxXHUwNDQyXHUwNDMwXHUwNDNkXHUwNDM0XHUwNDMwXHUwNDQwXHUwNDQyXHUwNDMwXHUwNDNjIn0seyJuYW1lIjoiXHUwNDFlXHUwNDNmXHUwNDNiXHUwNDMwXHUwNDQyXHUwNDMwIFx1MDQzYlx1MDQ0ZVx1MDQzMVx1MDQ0Ylx1MDQzYyBcdTA0NDNcdTA0MzRcdTA0M2VcdTA0MzFcdTA0M2RcdTA0NGJcdTA0M2MgXHUwNDQxXHUwNDNmXHUwNDNlXHUwNDQxXHUwNDNlXHUwNDMxXHUwNDNlXHUwNDNjIiwiaWNvbiI6Imljb24tY3JlZGl0LWNhcmQiLCJkZXNjcmlwdGlvbiI6Ilx1MDQxY1x1MDQ0YiBcdTA0M2ZcdTA0NDBcdTA0MzhcdTA0M2RcdTA0MzhcdTA0M2NcdTA0MzBcdTA0MzVcdTA0M2MgXHUwNDNhIFx1MDQzZVx1MDQzZlx1MDQzYlx1MDQzMFx1MDQ0Mlx1MDQzNSBcdTA0M2ZcdTA0M2JcdTA0MzBcdTA0NDFcdTA0NDJcdTA0MzhcdTA0M2FcdTA0M2VcdTA0MzJcdTA0NGJcdTA0MzUgXHUwNDNhXHUwNDMwXHUwNDQwXHUwNDQyXHUwNDRiIFZpc2EgXHUwNDM4IE1hc3RlckNhcmQsIFx1MDQyZlx1MDQzZFx1MDQzNFx1MDQzNVx1MDQzYVx1MDQ0MS5cdTA0MTRcdTA0MzVcdTA0M2RcdTA0NGNcdTA0MzNcdTA0MzggXHUwNDM4IFx1MDQzMVx1MDQzNVx1MDQzN1x1MDQzZFx1MDQzMFx1MDQzYlx1MDQzOFx1MDQ0N1x1MDQzZFx1MDQ0Ylx1MDQzNSBcdTA0M2ZcdTA0MzVcdTA0NDBcdTA0MzVcdTA0MzJcdTA0M2VcdTA0MzRcdTA0NGIifSx7Im5hbWUiOiJcdTA0MjFcdTA0M2FcdTA0MzhcdTA0MzRcdTA0M2FcdTA0MzAgNSUgXHUwNDNmXHUwNDNlXHUwNDQxXHUwNDQyXHUwNDNlXHUwNDRmXHUwNDNkXHUwNDNkXHUwNDRiXHUwNDNjIFx1MDQzYVx1MDQzYlx1MDQzOFx1MDQzNVx1MDQzZFx1MDQ0Mlx1MDQzMFx1MDQzYyIsImljb24iOiJpY29uLXBlcmNlbnRhZ2UiLCJkZXNjcmlwdGlvbiI6Ilx1MDQyOVx1MDQzNVx1MDQzNFx1MDQ0MFx1MDQ0Ylx1MDQzNSBcdTA0NDFcdTA0M2FcdTA0MzhcdTA0MzRcdTA0M2FcdTA0MzggXHUwNDNmXHUwNDNlXHUwNDQxXHUwNDQyXHUwNDNlXHUwNDRmXHUwNDNkXHUwNDNkXHUwNDRiXHUwNDNjIFx1MDQzZlx1MDQzZVx1MDQzYVx1MDQ0M1x1MDQzZlx1MDQzMFx1MDQ0Mlx1MDQzNVx1MDQzYlx1MDQ0Zlx1MDQzYyBcdTA0M2RcdTA0MzBcdTA0NDhcdTA0MzVcdTA0MzNcdTA0M2UgXHUwNDNjXHUwNDMwXHUwNDMzXHUwNDMwXHUwNDM3XHUwNDM4XHUwNDNkXHUwNDMwIn0seyJuYW1lIjoiMTAwJSBcdTA0MzNcdTA0MzBcdTA0NDBcdTA0MzBcdTA0M2RcdTA0NDJcdTA0MzhcdTA0NGYgXHUwNDNkXHUwNDMwIFx1MDQzMlx1MDQzZVx1MDQzN1x1MDQzMlx1MDQ0MFx1MDQzMFx1MDQ0MiBcdTA0NDJcdTA0M2VcdTA0MzJcdTA0MzBcdTA0NDBcdTA0M2VcdTA0MzIiLCJpY29uIjoiaWNvbi1kaXBsb20iLCJkZXNjcmlwdGlvbiI6Ilx1MDQxNVx1MDQ0MVx1MDQzYlx1MDQzOCBcdTA0MzJcdTA0NGIgXHUwNDNmXHUwNDNlXHUwNDNiXHUwNDQzXHUwNDQ3XHUwNDM4XHUwNDNiXHUwNDM4IFx1MDQzZFx1MDQzNVx1MDQzYVx1MDQzMFx1MDQ0N1x1MDQzNVx1MDQ0MVx1MDQ0Mlx1MDQzMlx1MDQzNVx1MDQzZFx1MDQzZFx1MDQ0Ylx1MDQzOSBcdTA0NDJcdTA0M2VcdTA0MzJcdTA0MzBcdTA0NDAsIFx1MDQzY1x1MDQ0YiBcdTA0MzFcdTA0MzVcdTA0MzcgXHUwNDM0XHUwNDNlXHUwNDNmXHUwNDNlXHUwNDNiXHUwNDNkXHUwNDM4XHUwNDQyXHUwNDM1XHUwNDNiXHUwNDRjXHUwNDNkXHUwNDRiXHUwNDQ1IFx1MDQzMlx1MDQzZVx1MDQzZlx1MDQ0MFx1MDQzZVx1MDQ0MVx1MDQzZVx1MDQzMiBcdTA0M2VcdTA0MzFcdTA0M2NcdTA0MzVcdTA0M2RcdTA0NGZcdTA0MzVcdTA0M2MgXHUwNDQyXHUwNDNlXHUwNDMyXHUwNDMwXHUwNDQwIFx1MDQzOFx1MDQzYlx1MDQzOCBcdTA0MzJcdTA0MzVcdTA0NDBcdTA0M2RcdTA0MzVcdTA0M2MgXHUwNDM0XHUwNDM1XHUwNDNkXHUwNDRjXHUwNDMzXHUwNDM4In1d"
	),
	false
); ?>
                
                    
                    
            </div>
        </div>
    </section>
