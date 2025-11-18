import { User } from './user.model';
import { Tag } from './tag.model';
import { TicketStatusChange } from './ticket-status-change.model';

export interface Ticket {
  id: number;
  title: string;
  description: string;
  priority: 'low' | 'medium' | 'high';
  status: 'open' | 'in_progress' | 'closed';
  reporter_id: number;
  assignee_id: number;
  reporter?: User;
  assignee?: User;
  tags: Tag[] | [];
  statusChanges?: TicketStatusChange[];
  created_at: string;
  updated_at: string;
  created_at_formatted?: string;
  updated_at_formatted?: string;
}
