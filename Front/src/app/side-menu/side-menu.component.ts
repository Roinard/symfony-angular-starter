import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-side-menu',
  templateUrl: './side-menu.component.html',
  styleUrls: ['../app.component.scss',
  "./side-menu.component.scss"]
})
export class SideMenuComponent implements OnInit {

  categories = {
    "HTB" : ["Writeup ServMon", "Writeup Fatty"],
    "Blue_Team Village": ["Challenge 1"],
    "Forensic Notes" : ["Excel Analysis", "Pdf Analysis", "Volatility"],
    "OSCP Notes" : ["OWASP CheatSheet", "Burp CheatSheet", "Nmap CheatSheet"]
  }

  constructor() { }

  ngOnInit(): void {
  }

}
