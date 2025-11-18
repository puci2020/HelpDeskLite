// src/app/features/tickets/pages/ticket-details/ticket-details.component.ts
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { TicketService } from '../../services/ticket.service';
import {Ticket} from "../../../../shared/models/ticket.model";

@Component({
  selector: 'app-ticket-details',
  templateUrl: './ticket-details.component.html'
})
export class TicketDetailsComponent implements OnInit {
  ticket: Ticket = {} as Ticket;
  triageSuggestion: string | null = null;

  constructor(private route: ActivatedRoute, private ticketService: TicketService) {}

  ngOnInit(): void {
    const id = +this.route.snapshot.paramMap.get('id')!;
    this.ticketService.getTicket(id).subscribe(t => {
      console.log(t)
      this.ticket = t
    });
  }

  suggestTriage(): void {
    if (!this.ticket) return;
    this.ticketService.suggestTriage(this.ticket.id).subscribe(result => {
      this.triageSuggestion = result.suggestion;
    });
  }
}
