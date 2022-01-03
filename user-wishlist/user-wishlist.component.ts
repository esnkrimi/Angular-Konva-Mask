//WishList panel,user can save someproducts here to check in future 
import {Component,  OnDestroy, OnInit} from '@angular/core';
import {globals} from '../global-variables';
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
import {FormBuilder} from '@angular/forms';
@Component({
  selector: 'app-user-wishlist',
  templateUrl: './user-wishlist.component.html',
  styleUrls: ['./user-wishlist.component.sass'],
})
export class WishlistComponent implements  OnInit,OnDestroy {
  checkoutForm = this.formBuilder.group({comment: ''});
  multiColumn = true;//toggle double column to single column
  array2Dimensional;//convert data 1D array into 2D array for show Double Column in ngFor
  p: number = 1;//page number ngfor pagination 
  content;//holding fetched list from API
  subscription:Subscription  = new Subscription;
  constructor (
    private formBuilder: FormBuilder,
    public globals:globals,
    private Services:ServicesService) {}
  ngOnInit(): void {
    this.globals.loadingHome = true;
    this.userWishLists();
  }
  ngOnDestroy(): void {
      this.subscription.unsubscribe();
  }
  //convert data 1D array into 2D array for show Double Column in ngFor
  dataToDoubleColumn() {
    this.array2Dimensional = [];
    this.array2Dimensional = this.content.reduce ((acc, col, i) => {
    if (i%2 === 0) {
      acc.push({column1: col});
    } else {
      acc[acc.length - 1].column2 = col;
    }       
    return acc;
    }, []);
  }
  //get user wishlist array from api
  userWishLists() {
    this.content = [];
    this.globals.wishlistUpdateList = false;
    this.subscription = this.Services.wishLists()
    .subscribe(data => {
      this.content = [];
      this.content = data;
      this.dataToDoubleColumn();
      this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
  } 
}