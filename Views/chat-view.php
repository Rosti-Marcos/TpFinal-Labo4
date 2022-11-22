<?php include "header2.php";
      include "nav-bar.php";
?>
    <style>
        h2{
            color:white;
        }
        label{
            color:white;
        }
        span{
            color:#673ab7;
            font-weight:bold;
        }
        .container {
            margin-top: 3%;
            width: 60%;
            background-color: #26262b9e;
            padding-right:10%;
            padding-left:10%;
        }
        .btn-primary {
            background-color: #673AB7;
        }
        .display-chat{
            height:300px;
            background-color:#d69de0;
            margin-bottom:4%;
            overflow:auto;
            padding:15px;
        }
        .message{
            background-color: #c616e469;
            color: white;
            border-radius: 5px;
            padding: 5px;
            margin-bottom: 3%;
        }
    </style>




    <div class="container">
        <center><h2>Wellcome <span style="color:#dd7ff3;"><?php echo $_SESSION['loggedUser']->getName(); ?> !</span></h2>
            <label>Heres is a chat room, where you can close some details!</label>
        </center></br>
        <div class="display-chat" id = "display-chat">
            <?php
            $chatController = new \Controllers\ChatController();
            if(!empty($msgList)){

               foreach($msgList as $msg){

                    if($msg->getActive()=="1"){ ?>
                    <div class="message">
                        <p>

                            <span><?php echo $msg->getDate()?> :</span>
                            <?php } ?>
                            <span><?php echo $msg->getName()?> :</span>
                            <?php echo $msg->getMessage()?>
                        </p>
                    </div>
                <?php }

            }else{?>
                <div class="message">
                    <p>
                        There are no previous messages.
                    </p>
                </div>
            <?php } ?>



        </div>



        <form class="form-horizontal" method="post" action="<?php echo FRONT_ROOT."Chat/SendMsg" ?>">
            <div class="form-group">
                <div class="col-sm-10">

                    <textarea name="msg" class="form-control" placeholder="Enter your message..."></textarea>


                    <input type="hidden" name="tableName" value="<?php echo $tableName ?>">

                </div>

                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary" >Enviar</button>
                </div>

            </div>
        </form>
    </div>


    </body>
    </html>

