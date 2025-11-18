export interface TicketStatusChange {
  id: number;
  ticket_id: number;
  previous_status: string;
  new_status: string;
  created_at: string;
}
