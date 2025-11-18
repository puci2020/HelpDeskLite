import { Component, Input } from '@angular/core';


@Component({
  selector: 'app-priority-badge',
  templateUrl: './priority-badge.component.html',
  styleUrls: ['./priority-badge.component.scss']
})

export class PriorityBadgeComponent {
  @Input() priority: 'low' | 'medium' | 'high' = 'medium';
  get bgColor(): string {
    switch (this.priority) {
      case 'low':
        return '#1976d2';
      case 'medium':
        return '#9c27b0';
      case 'high':
        return '#f44336';
      default:
        return '#e0e0e0';
    }
  }

  get textColor(): string {
    return this.priority === 'medium' ? '#fff' : '#fff';
  }
}
