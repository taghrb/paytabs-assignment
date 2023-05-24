$(document).ready(function () {
	$('#category-selects').on('change', '.category-select', function () {
		var categoryId = $(this).val();

		$(this).nextAll('select').remove();

		if (categoryId !== '') {
			$.ajax({
				url: BASE_URL + 'category/get_children',
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
					} else {
						if (response.error_code != 1001) {
							alert(response.message);
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
