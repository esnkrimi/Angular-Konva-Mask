import {NgModule } from '@angular/core';
import {BrowserModule } from '@angular/platform-browser';
import {TranslateModule,TranslateLoader} from '@ngx-translate/core'
import {TranslateHttpLoader} from '@ngx-translate/http-loader'
import {HttpClient, HttpClientModule } from '@angular/common/http';
import {RouterModule } from '@angular/router';
import {AppRoutingModule } from './app-routing.module';
import {AppComponent } from './app.component';
import {FormsModule } from '@angular/forms';
import {SlideshowModule} from 'ng-simple-slideshow';
import {ReactiveFormsModule } from '@angular/forms';



@NgModule({
  declarations: [AppComponent],
  imports: [
    ReactiveFormsModule,
    SlideshowModule,
    FormsModule,
    RouterModule.forRoot([
    ]),
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    RouterModule,
    TranslateModule.forRoot(
      {
        loader:{
          provide:TranslateLoader,
          useFactory:(http:HttpClient)=>{
            return new TranslateHttpLoader(http, './assets/trn/','.json')
          },
          deps:[HttpClient]
        }
      
      }

    )
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule {}
