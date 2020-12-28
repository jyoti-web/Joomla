function contactus_validate(element)
{
	var inputs = element.getElementsByClassName("contactus-fields"),
		errorMessages = element.getElementsByClassName("contactus-error-message");
	for ( var i = errorMessages.length; i > 0; i-- ) {
			errorMessages[ i - 1].parentNode.removeChild( errorMessages[ i - 1] );
			console.log(i);
		}
	
	var flag = true;
	for (var i = 0; i < inputs.length; i++) {
		if ((inputs[i].hasAttribute("required")) && (inputs[i].required == true)  && (inputs[i].value.length == 0) && (inputs[i].parentNode.style.display !== "none")) { 
			parent = inputs[i].parentNode;
			parent.insertAdjacentHTML( "beforeend", "<div class='contactus-error-message'>" + 
			   type_field +
				"</div>" );
			flag = false;
		}
	}
	return flag;
}
function joomly_analytics(mod_id){
	if (contactus_params.yandex_metrika_id)
	{
		if (typeof Ya.Metrika !== "undefined"){
			var yaCounter= new Ya.Metrika(contactus_params.yandex_metrika_id);
			yaCounter.reachGoal(contactus_params.yandex_metrika_goal);
		} else if (typeof Ya.Metrika2 !== "undefined"){
			var yaCounter= new Ya.Metrika2(contactus_params.yandex_metrika_id);
			yaCounter.reachGoal(contactus_params.yandex_metrika_goal);
		}
	}
	if (contactus_params.google_analytics_action)
	{
		if (typeof ga === 'function') {
    		ga('send', 'event', contactus_params.google_analytics_category, contactus_params.google_analytics_action, contactus_params.google_analytics_label, contactus_params.google_analytics_value);
 		}
		if (typeof gtag === 'function') {
			var gtag_object = {};
			if (contactus_params.google_analytics_category){
				gtag_object.event_category = contactus_params.google_analytics_category;
			}
			if (contactus_params.google_analytics_label){
				gtag_object.event_label = contactus_params.google_analytics_label;
			}
			if (contactus_params.google_analytics_value){
				gtag_object.value = contactus_params.google_analytics_value;
			}
			gtag('event', contactus_params.google_analytics_action, gtag_object);
		}
	}
}
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
	"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
function getSendingFlag(m_id){
	var sendingalert = getCookie("sending-alert"),
		alerttype = getCookie("alert-type"),
		sflag = 0;
	if ((typeof sendingalert !== 'undefined') && (sendingalert == m_id))
	{
		al = document.getElementById("contactus-sending-alert" + m_id);
		if (alerttype == 'success')
		{
			sflag = 1;
		} else if (alerttype == 'captcha')
		{
			sflag = 2;
			al.childNodes[1].style.backgroundColor = "red";
			al.childNodes[3].childNodes[1].innerHTML = captcha_error;
		} else if (alerttype == 'file')
		{
			sflag = 3;
			al.childNodes[1].style.backgroundColor = "red";
			al.childNodes[3].childNodes[1].innerHTML = filesize_error;
		} else if (alerttype == 'defensive')
		{
			sflag = 4;
			al.childNodes[1].style.backgroundColor = "red";
			al.childNodes[3].childNodes[1].innerHTML = defense_error;
		}
		document.cookie = 'sending-alert=333; Path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
		document.cookie = 'alert-type=;Path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	} else 
	{
		sflag = 0;
	}	
	return sflag;
}
function contactus_form()
{
	var contactus_sending_flag = contactus_sending_flag || [];
	if (contactus_sending_flag[contactus_module_id] == undefined)
	{
		contactus_sending_flag[contactus_module_id] = getSendingFlag(contactus_module_id);
	}
	window.addEventListener('load', lightbox(contactus_module_id), false); 
		function lightbox(mod_id){		
			var st = document.getElementsByName("module_hash");
				for (var i=0; i < st.length; i++) {
					st[i].value = styles;
			}
			if (contactus_sending_flag[mod_id] >= 1){
				var lightbox = document.getElementById("contactus-sending-alert" + mod_id),
				dimmer = document.createElement("div"),
				close = document.getElementById("contactus-lightbox-sending-alert-close" + mod_id);
				
					dimmer.className = 'dimmer';
				
				dimmer.onclick = function(){
					dimmer.parentNode.removeChild(dimmer);			
					lightbox.style.display = 'none';
				}
				
				close.onclick = function(){
					dimmer.parentNode.removeChild(dimmer);			
					lightbox.style.display = 'none';
				}
					
				document.body.appendChild(dimmer);
				document.body.appendChild(lightbox);
				var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
				lightbox.style.display = 'block';
				if (window.innerHeight > lightbox.offsetHeight )
				{
					lightbox.style.top = scrollTop + (window.innerHeight- lightbox.offsetHeight)/2 + 'px';
				} else
				{
					lightbox.style.top = scrollTop + 10 + 'px';
				}
				if (window.innerWidth>400){
					lightbox.style.width = '400px';
					lightbox.style.left = (window.innerWidth - lightbox.offsetWidth)/2 + 'px';
				} else {
					lightbox.style.width = (window.innerWidth - 70) + 'px';
					lightbox.style.left = (window.innerWidth - lightbox.offsetWidth)/2 + 'px';
				}	
				
				setTimeout(remove_alert, 6000);
				
				function remove_alert()
				{
					if (lightbox.style.display  != "none")
					{
						dimmer.parentNode.removeChild(dimmer);			
						lightbox.style.display = 'none';
					}
				}
			}	
	}
}