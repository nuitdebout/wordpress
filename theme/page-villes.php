<?php
/**
 * Template Name: page list ville
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

use NuitDebout\Wordpress\Cities;

?>

<?php $cities = Cities\get_cities(); ?>

<?php
$cities_by_letter = [];
foreach ($cities as $city) {
    $letter = $city->name[0];
    // hack for the É
    $letter = htmlentities($letter) === '' ? 'E' : $letter;

    if (! $cities_by_letter[$letter]) {
        $cities_by_letter[$letter] = [];
    }
    $cities_by_letter[$letter][] = $city;
}
?>

<?php while (have_posts()) : the_post(); ?>
<div class="page-header">
	<h1 class="text-center"><?php the_title() ?></h1>
</div>
<?php the_content() ?>
<?php endwhile; ?>

<div class="cities-container">
	<div class="row">
		<div class="col-sm-4">
			<div id="results" data-spy="affix" data-offset-top="120">
				<form class="nd-js-city-search-form">
					<label for="ajax-example">Rechercher une ville</label>
					<div class="input-group">
	      				<div class="input-group-addon">
	      					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
	      				</div>
						<input class="form-control" type="search" id="ajax-example" class="awesomplete">
					</div>
				</form>
				<nav>
					<ul class="pagination pagination-sm">
					<?php foreach ($cities_by_letter as $letter => $cities) : ?>
					<li><a href="#letter-<?php echo strtolower($letter) ?>"><?php echo $letter ?></a></li>
					<?php endforeach; ?>
					</ul>
				</nav>
				<div class="loader sk-wave">
					<div class="sk-rect sk-rect1"></div>
					<div class="sk-rect sk-rect2"></div>
					<div class="sk-rect sk-rect3"></div>
					<div class="sk-rect sk-rect4"></div>
					<div class="sk-rect sk-rect5"></div>
				</div>
				<div class="nd-js-city-details">

				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<?php foreach ($cities_by_letter as $letter => $cities) : ?>
				<?php
				$columns = $column = [];
				$per_column = ceil(count($cities) / 3);
				$i = 0;
				foreach ($cities as $city) {
					$column[] = $city;
					if (count($column) >= $per_column) {
						$columns[] = $column;
						$column = [];
					}
				}
				$columns[] = $column;
				?>
				<h3 id="letter-<?php echo strtolower($letter) ?>"><?php echo $letter ?></h3>
				<div class="row">
				<?php foreach ($columns as $column) : ?>
					<div class="col-xs-12 col-sm-4">
						<ul class="list-unstyled">
						<?php foreach ($column as $city) : ?>
							<li><a href="<?php echo get_page_link($city->id) ?>" data-page-id="<?php echo $city->id ?>"><?php echo $city->name ?></a></li>
						<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
