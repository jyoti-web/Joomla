<div class="contactus-form contactus-<?php if (isset($fields->margin)){echo $fields->margin;}; ?>">
	<form  class="reg_form" action="<?php echo JFactory::getURI();?>" method="post" onsubmit="joomly_analytics();contactus_validate(this);" enctype="multipart/form-data">
		<div>
			<?php if (($fields->name!==null ? $fields->name : 1)  == 1){?>
				<div class="joomly-contactus-div">
					<input type="text" placeholder="<?php echo JText::_('MOD_CONTACTUS_NAME');if (($fields->name_required!==null ? $fields->name_required : 0)  == 1){echo "*";};?>" class="contactus-fields" name="name" <?php if (($fields->name_required !==null ? $fields->name_required : 0)  == 1){echo "required";};?> value="<?php if (isset($data['name'])){echo $data['name'];};?>">
				</div>
			<?php }?>		
			<?php if (($fields->email !==null ? $fields->email : 1)  == 1){?>
				<div class="joomly-contactus-div">
					<input type="email" placeholder="<?php echo JText::_('MOD_CONTACTUS_EMAIL');if (($fields->email_required !==null ? $fields->email_required : 1)  == 1){echo "*";};?>" class="contactus-fields" name="email" <?php if (($fields->email_required !==null  ? $fields->email_required : 1)  == 1){echo "required";};?> value="<?php if (isset($data['email'])){echo $data['email'];};?>">
				</div>
			<?php }?>
			<?php if (($fields->phone !==null ? $fields->phone : 1)  == 1){?>
				<div class="joomly-contactus-div">
					<input type="tel" pattern="(\+?\d[- .\(\)]*){5,15}" placeholder="<?php echo JText::_('MOD_CONTACTUS_PHONE');if (($fields->phone_required !==null ? $fields->phone_required : 1)  == 1){echo "*";};?>" class="contactus-fields" name="phone" <?php if (($fields->phone_required !==null ? $fields->phone_required : 0)  == 1){echo "required";};?> value="<?php if (isset($data['phone'])){echo $data['phone'];};?>">
				</div>
			<?php }?>		
			<?php if (($fields->subject !==null ? $fields->subject : 1)  == 1){?>
				<div class="joomly-contactus-div">
					<input type="text" placeholder="<?php echo JText::_('MOD_CONTACTUS_SUBJECT');if (($fields->subject_required !==null ? $fields->subject_required : 0)  == 1){echo "*";};?>" class="contactus-fields" name="subject"  <?php if (($fields->subject_required !==null ? $fields->subject_required : 0)  == 1){echo "required";};?> value="<?php if (isset($data['subject'])){echo $data['subject'];};?>">
				</div>
			<?php }?>	
				<?php if (($fields->message !==null ? $fields->message : 1)  == 1){?>
			<div>
				<textarea class="contactus-textarea" placeholder="<?php echo JText::_('MOD_CONTACTUS_MESSAGE');if (($fields->message_required !==null  ? $fields->message_required : 0)  == 1){echo "*";};?>" name="message" cols="120" rows="6" <?php if (($fields->message_required !==null ? $fields->message_required : 0)  == 1){echo "required";};?>><?php if (isset($data['message'])){echo $data['message'];};?></textarea><div class="message"><?php echo JText::_('COM_MESSAGE_CONTACTUS');?></div>
			</div>
			<?php }?>
			<div>
				<input type="text" name="phones" class="contactus-fields-const" style="display: none;"/>
			</div>		
			<?php if ((isset($fields->personal) ? $fields->personal : 1)  == 1){?>
				<div class="joomly-contactus-div">
					<label class="contactus-label-<?php if (isset($fields->margin)){echo $fields->margin;}; ?>"><a href="<?php if (!empty($fields->personal_link)){ echo $fields->personal_link;};?>" target="_blank"><?php echo JText::_('MOD_CONTACTUS_CONSENT_PERSONAL_DATA');?></a><input type="checkbox" class="joomly-contactus-checkbox" checked required></label>
				</div>	
			<?php }?>			
		</div>
		<div>
			<button type="submit" value="save" class="contactus-button contactus-submit contactus-<?php if (isset($fields->margin)){echo $fields->margin;}; ?>" style="background-color: <?php echo (isset($fields->color) ? $fields->color : "#21ad33");?>;" id="button-contactus-lightbox"><?php if ((isset($fields->button_send)) &&($fields->button_send !== '')) { echo $fields->button_send;} else {echo  JText::_('MOD_CONTACTUS_SEND');};?></button>
		</div>
		<div>
			<input type="hidden" name="option" value="com_contactus" />
			<input type="hidden" name="module_id" value="<?php echo $module->id;?>" />	
			<input type="hidden" name="module_hash" value="<?php echo JUserHelper::getCryptedPassword(JFactory::getURI()->toString());?>" />
			<input type="hidden" name="page" value="<?php echo urldecode($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?>" />
			<input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR'];?>" />
			<input type="hidden" name="task" value="add.save" />
			<?php echo JHtml::_('form.token'); ?>
		</div>	
	</form>
</div>
<div class="contactus-alert" id="contactus-sending-alert<?php if (isset($module->id)){echo $module->id;};?>">
	<div class="contactus-lightbox-caption" style="background-color:<?php echo $alert_message_color;?>;">
		<div class="contactus-lightbox-cap"><h4 class="contactus-lightbox-text-center"><?php if (isset($alert_headline_text)){echo $alert_headline_text;};?></h4></div><div class="contactus-lightbox-closer"><i id="contactus-lightbox-sending-alert-close<?php if (isset($module->id)){echo $module->id;};?>" class="fas fa-times"></i></div>
	</div>
	<div class="contactus-alert-body">
		<p class="contactus-lightbox-text-center"><?php if (isset($alert_message_text)){echo $alert_message_text;};?></p>
	</div>
</div>
<script type="text/javascript">
var contactus_module_id = <?php if (isset($module->id)){echo $module->id;};?>,
type_field = "<?php echo JText::_('MOD_CONTACTUS_TYPE_FIELD');?>",
defense_error = "<?php echo JText::_('MOD_CONTACTUS_DEFENSE_ERROR');?>",
filesize_error = "<?php echo JText::_('MOD_CONTACTUS_FILESIZE_ERROR');?>",
styles = "<?php echo $styles;?>";
var contactus_params = <?php echo json_encode($contactus_params);?>;
contactus_form();
</script>