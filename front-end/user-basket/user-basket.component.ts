//User Basket , These orders will be paid in future by user
import {Component,OnDestroy, OnInit} from '@angular/core';
import {globals} from '../global-variables';
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
import {FormBuilder} from '@angular/forms';
@Component({
  selector: 'app-user-basket',
  templateUrl: './user-basket.component.html',
  styleUrls: ['./user-basket.component.sass']
})
export class ShopcardComponent implements  OnInit,OnDestroy {
  checkoutForm = this.formBuilder.group({comment: ''});
  lang;//retrieving language of site
  sum; //sum price of basketlist
  discount;//discount of user basket
  final;//finalprice of basket in dollars
  final_rial;//finalprice of basket in rial
  p: number = 1;//page number ngfor pagination 
  dogePrice = 0;//convert sum price of basket into dogeCoin
  dogeRate = 0;//live rate of usd/dogeCoin
  content;//holding fetched list from API
  subscription:Subscription  = new Subscription;
  constructor(
    private formBuilder: FormBuilder,
    public globals:globals,
    private Services:ServicesService) {}
  ngOnInit(): void {
  this.globals.loadingHome = true;
  this.userBasketlist();
  }
  ngOnDestroy(): void {
      this.subscription.unsubscribe();
  } 
  deleteFromBasket (row) {
    row.basket_size = 0;
    this.globals.BasketCount=parseInt(this.globals.BasketCount.toString())-parseInt(row.basket_count.toString());
    this.sum-=  (row.do_price*row.basket_count);
    this.final-=  (row.price_after*row.basket_count);
    this.dogePrice = this.lang === 'ar' 
    ? ((this.final/3.67)*this.dogeRate) 
    : ((this.final)*this.dogeRate);
    this.discount = this.sum-this.final;
    this.subscription = this.Services.deleteFromBasket(row.basket_id).subscribe();
  }
  paymentInDoecoinPrice() {
    this.subscription = this.Services.paymentInDoecoinPrice()
    .subscribe(data => {
        this.dogeRate = data['USD'];
        this.dogePrice = this.lang === 'ar' 
        ? ((this.final/3.67)*this.dogeRate) 
        : ((this.final)*this.dogeRate);
    });
  }
  userBasketlist() {
    this.content = [];
    this.subscription = this.Services.userBasketlist()
    .subscribe(data => {
      this.content = data;
      this.final_rial = 0;
      this.final = 0;
      this.sum = 0;
      for (let i = 0; i < this.content.length; i++) {
        this.final_rial+= this.content[i].price_after*this.content[i].basket_count;
        this.content = this.Services.cusomizeList(20,data);
        this.sum+= this.content[i].do_price*this.content[i].basket_count;
        this.final+= this.content[i].price_after*this.content[i].basket_count;
      }
      this.paymentInDoecoinPrice();
      this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
  }
}