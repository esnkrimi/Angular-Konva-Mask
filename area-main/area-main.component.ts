//Main Page include other panels (filters-footer-header-pool)
import {Component, OnInit, ViewChild} from '@angular/core';
import {ActivatedRoute} from '@angular/router'; 
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
import {globals} from '../global-variables';
import {LocalStorageService} from '../local-storage.service';
@Component({
  selector: 'app-area-main',
  templateUrl: './area-main.component.html',
  styleUrls: ['./area-main.component.sass'],

})
export class HomeComponent implements OnInit {
  @ViewChild('drawer') public sidenav;
  subscription:Subscription  = new Subscription;
  id:any;
  city;
  productID;//holding current product ID
  searchChangedValue; 
  brandChangedValue; 
  colorChangedValue;  
  sizeChangedValue; 
  madeinChangedValue;
  scentChangedValue; 
  priceChangedValue; 
  patternChangedValue; 
  scentExactChangedValue;     
  scentNatureChangedValue;   
  perfumerChangedValue;   
  sexChangedValue; 
  scentGroupChangedValue; 
  campaignChangedValue; 
  languageChanged;
  constructor(
        private localStorageService: LocalStorageService,
        private route: ActivatedRoute,
        public globals:globals,
        private Services:ServicesService) {}
  clearFilters() {
    this.Services.clearFilters();
  }
  filterChanged (variableName, event) {//user change product by clicking on filter panels(sex,size,scent,.....)
    if (variableName === 'search') this.clearFilters();
    this[variableName+'ChangedValue'] = event;
    this.globals[variableName+'Filtered'] = event;
  }
  ngOnInit() {
    let action;
    this.globals.isOpen = !this.globals.isOpen;
    this.globals.unhyperAction2 = '';  
    this.subscription = this.route.params.subscribe (params => {
      params['productID'] ? this.globals.unhyperAction2 = 'zoom' : this.globals.unhyperAction2 = this.globals.unhyperAction2;     
      action = params['action']; 
    });     
    switch(action) {
      case 'orders':this.globals.masterAction = 'orders';   break;  
      case 'profile':this.globals.masterAction = 'profile'; break;  
      case 'signin': this.userMustLoginFisrt(); break;  
      case 'language':
        this.subscription = this.route.params  .subscribe (params => {
        this.globals.language = params['value'];
        this.localStorageService.setItem ('Language', params['value']);      
        this.languageChanged=params['value'];
      });  
      break;           
      default:
        this.subscription = this.route.params
        .subscribe(params => {
          let val=params['value'];
          this.filterChanged(action, val)    
      });
  }
  this.globals.unhyperAction = action; 
  this.globals.loginedUser = !this.localStorageService.getItem('userIDSession') ? false : true;          
  this.globals.loginedUserID = this.localStorageService.getItem('userIDSession');
  this.globals.loginedUserName = this.localStorageService.getItem('nameSession');
  this.globals.loginedUserEmail = this.localStorageService.getItem('emailSession');
  this.globals.loginedUserPhotoUrl = this.localStorageService.getItem('photoUrlSession');
  this.subscription = this.route.params.subscribe(params => {
    this.city = params['city']; this.globals.typeFiltered = this.city;   
  });
  }
  //show login/signup panel for user 
  userMustLoginFisrt() {
    this.globals.unhyperAction = 'mustLogin';
  }
  //toggle User Menu if he is logged in
  drawerToggleToHome() {
    this.sidenav.toggle();
  }
}