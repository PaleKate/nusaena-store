<?php 
    session_start();
    if(isset($_SESSION['alogin'])){
        include('../includes/config.php');
        $outgoing_id = $_SESSION['alogin'];
        $incoming_id = mysqli_real_escape_string($koneksidb, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($koneksidb, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){ ?>
                    <div class="chat outgoing">
					<?php if($row['type'] == "gambar"){?>
						<div class="details">
							<p style="margin:0;"><a href="php/images/<?php echo $row['msg']; ?>" target="_blank">
								<img style="width:220px; height:auto; border-radius:0;" src="php/images/<?php echo $row['msg']; ?>" alt="">
							</a></p>
							<h6 style="float:right;font-size:12px;margin:0;"><?php echo $row['time']; ?></h6>
						</div>
					<?php }else{ ?>
						<div class="details">
							<p style="margin:0;"><?php echo $row['msg']; ?></p>
							<h6 style="float:right;font-size:12px;margin:0;"><?php echo $row['time']; ?></h6>
						</div>
					<?php }?>
					</div>
                <?php }else{ ?>
                    <div class="chat incoming">
					<?php if($row['type'] == "gambar"){?>
						<div class="details">
							<p style="margin:0;"><a href="../livechat/php/images/<?php echo $row['msg']; ?>" target="_blank">
								<img style="width:220px; height:auto; border-radius:0;" src="../livechat/php/images/<?php echo $row['msg']; ?>" alt="">
							</a></p>
							<h6 style="font-size:12px;margin:0;"><?php echo $row['time']; ?></h6>
						</div>
					<?php }else{ ?>
						<div class="details">
							<p style="margin:0;"><?php echo $row['msg']; ?></p>
							<h6 style="font-size:12px;margin:0;"><?php echo $row['time']; ?></h6>
						</div>
					<?php }?>
					</div>
                <?php }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../index.php");
    }
	mysqli_query($koneksidb,"UPDATE messages SET status='1' WHERE outgoing_msg_id={$incoming_id} AND incoming_msg_id={$outgoing_id} ");

?>