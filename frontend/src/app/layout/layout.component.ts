
import {Component, OnInit, ViewChild} from '@angular/core';
import {AuthService} from "../core/auth/auth.service";
import {MatDialog} from "@angular/material/dialog";
import {UserProfileComponent} from "../shared/components/user-profile/user-profile.component";
import { Observable, map, shareReplay } from 'rxjs';
import {MatSidenav} from "@angular/material/sidenav";
import {BreakpointObserver, Breakpoints} from "@angular/cdk/layout";

@Component({
  selector: 'app-layout',
  templateUrl: './layout.component.html',
  styleUrls: ['./layout.component.scss']
})
export class LayoutComponent implements OnInit {
  @ViewChild('drawer') drawer!: MatSidenav;
  isHandset$: Observable<boolean> = this.breakpointObserver.observe(Breakpoints.Handset)
    .pipe(
      map(result => result.matches),
      shareReplay()
    );
  user: any = null;

  constructor(
    private breakpointObserver: BreakpointObserver,
    private auth: AuthService,
    private dialog: MatDialog
  ) {}

  ngOnInit(): void {
    this.user = this.auth.getUser();
  }

  openUserDialog() {
    this.dialog.open(UserProfileComponent, {
      width: '300px'
    });
  }
}
