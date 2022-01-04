import {NgModule } from '@angular/core';
import {BrowserModule } from '@angular/platform-browser';
import {HttpClient, HttpClientModule } from '@angular/common/http';
import {RouterModule } from '@angular/router';
import {AppRoutingModule } from './app-routing.module';
import {AppComponent } from './app.component';
import {BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {ReactiveFormsModule } from '@angular/forms';
import {MdbModule } from 'mdb-angular-ui-kit';
import {NgxSliderModule} from '@angular-slider/ngx-slider';



@NgModule({
  declarations: [
    AppComponent,
    ],
  imports: [
    NgxSliderModule,
    ReactiveFormsModule,
    BrowserAnimationsModule,
    RouterModule.forRoot([
      
    ]),
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    RouterModule,
    MdbModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule {}
