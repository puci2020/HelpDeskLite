import { Component, Input, Output, EventEmitter } from '@angular/core';
import {Ticket} from "../../../../shared/models/ticket.model";
@Component({
  selector: 'app-ticket-card',
  templateUrl: './ticket-card.component.html',
  styleUrls: ['./ticket-card.component.scss']
})
export class TicketCardComponent {
  @Input() ticket!: Ticket;
  @Output() deleted = new EventEmitter<number>();
  @Output() clicked = new EventEmitter<number>();

  deleteTicket(event: Event) {
    event.stopPropagation();
    this.deleted.emit(this.ticket.id);
  }

  viewTicket() {
    this.clicked.emit(this.ticket.id);
  }

}
