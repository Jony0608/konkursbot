<?php

ob_start();

define('6228393327:AAHu9rnviBrZkdTb1HeQ50tBSNIHaDvyT2I');

$admin = array("798090785");

   function del($nomi){

   array_map('unlink', glob("$nomi"));

   }

function bot($method,$datas=[]){

    $url = "https://api.telegram.org/bot".API_KEY."/".$method;

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);

    $res = curl_exec($ch);

    if(curl_error($ch)){

        var_dump(curl_error($ch));

    }else{

        return json_decode($res);

    }

}

function step($cid,$value){

file_put_contents("bots/$cid/index.php","bay");

}

  

$update = json_decode(file_get_contents('php://input'));

$message = $update->message;

$mid = $message->message_id;

$cid = $message->chat->id;

$callback = $update->callback_query;    

$data = $update->callback_query->data;  

$callfrid = $update->callback_query->from->id; 

$cid2 = $update->callback_query->message->chat->id;  

$mesid = $update->callback_query->message->message_id;

$tx = $message->text;

mkdir("like");

mkdir("qat");

mkdir("data");

mkdir("data/$cid");

$emojilar = ['❤️','🧡','💛','💚','💙','💜','🖤','🤍','🤎','💔','❣','💕','💞','💓','💗','💖','💘','💝'];

$_emoj = array_rand($emojilar,1);

$emolar = $emojilar[$_emoj];

$kanal1 = file_get_contents("kanal.txt");

$iCoderNet = file_get_contents("data/$cid/iCoderNet.txt");

$step = file_get_contents("qat/$cid.step");

$qatnash = file_get_contents("qat/qatnashdi.dat");

$name = $message->from->first_name;

$user = $message->from->username;

$super = file_get_contents("konkur.txt");

$reply = $message->reply_to_message->text;

$rpl = json_encode([

           'resize_keyboard'=>false,

            'force_reply' => true,

            'selective' => true

        ]);

        $key = json_encode([

'resize_keyboard'=>true,

'keyboard'=>[

[['text'=>"🎉 Konkursda Qatnashish 🎊"]],

[['text'=>"🏆Sovrinlar🏆"],['text'=>"🔰Qoidalar"]],

]

]);

$adminkey = json_encode([

'resize_keyboard'=>true,

'keyboard'=>[

[['text'=>"🔧Qoidalarni o'zgartirish📝"]],

[['text'=>"📣Kanal qo'shish"],['text'=>"🔰Konkurs Tanlash"]],

[['text'=>"📝Konkurs Qatnashchilari"]],

[['text'=>"📌Statistika"],['text'=>"📨Xabar Yuborish"]],

[['text'=>"♻️Konkursda Qatnashish Tarixini Tozalash"]],

]

]);

$konk = json_encode([

'resize_keyboard'=>true,

'keyboard'=>[

[['text'=>"$super"]],

[['text'=>"🔙Orqaga"]],

]

]);

$pras = json_encode([

'resize_keyboard'=>true,

'keyboard'=>[

[['text'=>"✔️Roziman"]],

[['text'=>"🔙Orqaga"]],

]

]);

$from_id = $message->from->id;

$join = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@$kanal1&user_id=".$from_id);

if($message && (strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false){

bot('sendmessage',[

'chat_id'=>$cid,

    'text'=>"📛┇Kechirasiz do'stim  😿💔

🔰┇Botdan foydalanish uchun Kanalimizga obuna bo'lishingiz kerak🌐💜

📡┇Kanalimiz

@$kanal1

🖲┇Obuna Bo'lgandan sung { /start } Buyurugini Bosing🎀💜" ,

]);return false;}

if($tx=="🎉 Konkursda Qatnashish 🎊"){ 

$mykon=file_get_contents("qat/qatnashdi.dat"); 

if(mb_stripos($mykon,"$cid")!==false){ 

      bot('sendmessage',[ 

        'chat_id'=>$cid,

        'text'=>"Kechirasiz siz konkursda qatnashib bo'lgansiz!", 

        'reply_markup'=>$key,

    ]); 

}else{ 

     bot('sendmessage',[ 

        'chat_id'=>$cid, 

        'text'=>"Siz Konkursda bir marotaba ishtirok eta olasiz

Shu sababli hushyor bo'ling.

Sizga hozir bo'lib o'tayotgan konkursga yo'naltiramiz", 

        'reply_markup'=>$konk,

    ]);  

  }

}

if($tx == "📨Xabar Yuborish" && (in_array($cid,$admin))){

	file_put_contents("data/$cid/iCoderNet.txt","xabar");    bot('sendmessage',[

        'chat_id'=>$cid,

        'text'=>"Habarni Yuboring",

        'reply_markup'=>$rpl,

    ]);

}

if($iCoderNet=="xabar"){

$idss=file_get_contents("users.db");

      $idszs=explode("\n",$idss);

      foreach($idszs as $idlat){

      $hamma=bot('sendMessage',[

      'chat_id'=>$idlat,

      'parse_mode'=>'markdown',

      'text'=>$tx,

      ]);

      }

    }

if($hamma){

bot('sendmessage',[

'chat_id'=>$cid,

'text'=>"♻Hammaga habar yetkazildi✅",

]);

file_put_contents("data/$cid/iCoderNet.txt","");

}

if($tx == "♻️Konkursda Qatnashish Tarixini Tozalash" && (in_array($cid,$admin))){

    bot('sendmessage',[

        'chat_id'=>$cid,

        'text'=>"Konkurda Qatnashish tarixi tozalandi

Endi hamma a'zolar yana Konkursda qatnashishi mumkin",

        'reply_markup'=>$adminkey,

    ]);

    file_put_contents("qat/qatnashdi.dat","");

}

$lichka = file_get_contents("users.db");

$lich = substr_count($lichka,"\n");

$soat = date('H:i:s', strtotime('2 hour'));

$bugun = date('d-M Y',strtotime('2 hour'));

if($tx == "📌Statistika" && (in_array($cid,$admin))){

    bot('sendmessage',[

        'chat_id'=>$cid,

        'text'=>"🔷<b> Bot statistikasi:</b>

👤Bot A'zolari: <i>$lich</i>

👨🏻‍💻Admin: @notJony

$bugun $soat",

        'reply_markup'=>$adminkey,

    ]);

}

$lichkam = file_get_contents("qat/qatnashdi.dat");

$lichim = substr_count($lichkam,"\n");

if($tx == "📝Konkurs Qatnashchilari" && (in_array($cid,$admin))){

    bot('sendmessage',[

        'chat_id'=>$cid,

        'text'=>"🔷 Konkursda Qatnashayotganlar Ro'yhati:

👤Qatnashayotganlar soni: $lichim

👨🏻‍💻Admin: @notJony

Qatnashayotgan odamlarning 🆔 raqamlari

$lichkam",

        'reply_markup'=>$adminkey,

    ]);

}

$yuborish = "Konkurs qoidalarini kiriting";

$qoida = file_get_contents("qoida.txt");

if($tx == "🔧Qoidalarni o'zgartirish📝" && (in_array($cid,$admin))){

	file_put_contents("data/$cid/iCoderNet.txt","qoida");

    bot('sendmessage',[

        'chat_id'=>$cid,

        'text'=>"$yuborish",

        'reply_markup'=>$rpl,

    ]);

}

if($iCoderNet=="qoida"){

bot('Sendmessage',[

'chat_id'=>$cid,

'text'=>"Konkurs qoidalari o'zgartirildi.",

'parse_mode'=>"markdown",

'reply_markup'=>$adminkey,

]);

file_put_contents("qoida.txt","$tx");

file_put_contents("data/$cid/iCoderNet.txt","");

}

$kons = "Konkurs turini tanlang Like konkurs uchun ❤️Like  deb jo'nating Prasmostr konkurs uchun 👁️Prasmostr deb jo'nating";

if($tx == "🔰Konkurs Tanlash" && (in_array($cid,$admin))){

	file_put_contents("data/$cid/iCoderNet.txt","konk");

    bot('sendmessage',[

        'chat_id'=>$cid,

        'text'=>"$kons",

        'reply_markup'=>$rpl,

    ]);

}

if($iCoderNet=="konk"){

bot('Sendmessage',[

'chat_id'=>$cid,

'text'=>"Konkurs tanlandi",

'parse_mode'=>"markdown",

'reply_markup'=>$adminkey,

]);

file_put_contents("konkur.txt","$tx");

file_put_contents("data/$cid/iCoderNet.txt","");

}

$yubori = "Konkurs o'tkaziladigan Kanal userini jo'nating Misol: Php_Bot_Codes";

$kanal1 = file_get_contents("kanal.txt");

if($tx == "📣Kanal qo'shish" && (in_array($cid,$admin))){

	file_put_contents("data/$cid/iCoderNet.txt","kanal");

    bot('sendmessage',[

        'chat_id'=>$cid,

        'text'=>"$yubori",

        'reply_markup'=>$rpl,

    ]);

}

if($iCoderNet=="kanal"){

bot('Sendmessage',[

'chat_id'=>$cid,

'text'=>"Kanal Qo'shildi.",

'parse_mode'=>"markdown",

'reply_markup'=>$adminkey,

]);

file_put_contents("kanal.txt","$tx");

file_put_contents("data/$cid/iCoderNet.txt","");

}

if($tx=="/panel" && (in_array($cid,$admin))){

file_put_contents("data/$cid/iCoderNet.txt","");

bot('sendmessage',[

'chat_id'=>$cid,

'text'=>"Salom Admin  siz uchun bo'limlar ochiq",

'reply_markup'=>$adminkey,

]);

}

if($tx=="/start" or $tx=="🔙Orqaga"){

file_put_contents("data/$cid/iCoderNet.txt","");

bot('sendmessage',[

'chat_id'=>$cid,

'text'=>"Kerakli Bo'limni tanlang ♻️",

'reply_markup'=>$key,

]);

}

$type = $message->chat->type;

$lichka = file_get_contents("users.db");

if($type == "private"){

    if(strpos($lichka,"$cid") !==false){

    }else{

        file_put_contents("users.db","$lichka\n$cid");

    }

}

$qoida = file_get_contents("qoida.txt");

if($tx=="🏆Sovrinlar🏆" or $tx=="🔰Qoidalar"){

bot('sendmessage',[

'chat_id'=>$cid,

'text'=>"$qoida",

'reply_markup'=>$key,

]);

}

if($iCoderNet=="tan"){ 

$mykon=file_get_contents("qat/qatnashdi.dat"); 

if(mb_stripos($mykon,"$cid")!==false){ 

      bot('sendmessage',[ 

        'chat_id'=>$cid,

        'text'=>"😡😡😡Kechirasiz siz konkursda qatnashib bo'lgansiz! Bu hol Yana takrorlansa konkursdan haydalasiz va botdan banlanasiz📛", 

        'reply_markup'=>$key,

    ]); 

}else{ 

    $file_id = $message->photo[0]->file_id;

	$caption = $message->caption;

	$tokenn=uniqid("true");

	$kanal1 = file_get_contents("kanal.txt");

$gamer=file_get_contents("qat/qatnashdi.dat"); 

	file_put_contents("qat/qatnashdi.dat", "$gamer\n$cid");

			bot('sendPhoto',[

			'chat_id'=>"@$kanal1",

			"photo"=>$file_id,

			"caption"=>" [$name](tg://user?id=$cid) doʻstimiz gʻolib boʻlishi uchun bitta like bosvorilar

 [$name](tg://user?id=$cid) ❤️ Like yig'ishni boshlang

 

 🤝 Sizga Omad tilaymiz. Albatta G'olib bo'ling 🏆

[📣 Bizning Kanal bilan qoling ♻️](t.me/$kanal1)",

'parse_mode'=>"markdown",

'inline_query_id'=>$qid, 

        'reply_markup'=>json_encode([ 

        'inline_keyboard'=>[ 

       [['text'=>"$emolar", 'callback_data'=>"$tokenn=❤️"]],

       [['text'=>"🎉 Konkursda qatnashish 🏆", "url"=>"https://telegram.me/Koncurs_UzBot"]], 

       ] 

       ]) 

       ]);

sleep(1);

file_put_contents("data/$cid/iCoderNet.txt","");

bot('Sendmessage',[

'chat_id'=>$cid,

'text'=>"*👌Endi siz Konkurs ishtirokchisi bo'ldingiz \n @$kanal1 ga kirib ko'rishingiz mumkin \nLike yig'ishni boshlang Sizga omad *",

'parse_mode'=>"markdown",

'reply_markup'=>$key,

    ]);  

  }

}

if(mb_stripos($data,"=")!==false){ 

$ex=explode("=",$data); 

$calltok=$ex[0]; 

$emoj=$ex[1]; 

$mylike=file_get_contents("like/$calltok.$cid.dat"); 

if(mb_stripos($mylike,"$callfrid")!==false){ 

      bot('answerCallbackQuery',[ 

        'callback_query_id'=>$qid, 

        'text'=>"Kechirasiz siz ovoz berib bo'lgansiz!", 

        'show_alert'=>false, 

    ]); 

}else{ 

file_put_contents("like/$calltok.$cid.dat","$mylike\n$callfrid=$emoj"); 

$value=file_get_contents("like/$calltok.$cid.dat"); 

$lik=substr_count($value,"❤️"); 

$des=substr_count($value,"👎"); 

     bot('editMessageReplyMarkup',[ 

        'chat_id'=>$cid2, 

        'message_id'=>$mesid,

        'inline_query_id'=>$qid,

        'reply_markup'=>json_encode([ 

        'inline_keyboard'=>[ 

       [['text'=>"$emolar $lik", 'callback_data'=>"$calltok=❤️"]], 

       [['text'=>"🎉 Konkursda qatnashish 🏆", "url"=>"https://telegram.me/usernamebotniki"]],  

       ] 

       ]) 

       ]);

       bot('answerCallbackQuery',[ 

        'callback_query_id'=>$qid, 

        'text'=>"Ovozingiz qabul qilindi!", 

        'show_alert'=>false, 

    ]);  

  }

}

if($tx=="❤️Like" or $tx=="❤️ Like"){ 

$mykon=file_get_contents("qat/qatnashdi.dat"); 

if(mb_stripos($mykon,"$cid")!==false){ 

      bot('sendmessage',[ 

        'chat_id'=>$cid,

        'text'=>"Kechirasiz siz konkursda qatnashib bo'lgansiz!", 

        'reply_markup'=>$key,

    ]); 

}else{ 

	file_put_contents("data/$cid/iCoderNet.txt","tan");

     bot('sendmessage',[ 

        'chat_id'=>$cid, 

        'text'=>"Konkursda qatnashish uchun  rasm(istagan rasm => 18+ yoki Reklama rasm bo'lmasligi kerak) yuboring♻️", 

        'reply_markup'=>$reply,

       ]);

  }

}

if($tx=="✔️Roziman" && $iCoderNet=="pras"){ 

$mykon=file_get_contents("qat/qatnashdi.dat"); 

if(mb_stripos($mykon,"$cid")!==false){ 

      bot('sendmessage',[ 

        'chat_id'=>$cid,

        'text'=>"Kechirasiz siz konkursda qatnashib bo'lgansiz!", 

        'reply_markup'=>$key,

    ]); 

}else{ 

	$kanal1 = file_get_contents("kanal.txt");

	$gamer=file_get_contents("qat/qatnashdi.dat"); 

	file_put_contents("qat/qatnashdi.dat", "$gamer\n$cid");

			bot('sendmessage',[

			'chat_id'=>"@$kanal1",

			"text"=>"[$name](tg://user?id=$cid) 👁️Prasmostr va Like yig'ishni boshlang!

 

 🤝 Sizga Omad tilaymiz. Albatta G'olib bo'ling 🏆

 

 👑 Siz ham konkursda qatnashmoqchimisiz

 

 🌀 Unday bo'lsa 🎉 Konkursda qatnashish 🏆 

 

 🔘 Tugmasini bosib konkurs haqida bilib oling

 

 ♻️ Va konkursda qatnashing va G'olib bo'ling🏆

[📣 Bizning Kanal bilan qoling ♻️](t.me/$kanal1)",

'parse_mode'=>"markdown",

'inline_query_id'=>$qid, 

        'reply_markup'=>json_encode([ 

        'inline_keyboard'=>[ 

       [['text'=>"🎉 Konkursda qatnashish 🏆", "url"=>"https://telegram.me/not_competitionbot"]],  //nuqtalar orniga bot username @yozmasdan

       ] 

       ]) 

       ]);

sleep(1);

file_put_contents("data/$cid/iCoderNet.txt","");

bot('Sendmessage',[

'chat_id'=>$cid,

'text'=>"*👌Endi siz Konkurs ishtirokchisi bo'ldingiz \n @$kanal1 ga kirib ko'rishingiz mumkin \nPrasmostr yig'ishni boshlang Sizga omad *",

'parse_mode'=>"markdown",

'reply_markup'=>$key,

    ]);  

  }

}

if($tx=="👁️Prasmostr"){ 

$mykon=file_get_contents("qat/qatnashdi.dat"); 

if(mb_stripos($mykon,"$cid")!==false){ 

      bot('sendmessage',[ 

        'chat_id'=>$cid,

        'text'=>"Kechirasiz siz konkursda qatnashib bo'lgansiz!", 

        'reply_markup'=>$key,

    ]); 

}else{ 

     bot('sendmessage',[ 

        'chat_id'=>$cid, 

        'text'=>"Siz Prasmostr konkursda qatnashish uchun

 Ismingizni yozishingiz shart emas. 

Biz sizning nickingizni avtomatik tarzda 

Olamiz va Konkursga qo'shamiz 

Siz @$kanal1 kanaliga kirib 

O'z nikingizni topib Gruxlarga jo'natib 

Prasmostr yig'ib G'olib bo'lishingiz mumkin 

        

Siz Prasmostr konkursda qatnashmoqchi bo'lsangiz ✔️Roziman tugmasini bosing", 

        'reply_markup'=>$pras,

    ]);  

  }

}

?>
