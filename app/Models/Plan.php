<?php 

namespace App\Models;

/**
 * プラン一覧
 *
 * @method static FREE()
 * @method static PRO()
 */
final class Plan extends Enum {
    #[MaximumMember(20)]
    const FREE = 'free';

    #[MaximumMember(100)]
    const PRO = 'pro';

    public function maximumMember(): MaximumMember {
        return $this->getAttribute(MaximumMember::class);
    }
}
