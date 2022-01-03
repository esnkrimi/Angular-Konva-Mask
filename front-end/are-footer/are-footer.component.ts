//Footer Panel 
import {Component,  Input,  OnDestroy,  OnInit} from '@angular/core';
import {globals} from '../global-variables';
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
import {OnChanges} from '@angular/core';
@Component({
  selector: 'app-are-footer',
  templateUrl: './are-footer.component.html',
  styleUrls: ['./are-footer.component.sass']
})
export class FooterComponent implements OnInit,OnDestroy,OnChanges {
  contentNews; //hold new products list
  contentTop;  //hold top products list
  contentOffer;//hold offer products list
  @Input() languageChanged;
  subscription:Subscription  = new Subscription;
  constructor(
    public globals:globals, 
    private Services:ServicesService) {
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe()
  }
  ngOnChanges(): void {
    this.fetchProductList('do_id desc','new');//fetching new product and save it to contentNews
    this.fetchProductList('do_look desc','top');//fetching new product and save it to contentTop
    this.fetchProductList('do_certificate desc','offer');//fetching new product and save it to contentOffer
  }
  ngOnInit(): void {}  
  //fetching product list and save it 
  fetchProductList (sort, which) {
    this.subscription = this.Services.fetchProductList (sort, 4)
    .subscribe(data => {
      which === 'new' 
        ? this.contentNews = this.Services.cusomizeList (5, data) 
        : (which === 'top' 
          ? this.contentTop = this.Services.cusomizeList (5, data) 
          : this.contentOffer = this.Services.cusomizeList (5, data) 
      );
      this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
  }
}