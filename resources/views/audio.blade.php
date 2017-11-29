<script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<audio controls id="audio">
    <source id="audio-source" src="#" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<script type="text/javascript">
    $(document).ready(function() {
        var currently_playing = false;
        var audio = document.getElementById('audio');

        setInterval(function() {
            if (audio.ended) {
                $.ajax({
                    url: ' {{ action('PlayerController@refresh') }}',
                    type: 'POST',
                    data: {
                        currently_playing: currently_playing
                    },
                    success: function(response) {
                        console.log(response);
                        var json = $.parseJSON(response);
                        console.log(response);
                        currently_playing = json.currently_playing;
                        if (json.request_available) {
                            audio.src = '{{asset('')}}' + json.src;
                            audio.play();
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ action('PlayerController@refresh') }}',
                    type: 'POST',
                    data: {
                        currently_playing: currently_playing
                    },
                    success: function(response) {
                        console.log(response);
                        var json = $.parseJSON(response);
                        if (json.request_available == true && !currently_playing) {
                            audio.src = '{{ asset('') }}' + json.src;
                            console.log('URL: ' + audio.src);
                            audio.play();
                            currently_playing = json.currently_playing;
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });
            }
        }, 1000);
    });
</script>