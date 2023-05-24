<!DOCTYPE html>
<html>
<head>
	<title>Categories</title>
	<script src="https://code.jquery.com/jquery-3.7.0.min.js"
			integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

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
			var select = '<select class="category-select">';
			select += '<option value="">Select a category</option>';
			$.each(categories, function (index, category) {
				select += '<option value="' + category.category_id + '">' + category.category_name + '</option>';
			});
			select += '</select>';
			return select;
		}
	</script>
</head>
<body>
<h1>Categories</h1>
<div id="category-selects">
	<select class="category-select">
		<option value="">Select main category</option>
		<?php
		foreach ($mainCategories as $mCategory) :
			echo '<option value="' . $mCategory->category_id . '">' . $mCategory->category_name . '</option>';
		endforeach;
		?>
	</select>
</div>

</body>
</html>
