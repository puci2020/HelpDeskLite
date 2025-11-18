import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {AuthGuard} from "./core/auth/auth.guard";
import {LayoutComponent} from "./layout/layout.component";

const routes: Routes = [
  {
    path: 'tickets',
    component: LayoutComponent,
    loadChildren: () =>
      import('./features/tickets/ticket.module').then(m => m.TicketsModule),
    canActivate: [AuthGuard]
  },
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: '**', redirectTo: 'login' }

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
