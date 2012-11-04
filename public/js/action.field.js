$(document).ready(function() {
	$("#idUpdate").click(function() {
		$("#idformFieldManage").attr("action", "./index.php?controller=field&action=redirectUpdate");
	});
});

$(document).ready(function() {
	$("#idRemove").click(function() {
		$("#idformFieldManage").attr("action", "./index.php?controller=field&action=delete");
	});
});

