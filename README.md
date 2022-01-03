# angular-internationalization 
angular internationalization example - i18n
<b>internationalization by angular i18n </b><br>
<b>first of all install requirements:</b><br>

     npm install @ngx-translate/core  save
     npm install @ngx-translate/http-loader  save
     npm install @biesbjerg/ngx-translate-extract  --save-dev
     
<b>next import modules in app.module</b>

    import {TranslateLoader, TranslateModule} from '@ngx-translate/core';
    import {TranslateHttpLoader} from '@ngx-translate/http-loader';
    import {HttpClient, HttpClientModule} from '@angular/common/http';
    ...
    @NgModule({
    ...
    imports: [
    ...
    TranslateModule.forRoot({
      loader:{
        provide:TranslateLoader,
        useFactory:(http:HttpClient)=>{
        return new TranslateHttpLoader(http, './assets/trnslateFolder/','.json')
      },
      deps:[HttpClient]
      }
    }    
    
<b>finally you should define translator files in assets/trnslateFolder </b>

for example - english.json

    { 
        "home":{ 
            "Id":"0",
            "language":"English",
            "HelloWorld":"Hello world",
            "isSelected":"is selected" 
        }
    }    
and for spanish :

     { 
         "home":{ 
             "Id":"1",
             "language":"Spanish",
             "HelloWorld":"Hola Mundo",
             "isSelected":"está seleccionado" 
         }
     }   
    
<b>you can run npm run extract for initilization files    </b>



