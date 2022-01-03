//User Profile Information 
import {Component,  OnDestroy,  OnInit, ViewChild} from '@angular/core';
import {AngularEditorConfig} from '@kolkov/angular-editor';
import {FormBuilder} from '@angular/forms'
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
import {globals} from '../global-variables';
@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.sass']
})
export class ProfileComponent implements OnInit,OnDestroy {
  subscription:Subscription  = new Subscription;
  dataBackFromSubmitContent;
  checkoutForm = this.formBuilder.group({
    Name:'',
    Family:'',
    Mobile: '',
    Password: '',
    comment: ''
  });
  @ViewChild('countr') countr: any;
  content;//holding fetched list from API
  editorConfig: AngularEditorConfig = {//options for angular-editor
      editable: true,
      spellcheck: true,
      height: '200px',
      minHeight: '0',
      maxHeight: 'auto',
      width: 'auto',
      minWidth: '0',
      translate: 'yes',
      enableToolbar: true,
      showToolbar: true,
      placeholder: 'Enter text here...',
      defaultParagraphSeparator: '',
      defaultFontName: '',
      defaultFontSize: '',
      fonts: [
        {class: 'arial', name: 'Arial'},
        {class: 'times-new-roman', name: 'Times New Roman'},
        {class: 'calibri', name: 'Calibri'},
        {class: 'comic-sans-ms', name: 'Comic Sans MS'}
      ],
      customClasses: [
      {
        name: 'quote',
        class: 'quote',
      },{
        name: 'redText',
        class: 'redText'
      },{
        name: 'titleText',
        class: 'titleText',
        tag: 'h1',
      },
      ],
    uploadUrl: 'v1/image',
    uploadWithCredentials: false,
    sanitize: true,
    toolbarPosition: 'top',
    toolbarHiddenButtons: [
      ['bold', 'italic'],
      ['fontSize']
    ]
  };
  constructor (
    private formBuilder: FormBuilder,
    private Services:ServicesService,
    public globals:globals) {}
  ngOnInit(): void {
    this.userInfo (this.globals.loginedUserID);
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }  
  //get user information from api
  userInfo(user_id) {
    this.subscription = this.Services.getUserInfo (user_id)
    .subscribe(data => {
      this.content = data;
      this.countr.close();
    });
  }
  //update user information in database
  editProfile() {
    this.globals.loadingHome = true;
    this.subscription = this.Services.editProfile (
      this.checkoutForm['value']['Name'],
      this.checkoutForm['value']['Family'],
      this.checkoutForm['value']['Mobile'],
      this.checkoutForm['value']['Password'],
      this.checkoutForm['value']['comment'] 
    ).subscribe(data => {
       this.dataBackFromSubmitContent = data;
       this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
  }
}