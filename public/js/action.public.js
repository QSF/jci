$(document).ready(function() {
	$("#idUpdate").click(function() {
		$("#idformPublicManage").attr("action", "./index.php?controller=public&action=redirectUpdate");
	});
});

$(document).ready(function() {
	$("#idRemove").click(function() {
		$("#idformPublicManage").attr("action", "./index.php?controller=public&action=delete");
	});
});