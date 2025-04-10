<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $file_name
 * @property string $invoice_number
 * @property string $Created_by
 * @property int|null $invoice_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\invoices|null $invoice
 * @method static \Illuminate\Database\Eloquent\Builder|invoice_attachments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoice_attachments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoice_attachments query()
 * @method static \Illuminate\Database\Eloquent\Builder|invoice_attachments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice_attachments whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice_attachments whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice_attachments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice_attachments whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice_attachments whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice_attachments whereUpdatedAt($value)
 */
	class invoice_attachments extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $invoice_number
 * @property string|null $invoice_Date
 * @property string|null $Due_date
 * @property string $product
 * @property int $section_id
 * @property string|null $Amount_collection
 * @property string $Amount_Commission
 * @property string $Discount_Commission
 * @property string $Value_VAT
 * @property string|null $Rate_VAT
 * @property string $Total
 * @property string $Status
 * @property int $Value_Status
 * @property string|null $note
 * @property string|null $Payment_Date
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\sections $section
 * @method static \Illuminate\Database\Eloquent\Builder|invoices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoices query()
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereAmountCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereAmountCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereDiscountCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereInvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereRateVAT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereValueStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices whereValueVAT($value)
 */
	class invoices extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $id_Invoice
 * @property string $invoice_number
 * @property string $product
 * @property string $Section
 * @property string $Status
 * @property int $Value_Status
 * @property string|null $Payment_Date
 * @property string|null $note
 * @property string $user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\invoices $invoice
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details query()
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details whereIdInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details whereProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_details whereValueStatus($value)
 */
	class invoices_details extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $Amount_collection
 * @property string $Amount_Commission
 * @property string $Discount_Commission
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_sittings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_sittings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_sittings query()
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_sittings whereAmountCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_sittings whereAmountCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_sittings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_sittings whereDiscountCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_sittings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoices_sittings whereUpdatedAt($value)
 */
	class invoices_sittings extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $product_name
 * @property string|null $description
 * @property int $section_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\sections $section
 * @method static \Illuminate\Database\Eloquent\Builder|products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|products query()
 * @method static \Illuminate\Database\Eloquent\Builder|products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|products whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|products whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|products whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|products whereUpdatedAt($value)
 */
	class products extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $section_name
 * @property string|null $description
 * @property string $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|sections newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|sections newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|sections query()
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereUpdatedAt($value)
 */
	class sections extends \Eloquent {}
}

