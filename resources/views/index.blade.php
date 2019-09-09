<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>Youtube Search List</title>
</head>
<body>

  <!-- search bar for youtube search key -->
  <div class="mx-auto mt-5" style="width: 400px;">
    <div class="input-group">
      <input type="text" class="search-query form-control" placeholder="Youtube Search Video" />
      <span class="input-group-btn">
          <button class="btn btn-danger" id='search_yt_btn' type="button">
              <span class=" glyphicon glyphicon-search"></span>
          </button>
      </span>
    </div>
  </div>

<div class="container">
  <hr class="mt-5 mb-5">
  <div class="row text-center text-lg-left" id='video_list_container'>

  </div>
</div>


<!--
    <input class="getinfo"></input>
    <button class="postbutton">Post via ajax!</button>
    <div class="writeinfo"></div> -->

</body>

</html>
<script  src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $("#search_yt_btn").click(function(){
            $.ajax({
                url: '/youtube_search',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {_token: CSRF_TOKEN, search_query:$(".search-query").val()},
                dataType: 'JSON',
                success: function (data) {
                  $('#video_list_container').html('');
                  $.each(data.msg.items, function() {
                      $('#video_list_container').append('<div class="col-lg-3 col-md-4 col-6">'+
                                          '<a href="#" class="d-block mb-4 h-100">'+
                                              '<iframe class="img-fluid img-thumbnail" allowfullscreen="0" src="//www.youtube.com/embed/'+this.id.videoId+'"></iframe>'+
                                                '<span>'+this.snippet.title+'</span>'+
                                            '</a>'+
                                        '</div>');
                  });
                }
            });
        });
   });
</script>
