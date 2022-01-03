//Vertical Toggle User Menu 
import {Component} from '@angular/core';
import {globals} from 'src/app/global-variables';
import {LocalStorageService} from '../local-storage.service';
import {Router} from '@angular/router'; 
@Component({
  selector: 'app-user-menu',
  templateUrl: './user-menu.component.html',
  styleUrls: ['./user-menu.component.sass']
})
export class UsermenuComponent  {
  constructor(
    private router: Router,
    private localStorageService: LocalStorageService,
    public globals:globals) {}
  logOut() {
    this.globals.loginedUser = false;
    this.router.navigate(['/']);
    this.localStorageService.setItem('userIDSession','');
    this.localStorageService.setItem('nameSession','');
    this.localStorageService.setItem('emailSession','');
    this.localStorageService.setItem('photoUrlSession',''); 
  }
}