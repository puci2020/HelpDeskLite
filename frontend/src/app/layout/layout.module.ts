import { MatSidenavModule } from '@angular/material/sidenav';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatButtonModule } from '@angular/material/button';
import { MatListModule } from '@angular/material/list';
import { MatIconModule } from '@angular/material/icon';
import {NgModule} from "@angular/core";
import {LayoutComponent} from "./layout.component";
import {HeaderComponent} from "./components/header/header.component";
import {SidebarComponent} from "./components/sidebar/sidebar.component";
import {RouterLink, RouterOutlet} from "@angular/router";
import {AsyncPipe, NgIf} from "@angular/common";
import { FooterComponent } from './components/footer/footer.component';
import {UserProfileComponent} from "../shared/components/user-profile/user-profile.component";
import {MatCardModule} from "@angular/material/card";
import {MatProgressSpinnerModule} from "@angular/material/progress-spinner";
import {MatDialogModule} from "@angular/material/dialog";

@NgModule({
  declarations: [
    LayoutComponent,
    HeaderComponent,
    SidebarComponent,
    FooterComponent,
    UserProfileComponent
  ],
  imports: [
    MatSidenavModule,
    MatToolbarModule,
    MatButtonModule,
    MatListModule,
    MatIconModule,
    RouterOutlet,
    NgIf,
    RouterLink,
    MatCardModule,
    MatProgressSpinnerModule,
    MatDialogModule,
    AsyncPipe
  ],
  exports: [LayoutComponent]
})
export class LayoutModule {}
