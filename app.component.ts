import {Component,  OnDestroy, OnInit} from '@angular/core';
import {enableProdMode} from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import {globals} from './global-variables';
import {Subscription} from 'rxjs';
import {LocalStorageService} from './local-storage.service';
enableProdMode();
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
})
export class AppComponent implements OnInit, OnDestroy {
  subscription:Subscription  = new Subscription;
  constructor(
    private localStorageService: LocalStorageService,
    private translateservise:TranslateService,
    public globals:globals) {}
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  ngOnInit() {
    let lang;
    let deviceWidth;
    deviceWidth = window.innerWidth;
    this.globals.devicePc = deviceWidth<1025 ? false : true;
    lang = this.globals.language;
    lang ? this.changingLanguage (lang) : (this.localStorageService.getItem ('Language') ? this.changingLanguage (lang) : this.changingLanguage ('en'));
    this.changingLanguage(this.globals.language);
  }
  //changing language whole on website  
  changingLanguage (LanguageSelected:string) {
    this.globals.language = LanguageSelected;
    this.localStorageService.setItem ('Language', LanguageSelected);
    let supportLanguages = ['en','ar','fa'];
    this.translateservise.addLangs (supportLanguages);
    this.translateservise.setDefaultLang (LanguageSelected);
    this.globals.language = LanguageSelected;
    this.localStorageService.setItem ('Language', LanguageSelected);
  }
} 