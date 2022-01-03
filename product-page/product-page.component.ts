//Product Full Information Page
import {Component,OnInit} from '@angular/core';
import {globals} from '../global-variables';
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
import {ActivatedRoute} from '@angular/router';
@Component({
  selector: 'app-product-page',
  templateUrl: './product-page.component.html',
  styleUrls: ['./product-page.component.sass']
})
export class ProductPageComponent implements OnInit {
  count = 1;//number of requested product for adding to basket
  timestamp;
  imgobj = ['']; selectImg;
  subscription:Subscription  = new Subscription;
  customizedMoney = ['price','final_price'];
  content;//holding fetched list from API//list of fetched from API
  productID;//holding current product ID//current product ID
  height;width; //for image slide
  constructor(
       private route: ActivatedRoute,
       public globals:globals,
       private Services:ServicesService) {
    this.content = [];
  }
  ngOnInit(): void {
    this.subscription = this.route.params  .subscribe (params => {
      this.productID = params['productID']; 
   });
    this.getFullDetailsOfProduct();
    if ( this.globals.devicePc ) {
      this.width = window.innerWidth*0.4;
      this.height = this.width*1.4;
    } else {
      this.width = window.innerWidth;
      this.height = this.width*1.4;
    }
  } 

  addToBasket() {
    this.globals.loadingHome = true;
    this.globals.message = 'Added Successfully !';//used for modalin page app.component.html
    this.globals.messageLink = ' #/home/shop-card'; //used for modalin page app.component.html   
    this.subscription = this.Services.addToBasket(this.content.do_id,this.content.colorEx,this.count,this.content.sizeEx).
    subscribe (data => {
        this.globals.BasketCount=parseInt(this.globals.BasketCount.toString())+parseInt(this.count.toString());
        this.content.countEx = this.content.countEx-this.count;
        this.globals.loadingHome = false;
     },err => {
      this.globals.loadingHome = false;
    });
   } 
  addToWishList (do_id) {
    if (this.content.wishlist_exists === 1) {
      this.globals.WishlistCount = this.globals.WishlistCount-1 ; 
    } else {
      this.globals.WishlistCount = this.globals.WishlistCount+1;  
    }
    this.content.wishlist_exists = this.content.wishlist_exists === 1 ? 0 : 1;  
    this.subscription = this.Services.addToWishList (do_id)
    .subscribe(data => {
      this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    }        
    );
  }
  
  getFullDetailsOfProduct() {
    this.subscription = this.Services.getFullDetailsOfProduct (this.productID)
    .subscribe(data => {
      window.scroll(0,0);
      this.content = data[0];
      this.customizedMoney = this.Services.cusomizeMoneyPostfix (this.content);  
      this.imgobj[0] = this.globals.UrlHome+'/drm/users/1/'+this.content.do_id+'/2.jpg?t = '+this.timestamp;
      this.imgobj[1] = this.globals.UrlHome+'/drm/users/1/'+this.content.do_id+'/3.jpg?t = '+this.timestamp;
      this.selectImg = this.imgobj[0];
      this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
  }
  clearFilters() {
    this.Services.clearFilters();
   }
}