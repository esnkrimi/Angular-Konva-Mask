//User Comments-Under Product Page app,users can insert their own comments about each product 
import {Component, Input, OnChanges, OnDestroy} from '@angular/core';
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
import {globals} from '../global-variables';
import {FormBuilder} from '@angular/forms';

@Component({
  selector: 'app-user-comments',
  templateUrl: './user-comments.component.html',
  styleUrls: ['./user-comments.component.sass']
})
export class CommentComponent implements OnDestroy,OnChanges{
  @Input() doID;//holdeing current product ID
  checkoutForm = this.formBuilder.group({comment: ''});
  subscription:Subscription  = new Subscription;
  content;//holding fetchedlist from API 
  constructor (
    private formBuilder: FormBuilder,
    private Services:ServicesService,
    public globals:globals) {}
  ngOnChanges() {
    this.allComments(this.doID);
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  //insert comment for each product by users
  insertComment() {
    this.subscription = this.Services.insertComment(this.doID, this.checkoutForm['value']['comment'])
    .subscribe(data => {
      this.globals.loadingHome = false;
      this.allComments(this.doID);
    },err => {
      this.globals.loadingHome = false;
    });
  }
  //fetching all comments
  allComments(do_id) { 
    this.content = [];
    this.subscription = this.Services.allComments(do_id)
    .subscribe(data => {
        this.content = data;
        this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
  }
}