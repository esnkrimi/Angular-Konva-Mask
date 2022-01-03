//also discovered page (in product-page app)
import {Component,  OnDestroy} from '@angular/core';
import {Input} from '@angular/core';
import {globals} from '../global-variables';
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
import {OnChanges} from '@angular/core';
@Component({
  selector: 'app-product-also-discovered',
  templateUrl: './product-also-discovered.component.html',
  styleUrls: ['./product-also-discovered.component.sass']
})
export class ProductAlsoDiscoveredComponent implements OnDestroy,OnChanges {
  @Input() how: any;//type of similarity between current product and also discovered products
  @Input() doid: any;//current product ID
  content;//holding fetched list from API
  subscription:Subscription  = new Subscription;
  cellsToShow = 1;//for carousel
  width = 250;//for carousel
  height = 250;//for carousel
  constructor(public globals:globals, private Services:ServicesService) {}
  ngOnChanges(): void {
    if (this.globals.devicePc) {
      this.width = window.innerWidth*.7;
      this.height = this.width*0.4;
      this.cellsToShow = 4;
    } else {
      this.width = window.innerWidth*.95;
      this.height = this.width*1.1;
      this.cellsToShow = 2;
    }
   this.alsoDiscoveredProducts(); 
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  alsoDiscoveredProducts() {
    this.subscription = this.Services.alsoDiscoveredProducts(this.how,this.doid)
    .subscribe(data => {
        this.content = data;
        if (data) {
          this.content = this.Services.cusomizeList(this.content.length,data)
        }
        this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
 }
} 