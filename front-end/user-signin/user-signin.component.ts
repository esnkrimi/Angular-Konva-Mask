//Sign In Panel 
import {Component,  OnDestroy} from '@angular/core';
import {FormBuilder} from '@angular/forms';
import {Router} from '@angular/router';
import {Subscription} from 'rxjs';
import {LocalStorageService} from '../local-storage.service';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service'; 
@Component({
  selector: 'app-user-signin',
  templateUrl: './user-signin.component.html',
  styleUrls: ['./user-signin.component.sass']
})
export class SigninComponent implements OnDestroy{
  checkoutForm = this.formBuilder.group({
    email: '',
    pass: ''
 });
  content;//holding fetched list from API
  subscription:Subscription  = new Subscription;
  errorLogin = false;
  allowLogin = 0;
  constructor (
    private router: Router,
    private formBuilder: FormBuilder,
    private localStorageService: LocalStorageService,
    private Services:ServicesService,
    public globals:globals) {
    }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  } 
  //login user
  userLogin() {
    this.allowLogin = 2;
    if ((!this.checkoutForm['value']['email']) || (!this.checkoutForm['value']['pass'])) {
      this.allowLogin = 1;
      this.errorLogin = false; 
    } else {
      this.allowLogin = 2;
      this.errorLogin = false; 
      this.globals.loadingHome = true;
      this.content = [];
      this.subscription = this.Services.userLogin (this.checkoutForm['value']['email'], this.checkoutForm['value']['pass'])
      .subscribe(data => {
        this.content = data;
        this.globals.loginedUserID = this.content[0].user_id;
        this.localStorageService.setItem ('userIDSession', this.content[0].user_id);
        this.localStorageService.setItem ('nameSession', this.content[0].user_name);
        this.globals.loginedUser = true;       
        this.globals.loadingHome = false;
        this.globals.masterAction = '';
        this.router.navigate(['/home']);
      },err => {
        this.errorLogin = true; 
        this.globals.loadingHome = false;
      });
   }
 }
}