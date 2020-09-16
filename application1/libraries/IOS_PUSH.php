<?php 

class IOS_PUSH{    
    // private static $API_SERVER_KEY = 'AIzaSyCRMgnPdSca0HE5fG1TEzHCufAmv4NjaJo';
    // private static $API_SERVER_KEY = 'AAAAtCnMKe8:APA91bF3k7KZ4xnNTiMa6BFLuiHs7njzesOXqf3Aj4AWryAtZwhuHfGWWdU2s7nisV-l9opYwbwsu0i8iVPHHFBPWtRmFx9vDDseSSkUfHMVMAQxcVjxkOpbobXMnfwScokkVm7Lk_gi';
    private static $API_SERVER_KEY = 'AAAAwJ5N35c:APA91bEQghI6EzH_yfQ5WMpvFNLcKrUMJDqUvZ9hAJ8jRHBeDF_WuJLbVXyq_N4gsMqu3cz5PKmbDqfftLaSi1WmgfvvZlclYtuvkCbgK1_SzU_jyqwArPE7BNY8-sZDeYRu8-IKk3-a';
    private static $is_background = "TRUE";
    public function __construct() {     
     
    }
    public function sendPushNotificationToFCMSever($token, $message, $notifyID) {

    	
        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
 
        $fields = array(
            'to' => $token,
            'priority' => 5,
            'content-available' => true,
            'alert' => 'Dictionary',
            'badge' => 0,
            'sound' => 'default',
            'data' => array('title' => 'AquaDeals IOS', 'body' =>  $message ,'sound'=>'Default','image'=>'Notification Image' ),
        );

        $headers = array(
            'Authorization:key=' . self::$API_SERVER_KEY,
            'Content-Type:application/json'
        );  
         
        // Open connection  
        $ch = curl_init(); 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));


        
        // Execute post   
        $result = curl_exec($ch); 
        // Close connection      
        curl_close($ch);
        return $result;
    }
 }

?>