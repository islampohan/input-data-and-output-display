<HTML>
    <!--$$-->
    <HEAD>

    <TITLE>Input a Message</TITLE>
    </HEAD>
    <BODY BGCOLOR="#FFFFFF">
    <!--To:  (your home page, if required)-->
    <p>
    <h2>Input a Message</h2>
    <p>
    <form name="msg" method="post" action="/process.php">
    Please type in your message : 
    
    <p>
    <textarea name=message cols=90 rows=25 wrap=hard>
    </textarea>
    <p>
    <h2>Langkah-langkah</h2>
    <p>
    Untuk mengisi data dengan baik, ada hal-hal yang perlu kita perhatikan sebelum data dikirim adalah :<br>
    <p>
    1. Data dikirim dengan urutan windspeed, winddir, temp, rh, pressure, rain, solrad.<br>
    
    2. Data ditulis dengan dipisahkan koma tanpa spasi.<br>
    
    3. <span style="color:red;"> <b><blink>cth : "1.05,127.00,29.64,64.50,1011.75,0,239"</blink></b>.<br> </span>
    
    4. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.
    <p>
    
    
    <p>
            <input type="submit" name="send" value="Send This Message"> &nbsp;
            <input type="reset"  name="reset" value="Reset">  &nbsp;
            <!--input type="submit" name="save" 
              value="Save this message (but do not send it yet)"--> &nbsp;
    </form>
    <hr>
    </BODY>
    </HTML>
    
    