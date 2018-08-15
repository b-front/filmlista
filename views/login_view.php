<?php
abstract class login_view{
    static function get_form(){
        if ($_SESSION["is_logged_in"]==1){
            ch::redirect();
        }
        $x="";
        if(ch::get_action()=="registration"){
            $x.=" <form id='registration' action='/register_user' method='post'>";
            $x.="Anv&auml;ndarnamn:</br>";
            $x.="   <input name='username' type='text'/></br></br>";
            $x.="L&ouml;senord:</br>";
            $x.="   <input name='password' type='password'/></br></br>";
            $x.="Mailadress:</br>";
            $x.="   <input name='mail' type='text'/></br></br>";
            $x.="Visningsnamn (om annat &auml;n anv&auml;ndarnamn, kan &auml;ndras senare):</br>";
            $x.="   <input name='nickname' type='text'/></br></br>";
            $x.="   <input value='Registrera' type='submit'/>";
            $x.="</form>";
        }
        else{
            $x.=" <form id='login' action='/login_user' method='post'>";
            $x.="Anv&auml;ndarnamn:</br>";
            $x.="   <input name='username' type='text'/></br></br>";
            $x.="L&ouml;senord:</br>";
            $x.="   <input name='password' type='password'/></br></br>";
            $x.="   <input value='Logga in' type='submit'/>";
            $x.="</form>";
            
            $x.="<a href='/registration'>Skapa konto</a>";
            
        }
        return $x;
        
    }
}


