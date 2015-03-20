<!-- File: /app/View/Posts/index.ctp -->

<h1 class="title">Message Board</h1>

<div id="messages" class="col-sm-12 col-md-6 col-lg-4">
	Welcome to our message board. <br />
	New messages arrive automatically every 10 seconds.
	<div id="message-list"></div>

	<?php
		echo $this->Form->create('Message');

		echo $this->Form->input('Message.user', array('label' => 'Name'));
		echo $this->Form->input('Message.message', array('label' => 'Message', 'type' => 'textarea', 'rows' => 2));

		echo $this->Form->end('Send');

	?>
</div>

<script>
    var lastMessage = 0;
	updateMessages();
    setInterval(updateMessages, 10000);


    function updateMessages(){
        $.ajax({
            url: baseUrl + 'messages/get_messages/' + lastMessage,
            dataType: 'html',
            success: function(msg) {
                $('#message-list').append(msg);
                if (msg) {
                	$("#message-list").scrollTop($("#message-list")[0].scrollHeight);
                }
                lastMessage = $('#message-list .message').last().data('id');
                $(".message .date span.relative").timeago();
            }
        });
    }	
</script>