import { Component, OnInit } from '@angular/core';
import { TicketService } from '../../services/ticket.service';
import {Ticket} from "../../../../shared/models/ticket.model";
import {Router} from "@angular/router";

@Component({
  selector: 'app-ticket-list',
  templateUrl: './ticket-list.component.html',
  styleUrls: ['./ticket-list.component.scss']
})
export class TicketListComponent implements OnInit {
  tickets: Ticket[] = [];
  loading = false;
  constructor(private ticketService: TicketService, private router: Router) {}

  ngOnInit(): void {
    this.loadTickets();
  }

  loadTickets(): void {
    this.loading = true;
    this.ticketService.getTickets().subscribe({
      next: data => {
        this.tickets = data;
        this.loading = false;
      },
      error: err => {
        console.error(err);
        this.loading = false;
      }
    });
  }

  deleteTicket(id: number): void {
    this.loading = true;
    this.ticketService.deleteTicket(id).subscribe({
      next: () => this.loadTickets(),
      error: err => {
        console.error(err);
        this.loading = false;
      }
    });
  }

  goToDetails(id: number): void {
    this.router.navigate(['/tickets', id])
  }
}
