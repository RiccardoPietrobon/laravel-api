<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PublishedProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Published Project from' . env('APP_NAME'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $project = $this->project;
        $published_text = $project->published ? 'Il progetto è stato pubblicato' : 'Il progetto è stato rimosso';
        $button_url = env('APP_FRONTEND_URL') . '/projects/' . $project->slug;

        return new Content(
            markdown: 'mails.projects.published',
            with: [
                'project' => $project,
                'published_text' => $published_text,
                'button_url' => $button_url,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
