//Master Page 
import {Component,  OnDestroy, OnInit, ViewChild} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {Subscription} from 'rxjs';
import {LocalStorageService} from '../local-storage.service';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service';
@Component({
  selector: 'app-area-body',
  templateUrl: './area-body.component.html',
  styleUrls: ['./area-body.component.sass']
})
export class MasterComponent implements OnInit,OnDestroy {
  @ViewChild('drawer') public sidenav;
  content;//holding fetched list from API
  actionFromUrl;
  subscription:Subscription  = new Subscription;
  imgobjc;
  slideShowHeight = '300px';
  constructor(
    private router: Router,
    private localStorageService: LocalStorageService,
    public globals:globals,
    private route: ActivatedRoute,
    private Services:ServicesService
  ) {}
  drawerToggleToHome() {
    this.sidenav.toggle();
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  ngOnInit(): void {
    this.globals.masterAction = '';
    this.globals.unhyperAction = '';
    this.globals.loginedUser = this.localStorageService.getItem('userIDSession') ? true : false;
    if ( this.globals.devicePc ) this.slideShowHeight = '800px'; 
    this.imgobjc = [
      {url:  this.globals.UrlHome+'/img/sl1.jpg',  href: '/#/home/campaign/1' },
      {url:  this.globals.UrlHome+'/img/sl2.jpg',  href: '/#/home/campaign/2'},
      {url:  this.globals.UrlHome+'/img/sl3.jpg',  href: '/#/home/campaign/3'}];
      
    this.subscription = this.route.params  .subscribe(params => {this.actionFromUrl = params['action'];   });
    if (this.actionFromUrl) {
      if (this.actionFromUrl === 'brands') this.brandList();
    }
  }

  logOut() {
    this.globals.loginedUser = false;
    this.router.navigate(['/']);
    this.localStorageService.setItem('userIDSession','');
    this.localStorageService.setItem('nameSession','');
    this.localStorageService.setItem('emailSession','');
    this.localStorageService.setItem('photoUrlSession','');
  }

  //fetching list of brands and save it in this.content
  brandList() {
    this.globals.loadingHome = true; 
    this.globals.masterAction = 'brandList';
    this.subscription = this.Services.brandList(1)
    .subscribe(data => {
      this.content = data;
      this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
  }
}