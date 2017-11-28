<audio controls id="audio">
    <source id="audio-source" src="#" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<script type="text/javascript">
    $(document).ready(function() {
        var currently_playing = false;
        var audio = document.getElementById('audio');
        console.log("0000");
        setInterval(function() {
            if (audio.ended) {
                console.log("111");
                $.ajax({
                    url: ' {{ action('PlayerController@refresh') }}',
                    type: 'POST',
                    data: {
                        currently_playing: currently_playing
                    },
                    success: function(response) {
                        var json = $.parseJSON(response);
                        currently_playing = json.currently_playing;
                        if (json.request_available) {
                            audio.src = '{{asset('assets/')}}' + json.src;
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
                        var json = $.parseJSON(response);
                        if (json.request_available == true && !currently_playing) {
                            audio.src = '{{ asset('assets/') }}' + json.src;
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
        }, 3000);
    });
</script>