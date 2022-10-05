<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMessage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $index = 0;
        $index =$index + 1;
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title_en' => 'message title '.$index,
            'title_ar' => 'عنوان رسالة ' . $index,
            'message_en' => $this->faker->paragraph(),
            'message_ar' => 'إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص كما يمكن استخدامه لتصاميم الجرافيكس.',
        ];
    }
}
