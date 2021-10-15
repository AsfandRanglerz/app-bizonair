$(document).on('load','.select2-container', function(){
    $(this).find('option[value="1"]').remove();
    alert('asd');
})

/*bizonair admin panel buttons hide base on particular urls*/
var windowUrl = window.location.href;
var companyProfUrl = "https://www.bizonair.com/admin/company-profiles";
var productUrl = "https://www.bizonair.com/admin/products";
var buySellUrl = "https://www.bizonair.com/admin/buy-sells";
var bannerCreateUrl = "https://www.bizonair.com/admin/banners";
var editCompanyUrl = "https://www.bizonair.com/admin/company-profiles";

if(windowUrl == companyProfUrl || windowUrl == productUrl ||  windowUrl == buySellUrl ||  windowUrl == bannerCreateUrl) {
    $('.btn-success.btn-add-new').hide();
}
if(windowUrl == editCompanyUrl) {
    $('.btn-primary').hide();
}
/*bizonair admin panel buttons hide base on particular urls*/

/*dashboard sidebar link removed*/
$('.title:contains(Trade Managements)').closest('li').remove();
/*dashboard sidebar link removed*/
