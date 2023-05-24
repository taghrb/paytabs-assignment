<!DOCTYPE html>
<html>
<head>
	<title>Categories</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
		  integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
		  crossorigin="anonymous" referrerpolicy="no-referrer"/>
	<script src="https://code.jquery.com/jquery-3.7.0.min.js"
			integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
			integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
			crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script type="application/javascript">
		$(document).ready(function () {
			$('#category-selects').on('change', '.category-select', function () {
				var thisSelect = $(this);
				var categoryId = $(this).val();

				$(this).nextAll('select').remove();

				if (categoryId !== '') {
					$.ajax({
						url: '<?php echo site_url('category/get_children'); ?>',
						type: 'POST',
						data: {category_id: categoryId},
						dataType: 'json',
						success: function (response) {
							if (response.status === 'success') {
								var childCategories = response.data;

								if (childCategories.length > 0) {
									var childSelect = generateCategorySelect(childCategories);
									$('#category-selects').append(childSelect);
								}
							}
						}
					});
				}
			});
		});

		function generateCategorySelect(categories) {
			console.log(categories);
			var select = '';
			select += '<select class="category-select form-select mb-3">';
			select += '<option value="">Select a category</option>';
			$.each(categories, function (index, category) {
				select += '<option value="' + category.category_id + '">' + category.category_name + '</option>';
			});
			select += '</select>';
			select += '';
			return select;
		}
	</script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h1>Categories</h1>
			<form action="#" method="post">
				<div id="category-selects">
					<select class="category-select form-select mb-3">
						<option value="">Select main category</option>
						<?php
						foreach ($mainCategories as $mCategory) :
							echo '<option value="' . $mCategory->category_id . '">' . $mCategory->category_name . '</option>';
						endforeach;
						?>
					</select>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
