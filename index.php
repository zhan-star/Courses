<?php
require_once 'secure.php';
$header = 'Главная страница';
$courseMap = new CourseMap();
$course=$courseMap->findAllSecondary();
$count=$courseMap->findCounts();
$arr = array();
for($i = 0; $i < $count[0]->cnt; $i++) {
    if($course[$i]->cnts!=0){$arr[] = array(
        'label' => $course[$i]->names,
        'y' => $course[$i]->cnts
    );
}}
$dataPoints=$arr;
require_once 'template/header.php';
?>
<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Статус заполненности наших групп"
	},
	subtitles: [{
		text: "Июнь 2020"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#0\" человек(а)\"",
		indexLabel: "{label} - {y}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<div class="row">
<div class="col-xs-12">
<div>
<div class="box-body"><?php
$header = 'Главная страница';

require_once 'template/header.php';

?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="box-body">
                    <h3><?=$header;?></h3>
                    <hr>
                    <style>
                        h5.maintext{
                            line-height:1.5em;
                        }
                    </style>
                    <h5 class="maintext">У нас на сайте вы найдете прайс-лист доступных курсов и всю информацию о них: начиная от расписания, заканчивая статусом заполненности групп. Наши преподаватели самые высококвалифицированные во всем мире! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, inventore, assumenda quis soluta delectus exercitationem porro unde, mollitia deserunt totam blanditiis consequatur ad quasi nisi quam eius aut saepe omnis? Quibusdam ipsa sunt ea magni quo, animi, iure, vero doloremque aliquid suscipit saepe temporibus porro aperiam voluptatem? Tempora perspiciatis ad odit minus eaque perferendis ex velit harum laudantium? Quos, qui! Magni, maiores modi laborum possimus temporibus consectetur assumenda doloremque pariatur maxime tempora expedita. Officiis iste itaque aperiam optio consequuntur corporis laborum nobis eos odio a recusandae pariatur necessitatibus nisi, quis consequatur beatae quos impedit ipsum. Dignissimos impedit eos nostrum natus aliquid iusto distinctio reprehenderit earum ipsam culpa voluptates rem, excepturi minus eligendi, molestias quidem temporibus labore vitae soluta illo. Porro aliquam vitae incidunt nesciunt sed debitis blanditiis officiis adipisci, culpa, odit, placeat tenetur repellat sint amet magnam eum laborum eligendi modi ipsum nobis? Quis nihil omnis, nobis dignissimos dicta unde?</h5> 
                    <hr>
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </section>
                <div class="box-body">
                    
                </div>
            </div>
        </div>
    </div>
<?php
require_once 'template/footer.php';
?>
