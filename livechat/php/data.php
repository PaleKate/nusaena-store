<?php
    while($row = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($koneksidb, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
		
		$output .= '<a href="chat.php?admin_id='. $row['unique_id'] .'">
                    <div class="content border-left-primary">
                    <img src="../administrator/img/admin/'. $row['img'] .'" alt="">
                    <div class="details">
                        <span>'. $row['username'].'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>';
		$belum_terbaca = mysqli_query($koneksidb,"SELECT * FROM messages WHERE status=0 
						AND outgoing_msg_id={$row['unique_id']} AND incoming_msg_id={$outgoing_id} ");
		$jumlah_belum_terbaca = mysqli_num_rows($belum_terbaca);
			if($jumlah_belum_terbaca > 0){
				$output .='<div class="col-auto" 
							style="margin-left:50%;padding:5px;background:#e9222c;font-size:11px;color:#fff;border-radius:5px;">
							<span>'. $jumlah_belum_terbaca.'</span></div>';
			}
        $output .='<div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>