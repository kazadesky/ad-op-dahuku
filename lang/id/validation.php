<?php

return [

    'accepted' => 'Field :attribute harus diterima.',
    'accepted_if' => 'Field :attribute harus diterima ketika :other adalah :value.',
    'active_url' => 'Field :attribute harus merupakan URL yang valid.',
    'after' => 'Field :attribute harus merupakan tanggal setelah :date.',
    'after_or_equal' => 'Field :attribute harus merupakan tanggal setelah atau sama dengan :date.',
    'alpha' => 'Field :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Field :attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num' => 'Field :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Field :attribute harus berupa array.',
    'ascii' => 'Field :attribute hanya boleh berisi karakter alfanumerik dan simbol satu byte.',
    'before' => 'Field :attribute harus merupakan tanggal sebelum :date.',
    'before_or_equal' => 'Field :attribute harus merupakan tanggal sebelum atau sama dengan :date.',
    'between' => [
        'array' => 'Field :attribute harus memiliki antara :min dan :max item.',
        'file' => 'Field :attribute harus antara :min dan :max kilobyte.',
        'numeric' => 'Field :attribute harus antara :min dan :max.',
        'string' => 'Field :attribute harus antara :min dan :max karakter.',
    ],
    'boolean' => 'Field :attribute harus true atau false.',
    'can' => 'Field :attribute mengandung nilai yang tidak sah.',
    'confirmed' => 'Konfirmasi field :attribute tidak cocok.',
    'contains' => 'Field :attribute kehilangan nilai yang diperlukan.',
    'current_password' => 'Kata sandi salah.',
    'date' => 'Field :attribute harus merupakan tanggal yang valid.',
    'date_equals' => 'Field :attribute harus merupakan tanggal yang sama dengan :date.',
    'date_format' => 'Field :attribute harus sesuai dengan format :format.',
    'decimal' => 'Field :attribute harus memiliki :decimal tempat desimal.',
    'declined' => 'Field :attribute harus ditolak.',
    'declined_if' => 'Field :attribute harus ditolak ketika :other adalah :value.',
    'different' => 'Field :attribute dan :other harus berbeda.',
    'digits' => 'Field :attribute harus berupa :digits digit.',
    'digits_between' => 'Field :attribute harus antara :min dan :max digit.',
    'dimensions' => 'Field :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Field :attribute memiliki nilai duplikat.',
    'doesnt_end_with' => 'Field :attribute tidak boleh diakhiri dengan salah satu dari berikut: :values.',
    'doesnt_start_with' => 'Field :attribute tidak boleh dimulai dengan salah satu dari berikut: :values.',
    'email' => 'Field :attribute harus merupakan alamat email yang valid.',
    'ends_with' => 'Field :attribute harus diakhiri dengan salah satu dari berikut: :values.',
    'enum' => 'Field :attribute yang dipilih tidak valid.',
    'exists' => 'Field :attribute yang dipilih tidak valid.',
    'extensions' => 'Field :attribute harus memiliki salah satu ekstensi berikut: :values.',
    'file' => 'Field :attribute harus berupa file.',
    'filled' => 'Field :attribute harus memiliki nilai.',
    'gt' => [
        'array' => 'Field :attribute harus memiliki lebih dari :value item.',
        'file' => 'Field :attribute harus lebih dari :value kilobyte.',
        'numeric' => 'Field :attribute harus lebih dari :value.',
        'string' => 'Field :attribute harus lebih dari :value karakter.',
    ],
    'gte' => [
        'array' => 'Field :attribute harus memiliki :value item atau lebih.',
        'file' => 'Field :attribute harus lebih besar dari atau sama dengan :value kilobyte.',
        'numeric' => 'Field :attribute harus lebih besar dari atau sama dengan :value.',
        'string' => 'Field :attribute harus lebih besar dari atau sama dengan :value karakter.',
    ],
    'hex_color' => 'Field :attribute harus merupakan warna heksadesimal yang valid.',
    'image' => 'Field :attribute harus berupa gambar.',
    'in' => 'Field :attribute yang dipilih tidak valid.',
    'in_array' => 'Field :attribute harus ada dalam :other.',
    'integer' => 'Field :attribute harus berupa integer.',
    'ip' => 'Field :attribute harus merupakan alamat IP yang valid.',
    'ipv4' => 'Field :attribute harus merupakan alamat IPv4 yang valid.',
    'ipv6' => 'Field :attribute harus merupakan alamat IPv6 yang valid.',
    'json' => 'Field :attribute harus berupa string JSON yang valid.',
    'list' => 'Field :attribute harus berupa daftar.',
    'lowercase' => 'Field :attribute harus menggunakan huruf kecil.',
    'lt' => [
        'array' => 'Field :attribute harus memiliki kurang dari :value item.',
        'file' => 'Field :attribute harus kurang dari :value kilobyte.',
        'numeric' => 'Field :attribute harus kurang dari :value.',
        'string' => 'Field :attribute harus kurang dari :value karakter.',
    ],
    'lte' => [
        'array' => 'Field :attribute tidak boleh memiliki lebih dari :value item.',
        'file' => 'Field :attribute harus kurang dari atau sama dengan :value kilobyte.',
        'numeric' => 'Field :attribute harus kurang dari atau sama dengan :value.',
        'string' => 'Field :attribute harus kurang dari atau sama dengan :value karakter.',
    ],
    'mac_address' => 'Field :attribute harus merupakan alamat MAC yang valid.',
    'max' => [
        'array' => 'Field :attribute tidak boleh memiliki lebih dari :max item.',
        'file' => 'Field :attribute tidak boleh lebih besar dari :max kilobyte.',
        'numeric' => 'Field :attribute tidak boleh lebih besar dari :max.',
        'string' => 'Field :attribute tidak boleh lebih besar dari :max karakter.',
    ],
    'max_digits' => 'Field :attribute tidak boleh memiliki lebih dari :max digit.',
    'mimes' => 'Field :attribute harus berupa file tipe: :values.',
    'mimetypes' => 'Field :attribute harus berupa file tipe: :values.',
    'min' => [
        'array' => 'Field :attribute harus memiliki setidaknya :min item.',
        'file' => 'Field :attribute harus minimal :min kilobyte.',
        'numeric' => 'Field :attribute harus minimal :min.',
        'string' => 'Field :attribute harus minimal :min karakter.',
    ],
    'min_digits' => 'Field :attribute harus memiliki setidaknya :min digit.',
    'missing' => 'Field :attribute harus hilang.',
    'missing_if' => 'Field :attribute harus hilang ketika :other adalah :value.',
    'missing_unless' => 'Field :attribute harus hilang kecuali :other adalah :value.',
    'missing_with' => 'Field :attribute harus hilang ketika :values ada.',
    'missing_with_all' => 'Field :attribute harus hilang ketika :values ada.',
    'multiple_of' => 'Field :attribute harus merupakan kelipatan dari :value.',
    'not_in' => 'Field :attribute yang dipilih tidak valid.',
    'not_regex' => 'Format field :attribute tidak valid.',
    'numeric' => 'Field :attribute harus berupa angka.',
    'password' => [
        'letters' => 'Field :attribute harus mengandung setidaknya satu huruf.',
        'mixed' => 'Field :attribute harus mengandung setidaknya satu huruf kapital dan satu huruf kecil.',
        'numbers' => 'Field :attribute harus mengandung setidaknya satu angka.',
        'symbols' => 'Field :attribute harus mengandung setidaknya satu simbol.',
        'uncompromised' => 'Field :attribute yang diberikan telah muncul dalam kebocoran data. Silakan pilih :attribute yang berbeda.',
    ],
    'present' => 'Field :attribute harus ada.',
    'present_if' => 'Field :attribute harus ada ketika :other adalah :value.',
    'present_unless' => 'Field :attribute harus ada kecuali :other adalah :value.',
    'present_with' => 'Field :attribute harus ada ketika :values ada.',
    'present_with_all' => 'Field :attribute harus ada ketika :values ada.',
    'prohibited' => 'Field :attribute dilarang.',
    'prohibited_if' => 'Field :attribute dilarang ketika :other adalah :value.',
    'prohibited_unless' => 'Field :attribute dilarang kecuali :other ada dalam :values.',
    'prohibits' => 'Field :attribute melarang :other untuk ada.',
    'regex' => 'Format field :attribute tidak valid.',
    'required' => 'Field :attribute diperlukan.',
    'required_array_keys' => 'Field :attribute harus berisi entri untuk: :values.',
    'required_if' => 'Field :attribute diperlukan ketika :other adalah :value.',
    'required_if_accepted' => 'Field :attribute diperlukan ketika :other diterima.',
    'required_if_declined' => 'Field :attribute diperlukan ketika :other ditolak.',
    'required_unless' => 'Field :attribute diperlukan kecuali :other ada dalam :values.',
    'required_with' => 'Field :attribute diperlukan ketika :values ada.',
    'required_with_all' => 'Field :attribute diperlukan ketika :values ada.',
    'required_without' => 'Field :attribute diperlukan ketika :values tidak ada.',
    'required_without_all' => 'Field :attribute diperlukan ketika tidak ada :values yang ada.',
    'same' => 'Field :attribute harus cocok dengan :other.',
    'size' => [
        'array' => 'Field :attribute harus berisi :size item.',
        'file' => 'Field :attribute harus :size kilobyte.',
        'numeric' => 'Field :attribute harus :size.',
        'string' => 'Field :attribute harus :size karakter.',
    ],
    'starts_with' => 'Field :attribute harus dimulai dengan salah satu dari berikut: :values.',
    'string' => 'Field :attribute harus berupa string.',
    'timezone' => 'Field :attribute harus merupakan zona waktu yang valid.',
    'unique' => 'Field :attribute sudah digunakan.',
    'uploaded' => 'Field :attribute gagal diunggah.',
    'uppercase' => 'Field :attribute harus menggunakan huruf kapital.',
    'url' => 'Field :attribute harus merupakan URL yang valid.',
    'ulid' => 'Field :attribute harus merupakan ULID yang valid.',
    'uuid' => 'Field :attribute harus merupakan UUID yang valid.',

    /*
    |-----------------------------------------------------------------------
    | Custom Validation Language Lines
    |-----------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut
    | menggunakan konvensi "attribute.rule" untuk menamai garis. Ini membuatnya cepat
    | untuk menentukan garis bahasa kustom tertentu untuk aturan atribut tertentu.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |-----------------------------------------------------------------------
    | Custom Validation Attributes
    |-----------------------------------------------------------------------
    |
    | Garis bahasa berikut digunakan untuk mengganti placeholder atribut
    | dengan sesuatu yang lebih ramah pembaca seperti "Alamat E-Mail" alih-alih
    | "email". Ini membantu kami membuat pesan kami lebih ekspresif.
    |
    */

    'attributes' => [],

];