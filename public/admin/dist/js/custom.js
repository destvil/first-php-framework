;(function() {
  let path = window.origin + location.pathname; // Полный путь

  // SummerNote Custom Button: "Open Folder", for KCFinder
    let btnOF = function (context) {
    let ui = $.summernote.ui;

    // create button
      let button = ui.button({
      contents: '<i class="fa fa-folder-open"/>',
      tooltip: 'Open Folder',
      click: function () {
        openKCFinder(document.createElement('div'));
      }
    });

    return button.render();   // return button as jquery object
  }

  // Summernote
  $('#bs_editor').summernote({
    placeholder: 'Контент',
    tabsize: 2,
    height: 150,
    lang: 'ru-RU',
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'italic', 'underline', 'clear']],
      ['fontname', ['fontname']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link']],
      ['mybutton', ['openFolder']],
      ['insert', ['picture', 'video']],
      ['view', ['fullscreen', 'codeview']],
    ],
    buttons: {
      openFolder: btnOF
    },
    callbacks: {
      onImageUpload: function(files) {
        for(let i=0; i < files.length; i++) {
          $.upload(files[i]);
        }
      }
    }
  });

  // Upload images
  $.upload = function (file) {
    let out = new FormData();
    out.append('file', file, file.name);

    $.ajax({
      method: 'POST',
      url: '/admin/product/add/',
      contentType: false,
      cache: false,
      processData: false,
      data: out,
      success: function (url) {
        $('#bs_editor').summernote('insertImage', url);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error(textStatus + " " + errorThrown);
      }
    });
  };


  // Integration KCFinder
  function openKCFinder(div) {
    window.KCFinder = {
      callBack: function(url) {
        window.KCFinder = null;
        div.innerHTML = '<div style="margin:5px">Loading...</div>';
        $('#bs_editor').summernote('insertNode', div);
        var img = new Image();
        img.src = url;
        img.onload = function() {
          div.innerHTML = '<img id="img" src="' + url + '" />';
          /*var img = document.getElementById('img');
          var o_w = img.offsetWidth;
          var o_h = img.offsetHeight;
          var f_w = div.offsetWidth;
          var f_h = div.offsetHeight;
          if ((o_w > f_w) || (o_h > f_h)) {
            if ((f_w / f_h) > (o_w / o_h))
              f_w = parseInt((o_w * f_h) / o_h);
            else if ((f_w / f_h) < (o_w / o_h))
              f_h = parseInt((o_h * f_w) / o_w);
            img.style.width = f_w + "px";
            img.style.height = f_h + "px";
          } else {
            f_w = o_w;
            f_h = o_h;
          }
          img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
          img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
          img.style.visibility = "visible";*/
        }
      }
    };
    window.open( window.origin + '/admin/plugins/kcfinder/browse.php?type=images&lang=ru&dir=images/public&opener=custom',
        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
  }

  // select2 for add product
  $(".select2").select2({
    placeholder: "Начните вводить наименование товара",
    //minimumInputLength: 2,
    cache: true,
    ajax: {
      url: location.origin + "/admin/product/related-product/",
      delay: 250,
      dataType: 'json',
      data: function (params) {
        return {
          q: params.term,
          page: params.page
        };
      },
      processResults: function (data, params) {
        return {
          results: data.items,
        };
      },
    },
  });

  // AjaxUpload
  if($('button').is('#single')) {
    let buttonSingle = $("#single");
    let single_error = buttonSingle.closest('.file-upload').find('.text-error');
    new AjaxUpload(buttonSingle, {
      action: location.origin + '/admin/' + buttonSingle.data('url') + "?upload=1",
      data: {name: buttonSingle.data('name')},
      name: buttonSingle.data('name'),
      onSubmit: function(file, ext){
        single_error.css({'opacity':'0'});
        if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
          alert('Ошибка! Разрешены только картинки');
          return false;
        }
        buttonSingle.closest('.file-upload').find('.overlay').css({'display':'block'});

      },
      onComplete: function(file, response){
        setTimeout(function(){
          buttonSingle.closest('.file-upload').find('.overlay').css({'display':'none'});

          response = JSON.parse(response);
          if(response.error) {
            single_error.text(response.error).css({'opacity':'1'});
          } else {
            $('.' + buttonSingle.data('name')).html('<div class="img-block"><img src="/images/upload/' + response.file + '" style="max-height: 150px;"><a href="" class="del-img"><i class="far fa-times-circle"></i></a></div>');
          }
        }, 1000);
      }
    });
  }
  if($('button').is('#multi')) {
    let buttonMulti = $("#multi");
    let multi_error = buttonMulti.closest('.file-upload').find('.text-error');
    new AjaxUpload(buttonMulti, {
      action: location.origin + '/admin/' + buttonMulti.data('url') + "?upload=1",
      data: {name: buttonMulti.data('name')},
      name: buttonMulti.data('name'),
      onSubmit: function(file, ext){
        multi_error.css({'opacity':'0'});
        if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
          alert('Ошибка! Разрешены только картинки');
          return false;
        }
        buttonMulti.closest('.file-upload').find('.overlay').css({'display':'block'});

      },
      onComplete: function(file, response){
        setTimeout(function(){
          response = JSON.parse(response);
          buttonMulti.closest('.file-upload').find('.overlay').css({'display':'none'});
          if(response.error) {
            multi_error.text(response.error).css({'opacity':'1'});
          } else {
            $('.' + buttonMulti.data('name')).append('<div class="img-block"><img src="/images/upload/' + response.file + '" style="max-height: 150px;"><a href="" class="del-img"><i class="far fa-times-circle"></i></a></div>');
          }
        }, 1000);
      }
    });
  }

  // Удаление загруженных картинок для заказа
  $('#product-images .file-upload').on('click', '.del-img', function (e) {
    if(e.target.className = 'del-img') e.preventDefault();
    let target = $(this);
    let img_name = target.siblings('img').attr('src');
    img_name = img_name.split('/').pop();
    let img_type = target.parents().eq(1).attr('class');
    $.ajax({
      url: location.origin + '/admin/product/delete-image/',
      data: {img_del: img_name, img_type: img_type},
      type: 'GET',
      success: function () {
        target.closest('.img-block').remove();
      },
      error: function () {
        $(this).closest('.card-body').find('.text-error').text('Произошла ошибка!');
      }
    });
  });

  // Скрытие/показ деталей заказа в списке заказов
  $('#orderDetail').on('click', function() {
    $('#collapseOne').collapse('toggle');
  });

  // Функция для добавления проверки подтверждения действий
  function addConfirmAction(arr) {
    arr.forEach(item => {
      if(item.length == 2) {
        $(item[0]).on('click', item[1], function() {
          let res = confirm('Подтвердите действие');
          if(!res) return false
        });
      } else {
        $(item[0]).on('click', function() {
          let res = confirm('Подтвердите действие');
          if(!res) return false
        });
      }
    });
  }

  addConfirmAction([
      ['.order-control', 'button'],
      ['.card-body', '.delete']
  ]);

  // Автоматическое скрытие уведомлений
  $('.admin-nonify').delay(3000).fadeOut('slow');

  // Подсветка активных пунктов меню
  $('.sidebar .nav-link').each(function () {
    let link = this.href;
    if(link == path) {
      $(this).closest('.has-treeview').addClass('menu-open');
      $(this).addClass('active');
    }
  });

  // Симметричная высота для форм
  $('.card-users_orders').height($('.card-users').height());
  $('.card-users_orders .card-footer').height($('.card-users .card-footer').height());

})();

