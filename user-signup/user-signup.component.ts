//Sign Up Panel 
import {Component, OnDestroy, OnInit} from '@angular/core';
import {SocialAuthService, GoogleLoginProvider, SocialUser} from 'angularx-social-login';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {ServicesService} from '../services.service';
import {Subscription} from 'rxjs';
import {globals} from '../global-variables';
import {LocalStorageService} from '../local-storage.service';
import { Router} from '@angular/router';
@Component({
  selector: 'app-user-signup',
  templateUrl: './user-signup.component.html',
  styleUrls: ['./user-signup.component.sass'] 
})
export class SignupComponent implements OnInit ,OnDestroy{
  checkoutForm = this.formBuilder.group({email: '',mobile: ''});
  signupDid = false;
  allowRegister = 0;
  reactiveForm: FormGroup | undefined;
  user: SocialUser | undefined;
  isSignedin: boolean | undefined;  
  subscription:Subscription  = new Subscription;
  content;//holding fetched list from API
  public firstname: string = '';
  public email: string = '';
  public photoUrl: string = '';
  constructor (
    private router: Router,
    private formBuilder: FormBuilder,
    private localStorageService: LocalStorageService,
    private Services:ServicesService,
    private fb: FormBuilder, 
    private socialAuthService: SocialAuthService,
    public globals:globals) {}
  showSignupWithEmail = true;
  ngOnInit(): void {
    this.reactiveForm = this.fb.group({
      email: ['', Validators.required],
      password: ['', Validators.required]
    });  
    this.socialAuthService.authState  .subscribe((user) => {
      this.user = user;
      this.isSignedin = (user !==  null);
      this.subscription = this.Services.userSignup(
        '',
        this.user.email,
        this.user.name
        ).subscribe(data => {
            this.allowRegister = 0;
            this.signupDid = true;
            this.content = data;
            this.localStorageService.setItem('userIDSession',this.content[0].user_id);
            this.localStorageService.setItem('nameSession',this.content[0].user_name);
            this.localStorageService.setItem('emailSession',this.content[0].user_mail);
            this.localStorageService.setItem('photoUrlSession',this.content[0].user_mail);
            this.globals.loginedUser = true;          
            this.globals.loadingHome = false;
            this.router.navigate(['/home']); 
          },err => {
            this.globals.loadingHome = false;
          });
    });      
  }

  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  } 
  //logout
  logout(): void {
    this.socialAuthService.signOut();
  }
  //sign up via user name and password(not google social login) 
  signupViaInputTexts() {
    this.allowRegister = 0; 
    if ((this.checkoutForm['value']['email'].length<5) || (this.checkoutForm['value']['mobile'].length<10)) {
      this.allowRegister = 1;
    } else {
      this.subscription = this.Services.userSignup(this.checkoutForm['value']['mobile'],this.checkoutForm['value']['email'],'')
      .subscribe(data => {
        this.allowRegister = 0;
        this.signupDid = true;
        this.content = data;
        this.localStorageService.setItem('userIDSession',this.content[0].user_id);
        this.localStorageService.setItem('nameSession',this.content[0].user_name);
        this.localStorageService.setItem('emailSession',this.content[0].user_email);
        this.localStorageService.setItem('photoUrlSession',this.content[0].user_email);
        this.globals.loginedUser = true;          
        this.globals.loadingHome = false;
        this.router.navigate(['/home']); 
      },err => {
        this.globals.loadingHome = false;
      });
    }
  }
  //sign up via google social login
  googleSignin(): void {
    this.globals.loadingHome = true;
    this.socialAuthService.signIn(GoogleLoginProvider.PROVIDER_ID);
  }
}
