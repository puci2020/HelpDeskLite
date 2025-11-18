import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TicketListComponent } from './pages/ticket-list/ticket-list.component';
import { TicketDetailsComponent } from './pages/ticket-details/ticket-details.component';
import {TicketEditComponent} from "./pages/ticket-edit/ticket-edit.component";

const routes: Routes = [
  { path: '', component: TicketListComponent },
  { path: 'create', component: TicketEditComponent },
  { path: ':id', component: TicketDetailsComponent },
  { path: ':id/edit', component: TicketEditComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class TicketsRoutingModule {}
