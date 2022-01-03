//Products Thumbnail Used In Pool app or Carosel App
import {Component, Input, OnDestroy, OnInit} from '@angular/core';
import {Subscription} from 'rxjs';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service';
@Component({
  selector: 'app-product-thumbnail',
  templateUrl: './product-thumbnail.component.html',
  styleUrls: ['./product-thumbnail.component.sass']
})
export class ProductThumbnailComponent implements OnInit,OnDestroy {
  @Input() product;//hold all information about current product
  @Input() showType;//show double column | single?
  @Input() target;
  @Input() chips;//discount and scentGroup chips 
  hover = false;//discount and scentGroup chips showing on hover 
  customizedMoney = ['price','final_price']; 
  subscription:Subscription  = new Subscription;
  constructor (public globals:globals, private Services:ServicesService) {}
  ngOnInit(): void {
    this.customizedMoney = this.Services.cusomizeMoneyPostfix (this.product)
  } 
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  //add an item into users wishlist  
  addToWishList(product_ID) {
    if (this.product.wishlist_exists === 1) {
      this.globals.WishlistCount = this.globals.WishlistCount-1 ; 
      this.globals.wishlistUpdateList = true;
    } else {
      this.globals.WishlistCount = this.globals.WishlistCount+1;
    }
    this.product.wishlist_exists = this.product.wishlist_exists === 1 ? 0 : 1;
    this.subscription = this.Services.addToWishList (product_ID).subscribe();
  }
}