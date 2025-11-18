import {Component, Input, OnInit, Renderer2} from '@angular/core';
import { Router } from '@angular/router';
import {AuthService} from "../../../core/auth/auth.service";
import {MatSidenav} from "@angular/material/sidenav";
import {BreakpointObserver, Breakpoints} from "@angular/cdk/layout";
import {map, Observable, shareReplay} from "rxjs";

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['header.component.scss']
})
export class HeaderComponent implements OnInit {
  @Input() drawer!: MatSidenav;

  user: any;
  darkMode = false;
  isHandset$: Observable<boolean>;

  constructor(private breakpointObserver: BreakpointObserver, private auth: AuthService, private router: Router, private renderer: Renderer2) {
    this.isHandset$ = this.breakpointObserver.observe(Breakpoints.Handset)
      .pipe(
        map(result => result.matches),
        shareReplay()
      );
  }

  ngOnInit(): void {
    this.user = this.auth.getUser(); // metoda w AuthService zwracająca aktualnego użytkownika
  }

  logout() {
    this.auth.logout().subscribe(() => this.router.navigate(['/login']));
  }

  toggleTheme() {
    this.darkMode = !this.darkMode;

    if (this.darkMode) {
      this.renderer.addClass(document.body, 'dark-theme');
    } else {
      this.renderer.removeClass(document.body, 'dark-theme');
    }
  }

  toggleSidenav() {
    this.drawer.toggle();
  }
}
