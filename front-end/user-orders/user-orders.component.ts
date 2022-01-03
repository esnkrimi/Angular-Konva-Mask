//Orders that paid by user successfully , can be checked here 
import {Component,  OnDestroy, OnInit} from '@angular/core';
import {globals} from '../global-variables';
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
import {FormBuilder} from '@angular/forms';
@Component({
  selector: 'app-user-orders',
  templateUrl: './user-orders.component.html',
  styleUrls: ['./user-orders.component.sass'],
})
export class OrdersComponent implements OnInit,OnDestroy {
  existPrd:any[] = [];
  strs:any = ''; 
  checkoutForm = this.formBuilder.group({comment: ''}); 
  sum; //sum price of basketlist
  discount;//discount of user basket
  final;//finalprice of basket in dollars
  p: number = 1;//page number ngfor pagination 
  content;//holding fetched list from API
  subscription:Subscription  = new Subscription;
  constructor (
    private formBuilder: FormBuilder,
    public globals:globals,
    private Services:ServicesService) {}
  ngOnInit(): void {
    this.globals.loadingHome = true;
    this.userPaymentList();
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  //delete a product from basket list
  deleteFromBasket (row) {
    row.basket_size = 0;
    this.sum-=  (row.do_price*row.basket_count);
    this.final-=  (row.price_after*row.basket_count);
    this.discount = this.sum-this.final;
    this.subscription = this.Services.deleteFromBasket (row.basket_id)
    .subscribe(data => {
      this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    }
    );
  }
  //user list to Payment
  userPaymentList(): void {
    let i = 0;let j = 0;let k = 0;let m = 0;
    this.subscription = this.Services.userPaymentList()
    .subscribe(data => {
      this.content = data;
      for (m = 0; m < this.content.length; m++) {
        j = 0;
        k = 0;
        for (i = 0; i < this.content[m]['prd'].length; i++) {
          this.strs = '';
          while((this.content[m]['prd'][k]!== '-') && (k<this.content[m]['prd'].length)) {
            this.strs = this.strs+this.content[m]['prd'][k];
            k++;           
          }
          k++;
          if (this.strs.length) {
            this.existPrd.push([m,this.strs]);
          }
          j++;
        }
      }
      this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
  }
}