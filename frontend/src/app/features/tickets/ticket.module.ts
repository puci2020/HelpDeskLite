import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import { MatTableModule } from '@angular/material/table';
import { MatButtonModule } from '@angular/material/button';
import {TicketListComponent} from "./pages/ticket-list/ticket-list.component";
import {TicketDetailsComponent} from "./pages/ticket-details/ticket-details.component";
import {TicketsRoutingModule} from "./ticket-routing.module";
import { TicketEditComponent } from './pages/ticket-edit/ticket-edit.component';
import {MatCardModule} from "@angular/material/card";
import {MatInputModule} from "@angular/material/input";
import {MatFormFieldModule} from "@angular/material/form-field";
import {MatOptionModule} from "@angular/material/core";
import {MatSelectModule} from "@angular/material/select";
import { TagSelectorComponent } from './components/tag-selector/tag-selector.component';
import { PriorityBadgeComponent } from './components/priority-badge/priority-badge.component';
import {MatChipsModule} from "@angular/material/chips";
import {MatLegacyChipsModule} from "@angular/material/legacy-chips";
import { TicketCardComponent } from './components/ticket-card/ticket-card.component';
import {MatProgressSpinnerModule} from "@angular/material/progress-spinner";


@NgModule({
  declarations: [
    TicketListComponent,
    TicketDetailsComponent,
    TicketEditComponent,
    TagSelectorComponent,
    PriorityBadgeComponent,
    TicketCardComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    MatTableModule,
    MatButtonModule,
    TicketsRoutingModule,
    MatCardModule,
    MatInputModule,
    MatFormFieldModule,
    ReactiveFormsModule,
    MatOptionModule,
    MatSelectModule,
    MatChipsModule,
    MatLegacyChipsModule,
    MatProgressSpinnerModule
  ]
})
export class TicketsModule {}
