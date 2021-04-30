/**
 * Feedback frontend script
 */
var FeedbackWidget = {
	/**
	 * @var string error success
	 */
	msgSuccess: "Ваша заявка принята.",

	/**
	 * @var string error message
	 */
	msgError: "Произошла ошибка на сервере, повторите подачу заявки позже.",

	/**
	 * Initialization.
	 */
	init: function(formId) {
	},

	/**
	 * Clone
	 * @link http://www.askdev.ru/javascript/53/%D0%9A%D0%B0%D0%BA-%D0%B2-JavaScript-%D0%BA%D0%BB%D0%BE%D0%BD%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D1%82%D1%8C-%D0%BE%D0%B1%D1%8A%D0%B5%D0%BA%D1%82/
	 */
	clone: function(obj) {
		if(obj == null || typeof(obj) != 'object')
			return obj;
		var temp = new obj.constructor();
		for(var key in obj)
			temp[key] = this.clone(obj[key]);

		return temp;
	},

	/**
	 * After validate handler
	 * @see Yii \CActiveForm
	 */
	afterValidate: function (form, data, hasError)
	{
		$(form).find(".feedback-body").removeClass("success");
		if (hasError) {
			$(form).find(".inpt-error").removeClass("inpt-error");
			for(var key in data) {
				if(key.indexOf('feedback') === 0) {
					$(form).find("#"+key).addClass("inpt-error");
				}
			}
		}
		else {
			var id = $(form).attr("id");
			var my_form = document.getElementById(id);

			var form_data = new FormData(my_form);

			$.ajax({
				url: $(form).attr("action"),
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(data){
					if ((data.html != undefined)) {
						var $body = $(form).find(".feedback-body");
						var html = $body.html();
						$(form).html(data.html);
					} else {
						var $body = $(form).find(".feedback-body");
						var html = $body.html();
						$body.html((data.message != undefined) ? data.message : ((data.success == true) ? FeedbackWidget.msgSuccess : FeedbackWidget.msgError));
					}
					setTimeout(function(){
						$body.removeClass("successed");
						$body.html($.parseHTML(html));
						if($body.find("[class*='phone']").length) {
							$body.find("[class*='phone']").inputmask({mask: '+7 ( 999 ) 999 - 99 - 99'});
						}
						$body.find(".feedback-submit-button").show();
					},3000);
				},
				error: function(){
					var $body = $(form).find(".feedback-body");
					var html = $body.html();
					$body.html(FeedbackWidget.msgError);
					setTimeout(function(){
						$body.removeClass("successed");
						$body.html($.parseHTML(html));
						if($body.find("[class*='phone']").length) {
							$body.find("[class*='phone']").inputmask({mask: '+7 ( 999 ) 999 - 99 - 99'});
						}
						$body.find(".feedback-submit-button").show();
					},3000);
				}
			});
			/*$(form).find(".feedback-submit-button").hide();
            var file_data = $('#feedback_models_FeedbackModel_file').prop('files')[0];
            if(file_data){
                var form_data = new FormData();
                form_data.append('file', file_data);


                //$(form).find('#feedback_models_FeedbackModel_file').val(file_data.name);
                var action = $(form).attr("action");
                var action_file = action.replace("/send", "/file");
                console.log(action_file);

                $.ajax({
                        url: action_file,
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function(){

                        }
                });

                var str = form.serialize();
                var serialize = str.replace("file%5D=", "file%5D=" + file_data.name);
            }else{
                var serialize = form.serialize();
            }


            $.post($(form).attr("action"), serialize, function(json) {
                if(json.success){$(form).find(".feedback-body").addClass("successed");$(form).trigger('cms.feedback.sended');}
                (function(){
                      $(form).find(".inpt-error").removeClass("inpt-error");
                      if ((json.html != undefined)) {
                        $(form).html(json.html)
                    } else {
                        var $body = $(form).find(".feedback-body");
                        var html = $body.html();
                        $body.html((json.message != undefined) ? json.message : ((json.success == true) ? FeedbackWidget.msgSuccess : FeedbackWidget.msgError));
                    }
                    /*
                      setTimeout(function(){
                        $body.removeClass("successed");
                        $body.html($.parseHTML(html));
                        if($body.find("[class*='phone']").length) {
                                                    $body.find("[class*='phone']").inputmask({mask: '+7 ( 999 ) 999 - 99 - 99'});
                        }
                        $body.find(".feedback-submit-button").show();
                    },7000);
                    /*
                })();
            }, "json");*/
		}

		return false;
	}
}
