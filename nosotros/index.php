<!doctype html>

<html lang="es">

<?php include '../head.php' ?>

<body class="we">

    <?php include '../menu.php' ?>

    <?php include 'section_1_banner_we.php' ?>
    <?php include 'section_2_info_we.php' ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <iframe width="100%" height="600px" src="https://www.youtube.com/embed/gbEZfRgDW7A" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <?php include "../footer_w.php" ?>
    <!-- translate -->
    <script type="text/javascript">
        
    $(document).ready(function(){
      var selector = '#translateEn';
      $(selector).on('click', function(e){
        e.preventDefault();
        startLang( $(this) );
      });
      var startLang = function(el){
        var el = $(el);
        var text = el.attr('data-text');
        var file = el.attr('data-file');
        file = file.split(',');
        text = text.split(',');
        var index = el.attr('data-index');
        if(index >= file.length){
          index = 0;
        }
        changeName(el, text[index]);
        changeIndex(el, index);
        loadLang(file[index]);
        $('html').attr('lang', file[index]);
      };

      var changeName = function(el, name){
        $(el).html( name );
      };

      var changeIndex = function(el, index){
        $(el).attr('data-index', ++index);
      };

      var loadLang = function(lang){
        var processLang = function(data){
          var arr = data.split('\n');
          for(var i in arr){
            if( lineValid(arr[i]) ){
              var obj = arr[i].split('=>');
              assignText(obj[0], obj[1]);
            }
          }
        };
        var assignText = function(key, value){
          $('[data-lang="'+key+'"]').each(function(){
            var attr = $(this).attr('data-destine');
            if(typeof attr !== 'undefined'){
              $(this).attr(attr, value);
            }else{
              $(this).html(value);
            }
          });
        };
        var lineValid = function(line){
          return (line.trim().length > 0);
        };
        $('.loading-lang').addClass('show');
        $.ajax({
          
          url: 'lang/'+lang+'.txt',
          error:function(){
            alert('No se cargó traducción');
          },
          success: function(data){
            $('.loading-lang').removeClass('show');
            processLang(data);
          }
        });
      };
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <!-- translate -->
</body>

</html>