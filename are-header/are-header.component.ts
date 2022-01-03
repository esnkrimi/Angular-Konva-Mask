//Header  Panel
import {Component, OnInit, Output, EventEmitter, OnDestroy} from '@angular/core';
import {globals} from '../global-variables';
import {LocalStorageService} from '../local-storage.service';
import {ServicesService} from '../services.service';
import {Subscription} from 'rxjs';
import {TranslateService} from '@ngx-translate/core';
@Component({
  selector: 'app-are-header',
  templateUrl: './are-header.component.html',
  styleUrls: ['./are-header.component.sass']
})
export class HeaderComponent implements OnInit,OnDestroy {
  supportLanguages = ['en','irr','es','pr','fa'];
  @Output() searchWord = new EventEmitter<String>();
  @Output() drawerToggleToHome = new EventEmitter<boolean>();
  subscription:Subscription  = new Subscription;
  content;//holding fetched list from API//list of fetched from API
  constructor(
    private translateservise:TranslateService,
    private Services:ServicesService,
    private localStorageService: LocalStorageService,
    public globals:globals
  ) {}
  ngOnInit(): void {
    this.globals.WishlistCount = 0;
    this.globals.BasketCount = 0;
    this.getBasketProductsCounts();
    this.userWishListCount();
    this.localStorageService.getItem('userIDSession');
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  changeLanguage(LanguageSelected:string) {
    this.translateservise.addLangs(this.supportLanguages);
    this.translateservise.setDefaultLang(LanguageSelected);
  }
  searchWordFunction($event) {
    this.globals.searchFiltered = $event;
    this.searchWord.emit($event); 
  }
  //return number of items in wislist
  userWishListCount() { 
    this.subscription = this.Services.userWishListCount()
    .subscribe(data => {
      this.content = data;  
      this.globals.WishlistCount = this.content[0].count;
    });
  }
  //return number of items in user basket
  getBasketProductsCounts() { 
    this.subscription = this.Services.getBasketProductsCounts()
    .subscribe(data => {
      this.content = data;  
      this.globals.BasketCount = this.content[0].count;
    });
  }
  //Toggle User Menu open/close    
  drawerToggle() {
    this.globals.drawerToggle = !this.globals.drawerToggle;
    this.drawerToggleToHome.emit(this.globals.drawerToggle); 
  }
}