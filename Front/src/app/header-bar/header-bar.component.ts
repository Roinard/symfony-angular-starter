import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-header-bar',
  templateUrl: './header-bar.component.html',
  styleUrls: ['../app.component.scss']
})
export class HeaderBarComponent implements OnInit {

  Username = undefined

  constructor() { }

  ngOnInit(): void {
  }

  login(): void {
    console.log("Display Login Form")
  }

  signin(): void {
    console.log("Display Sign in Form")
  }

  isAdmin(): boolean {
    return true;
  }
}
