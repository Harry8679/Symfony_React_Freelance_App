<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InvoiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['invoice_read']])]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['invoice_read', 'customer_read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['invoice_read', 'customer_read'])]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['invoice_read', 'customer_read'])]
    private ?\DateTimeInterface $sentAt = null;

    #[ORM\Column(length: 255)]
    #[Groups(['invoice_read', 'customer_read'])]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    #[Groups(['invoice_read'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column]
    #[Groups(['invoice_read', 'customer_read'])]
    private ?int $chrono = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getSentAt(): ?\DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeInterface $sentAt): static
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getChrono(): ?int
    {
        return $this->chrono;
    }

    public function setChrono(int $chrono): static
    {
        $this->chrono = $chrono;

        return $this;
    }
}
