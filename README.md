# angular-internationalization 
angular internationalization example - i18n
<b>internationalization by angular i18n </b><br>
first of all install requirements:<br>

     npm install @ngx-translate/core  save
     npm install @ngx-translate/http-loader  save
     npm install @biesbjerg/ngx-translate-extract  --save-dev
     
next import modules in app.module

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
    
finally you should define translator files in assets/trn

for example - english.json

    { 
        "home":{ 
            "Id":"0",
            "language":"English",
            "HelloWorld":"Hello world",
            "isSelected":"is selected" 
        }
    }    
    
you can run npm run extract for initilization files    



