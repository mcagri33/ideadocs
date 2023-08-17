<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

  'accepted' => ':attribute kabul edilmelidir.',
  'accepted_if' => ':other :value ise, :attribute kabul edilmelidir.',
  'active_url' => ':attribute geçerli bir URL değil.',
  'after' => ':attribute :date tarihinden sonra olmalıdır.',
  'after_or_equal' => ':attribute :date tarihinden sonra veya aynı tarih olmalıdır.',
  'alpha' => ':attribute yalnızca harfler içermelidir.',
  'alpha_dash' => ':attribute yalnızca harfler, rakamlar, tireler ve alt çizgiler içermelidir.',
  'alpha_num' => ':attribute yalnızca harfler ve rakamlar içermelidir.',
  'array' => ':attribute bir dizi olmalıdır.',
  'before' => ':attribute :date tarihinden önce olmalıdır.',
  'before_or_equal' => ':attribute :date tarihinden önce veya aynı tarih olmalıdır.',
  'between' => [
    'array' => ':attribute en az :min, en fazla :max öğe içermelidir.',
    'file' => ':attribute :min ile :max kilobayt arasında olmalıdır.',
    'numeric' => ':attribute :min ile :max arasında olmalıdır.',
    'string' => ':attribute en az :min, en fazla :max karakter olmalıdır.',
  ],
  'boolean' => ':attribute alanı true veya false olmalıdır.',
  'confirmed' => ':attribute onayı eşleşmiyor.',
  'current_password' => 'Şifre yanlış.',
  'date' => ':attribute geçerli bir tarih değil.',
  'date_equals' => ':attribute :date tarihine eşit olmalıdır.',
  'date_format' => ':attribute biçimi :format ile eşleşmiyor.',
  'declined' => ':attribute reddedilmelidir.',
  'declined_if' => ':other :value ise, :attribute reddedilmelidir.',
  'different' => ':attribute ve :other farklı olmalıdır.',
  'digits' => ':attribute :digits basamaklı olmalıdır.',
  'digits_between' => ':attribute en az :min, en fazla :max basamaklı olmalıdır.',
  'dimensions' => ':attribute geçersiz resim boyutlarına sahip.',
  'distinct' => ':attribute alanı tekrar eden bir değere sahiptir.',
  'doesnt_end_with' => ':attribute aşağıdakilerden biriyle bitmemeli: :values.',
  'doesnt_start_with' => ':attribute aşağıdakilerden biriyle başlamamalı: :values.',
  'email' => ':attribute geçerli bir e-posta adresi olmalıdır.',
  'ends_with' => ':attribute aşağıdakilerden biriyle bitmelidir: :values.',
  'enum' => 'Seçilen :attribute geçersiz.',
  'exists' => 'Seçilen :attribute geçersiz.',
  'file' => ':attribute bir dosya olmalıdır.',
  'filled' => ':attribute alanı bir değere sahip olmalıdır.',
  'gt' => [
    'array' => ':attribute :value öğeden daha fazlasına sahip olmalıdır.',
    'file' => ':attribute :value kilobayttan daha büyük olmalıdır.',
    'numeric' => ':attribute :value değerinden daha büyük olmalıdır.',
    'string' => ':attribute :value karakterden daha uzun olmalıdır.',
  ],
  'gte' => [
    'array' => ':attribute en az :value öğeye sahip olmalıdır.',
    'file' => ':attribute en az :value kilobayt olmalıdır.',
    'numeric' => ':attribute :value değerine eşit veya daha büyük olmalıdır.',
    'string' => ':attribute en az :value karakter olmalıdır.',
  ],
  'image' => ':attribute bir resim olmalıdır.',
  'in' => 'Seçilen :attribute geçersiz.',
  'in_array' => ':attribute alanı :other içinde mevcut değil.',
  'integer' => ':attribute bir tam sayı olmalıdır.',
  'ip' => ':attribute geçerli bir IP adresi olmalıdır.',
  'ipv4' => ':attribute geçerli bir IPv4 adresi olmalıdır.',
  'ipv6' => ':attribute geçerli bir IPv6 adresi olmalıdır.',
  'json' => ':attribute geçerli bir JSON dizgesi olmalıdır.',
  'lowercase' => ':attribute küçük harf olmalıdır.',
  'lt' => [
    'array' => ':attribute :value öğeden daha azına sahip olmalıdır.',
    'file' => ':attribute :value kilobayttan daha küçük olmalıdır.',
    'numeric' => ':attribute :value değerinden daha küçük olmalıdır.',
    'string' => ':attribute :value karakterden daha kısa olmalıdır.',
  ],
  'lte' => [
    'array' => ':attribute :value öğeden fazlasına sahip olmamalıdır.',
    'file' => ':attribute :value kilobayttan daha küçük veya eşit olmalıdır.',
    'numeric' => ':attribute :value değerine eşit veya daha küçük olmalıdır.',
    'string' => ':attribute :value karakterden daha kısa veya eşit olmalıdır.',
  ],
  'mac_address' => ':attribute geçerli bir MAC adresi olmalıdır.',
  'max' => [
    'array' => ':attribute en fazla :max öğeye sahip olmalıdır.',
    'file' => ':attribute :max kilobayttan daha büyük olmamalıdır.',
    'numeric' => ':attribute :max değerinden daha büyük olmamalıdır.',
    'string' => ':attribute :max karakterden daha uzun olmamalıdır.',
  ],
  'max_digits' => ':attribute en fazla :max basamağa sahip olmamalıdır.',
  'mimes' => ':attribute dosya türü :values türünde olmalıdır.',
  'mimetypes' => ':attribute dosya türü :values türünde olmalıdır.',
  'min' => [
    'array' => ':attribute en az :min öğe içermelidir.',
    'file' => ':attribute en az :min kilobayt olmalıdır.',
    'numeric' => ':attribute en az :min olmalıdır.',
    'string' => ':attribute en az :min karakter olmalıdır.',
  ],
  'min_digits' => ':attribute en az :min basamağa sahip olmalıdır.',
  'multiple_of' => ':attribute :value katı olmalıdır.',
  'not_in' => 'Seçilen :attribute geçersiz.',
  'not_regex' => ':attribute biçimi geçersiz.',
  'numeric' => ':attribute bir sayı olmalıdır.',
  'password' => [
    'letters' => ':attribute en az bir harf içermelidir.',
    'mixed' => ':attribute en az bir büyük harf ve bir küçük harf içermelidir.',
    'numbers' => ':attribute en az bir rakam içermelidir.',
    'symbols' => ':attribute en az bir sembol içermelidir.',
    'uncompromised' => 'Verilen :attribute veri sızıntısında göründü. Lütfen farklı bir :attribute seçin.',
  ],
  'present' => ':attribute alanı mevcut olmalıdır.',
  'prohibited' => ':attribute alanı yasaktır.',
  'prohibited_if' => ':other :value ise, :attribute alanı yasaktır.',
  'prohibited_unless' => ':other :values içinde değilse, :attribute alanı yasaktır.',
  'prohibits' => ':attribute alanı :other alanının varlığını yasaklar.',
  'regex' => ':attribute biçimi geçersiz.',
  'required' => ':attribute alanı gereklidir.',
  'required_array_keys' => ':attribute alanı şunun için girişler içermelidir: :values.',
  'required_if' => ':other :value ise, :attribute alanı gereklidir.',
  'required_if_accepted' => ':other kabul edildiyse, :attribute alanı gereklidir.',
  'required_unless' => ':other :values içinde değilse, :attribute alanı gereklidir.',
  'required_with' => ':values mevcutsa, :attribute alanı gereklidir.',
  'required_with_all' => ':values mevcutsa, :attribute alanı gereklidir.',
  'required_without' => ':values mevcut değilse, :attribute alanı gereklidir.',
  'required_without_all' => ':values hiçbiri mevcut değilse, :attribute alanı gereklidir.',
  'same' => ':attribute ve :other eşleşmelidir.',
  'size' => [
    'array' => ':attribute :size öğe içermelidir.',
    'file' => ':attribute :size kilobayt olmalıdır.',
    'numeric' => ':attribute :size olmalıdır.',
    'string' => ':attribute :size karakter olmalıdır.',
  ],
  'starts_with' => ':attribute şunlardan biriyle başlamalıdır: :values.',
  'string' => ':attribute bir dize olmalıdır.',
  'timezone' => ':attribute geçerli bir saat dilimi olmalıdır.',
  'unique' => ':attribute zaten alınmış.',
  'uploaded' => ':attribute yüklenemedi.',
  'uppercase' => ':attribute büyük harf olmalıdır.',
  'url' => ':attribute geçerli bir URL olmalıdır.',
  'uuid' => ':attribute geçerli bir UUID olmalıdır.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
