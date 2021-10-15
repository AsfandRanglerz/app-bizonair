var counter = 1;
$(".add-btn").click(function() {
	var chemicalInfo = $(".chemical-info-inner").children("div.form-row").last().clone();
	// Manufacturer
	chemicalInfo.find("input#manufacturer_company_name"+counter).attr({
		"id": "manufacturer_company_name"+(counter+1),
		"name": "manufacturer_company_name"+(counter+1)
	});
	chemicalInfo.find("small#manufacturer_company_name"+counter+"_error").attr({
		"id": "manufacturer_company_name"+(counter+1)+"_error"
	});
	// Origin
	chemicalInfo.find("input#origin"+counter).attr({
		"id": "origin"+(counter+1),
		"name": "origin"+(counter+1)
	});
	chemicalInfo.find("small#origin"+counter+"_error").attr({
		"id": "origin"+(counter+1)+"_error"
	});
	// Chemicals Listed
	chemicalInfo.find("input#chemicals_listed"+counter).attr({
		"id": "chemicals_listed"+(counter+1),
		"name": "chemicals_listed"+(counter+1)
	});
	chemicalInfo.find("small#chemicals_listed"+counter+"_error").attr({
		"id": "chemicals_listed"+(counter+1)+"_error"
	});
	// Additional Info
	chemicalInfo.find("input#company_additional_info"+counter).attr({
		"id": "company_additional_info"+(counter+1),
		"name": "company_additional_info"+(counter+1)
	});
	// Supply Type
	chemicalInfo.find("input#inStock"+counter).siblings("label").attr("for", "inStock"+(counter+1));
	chemicalInfo.find("input#inStock"+counter).attr({
		"id": "inStock"+(counter+1),
		"name": "supply_type"+(counter+1)
	});
	chemicalInfo.find("input#makeOrder"+counter).siblings("label").attr("for", "makeOrder"+(counter+1));
	chemicalInfo.find("input#makeOrder"+counter).attr({
		"id": "makeOrder"+(counter+1),
		"name": "supply_type"+(counter+1)
	});
	chemicalInfo.find("input#both"+counter).siblings("label").attr("for", "both"+(counter+1));
	chemicalInfo.find("input#both"+counter).attr({
		"id": "both"+(counter+1),
		"name": "supply_type"+(counter+1)
	});
	chemicalInfo.find("small#supply_type"+counter+"_error").attr({
		"id": "supply_type"+(counter+1)+"_error",
	});
	$(".chemical-info-inner").append(chemicalInfo);

	$(".chemical-info-inner").find("input#company_counter").val(counter+1);
	counter++;
});