import { Component,  OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
})
export class AppComponent implements OnInit {

  constructor(private translateServise:TranslateService){
  }
  ngOnInit(){
    this.translateServise.setDefaultLang('en');
  }
  changeLanguage(){
    let supportedLanguages=['en', 'spanish'];
    let languageIndex;
    this.translateServise.getDefaultLang()===supportedLanguages[0]?languageIndex=1:languageIndex=0;
    this.translateServise.setDefaultLang(supportedLanguages[languageIndex]);
  }

}
