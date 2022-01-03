//Carosel Horizontal
import {Component,  OnDestroy,  OnInit} from '@angular/core';
import {Input} from '@angular/core';
import {globals} from '../global-variables';
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
@Component({
  selector: 'app-product-carosel',
  templateUrl: './product-carosel.component.html',
  styleUrls: ['./product-carosel.component.sass']
})
export class ProductCaroselComponent implements OnInit, OnDestroy {
  @Input() title: any;
  @Input() sort: any;
  autoplay = true;//for carousel
  cellsToScroll = 1;//for carousel
  cellsToShow = 1;//for carousel
  width = 0;//for carousel
  height = 0; //for carousel
  imgobj = ['']; //for carousel
  countSlides = 10;//number of carousel items
  counter = [1,2,3,4,5,6,7,8,9,10];//loop counter
  content;//holding fetched list from API
  timestamp;
  subscription:Subscription  = new Subscription;
  constructor(public globals:globals,private Services:ServicesService) {}
  ngOnInit(): void {
    this.width = window.innerWidth;
    this.cellsToScroll = ((this.title === 'BRANDS') && (this.globals.devicePc)) ? 5 : 1;
    if (this.globals.devicePc) {
      if (this.title!== 'BRANDS') {
        this.width = window.innerWidth*0.85;
      }
      this.height = this.width*0.45;
      this.cellsToShow = 5;
    } else {
      this.width = window.innerWidth*.95;
      this.height = this.width*2.1;
      if (this.title === 'BRANDS') {
        this.height = this.width*.8;
        this.cellsToShow = 2;
      }
      }
    this.title === 'BRANDS' ? this.brandList() : this.caroselPageOne();
  }

  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }

  brandList() {
    this.subscription = this.Services.brandList (2).
    subscribe(data => {
      this.content = data;
      this.timestamp = new Date().getSeconds();
      for (let i = 0; i < this.countSlides; i++)
        this.imgobj[i] = this.globals.UrlHome+'/img/brands/'+this.content[i].brand+'.jpg?t = '+this.timestamp;
      this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
 }
  caroselPageOne() {
    this.subscription = this.Services.caroselPageOne (this.sort)
    .subscribe(data => {
      this.content = data;
      if (data) {
        this.content = this.Services.cusomizeList (this.content.length, data)
      }
      this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
 }
} 