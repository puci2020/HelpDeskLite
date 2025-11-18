import {Component, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {ActivatedRoute, Router} from "@angular/router";
import {TicketService} from "../../services/ticket.service";

@Component({
  selector: 'app-ticket-edit',
  templateUrl: './ticket-edit.component.html',
  styleUrls: ['./ticket-edit.component.scss']
})
export class TicketEditComponent implements OnInit {

  form!: FormGroup;
  ticketId: number | null = null;
  loading = false;

  constructor(
    private fb: FormBuilder,
    private route: ActivatedRoute,
    private router: Router,
    private ticketService: TicketService
  ) {}

  ngOnInit(): void {
    this.ticketId = Number(this.route.snapshot.paramMap.get('id'));

    this.form = this.fb.group({
      title: ['', Validators.required],
      description: ['', Validators.required],
      priority: ['medium', Validators.required],
      status: ['open', Validators.required],
    });

    // tryb edycji — pobranie ticketu
    if (this.ticketId) {
      this.ticketService.getTicket(this.ticketId).subscribe(ticket => {
        this.form.patchValue({
          ...ticket,
          // tags: ticket.tags.map(t => t.name)
        });
      });
    }
  }

  save() {
    this.loading = true;

    if (!this.ticketId) {
      this.ticketService.createTicket(this.form.value).subscribe(() => {
        this.router.navigate(['/tickets']);
      });
    } else {
      this.ticketService.updateTicket(this.ticketId, this.form.value).subscribe(() => {
        this.router.navigate(['/tickets', this.ticketId]);
      });
    }
  }

  suggestTriage() {
    if (!this.ticketId) return;

    this.ticketService.suggestTriage(this.ticketId).subscribe(suggestion => {
      this.patchTriageSuggestion(suggestion)
    });
  }

  patchTriageSuggestion(s: any) {
    this.form.patchValue({
      priority: s.priority,
      assignee_id: s.assignee_id
    });
  }

}
