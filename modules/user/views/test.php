
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/flowplayer/flowplayer-3.2.13.min.js"></script>
<a id="player"></a>
<script>
    $(document).ready(function() {

        $f("player", "<?php echo base_url(); ?>public/flowplayer/flowplayer-3.2.18.swf", {
            plugins: {
                controls: {
                    fullscreen: true,
                }
            },
            clip: {
                url: "<?php echo base_url() . 'user/hide'; ?>", //Change this to any mp3 file in the secure folder
                autoPlay: true,
                baseUrl: "<?php echo base_url(); ?>"
            }

        });

    });
</script>