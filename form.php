<?php
include 'fw/init.php';
if (isset($app)) {
    $app->header();
}
$params = [
    'method' => 'post',
    'elements' => [
            ['type' => 'text',
                'additional_class' => 'mb-3',
                'attr' => [
                        'class' => 'form-control',
                ],
                'title' => 'Text'],
        ['type' => 'number',
            'additional_class' => 'mb-3',
            'attr' => [
                'class' => 'form-control',
            ],
            'title' => 'Number'],
        ['type' => 'password',
            'additional_class' => 'mb-3',
            'attr' => [
                'class' => 'form-control',
            ],
            'title' => 'Password'],
        ['type' => 'checkbox',
            'additional_class' => 'mb-3',
            'attr' => [
                'class' => 'form-check-input',
            ],
            'title' => 'Checkbox'],
        ['type' => 'radio',
            'additional_class' => 'mb-3',
            'attr' => [
                'class' => 'form-check-input',
            ],
            'title' => 'Radio',
            'name' => 'radio'],
        ['type' => 'radio',
            'additional_class' => 'mb-3',
            'attr' => [
                'class' => 'form-check-input',
            ],
            'title' => 'Radio',
            'name' => 'radio'],
        ['type' => 'select',
            'title' => 'Select',
            'additional_class' => 'mb-3',
            'attr' => [
                'class' => 'form-control',
            ],
            'list' => [
                    ['title' => 'option 1'],
                ['title' => 'option 2']
            ]
        ],
        ['type' => 'select',
            'title' => 'Select',
            'additional_class' => 'mb-3',
            'attr' => [
                'class' => 'form-control',
                    'multiple' => true,
            ],
            'list' => [
                ['title' => 'option 1'],
                ['title' => 'option 2']
            ]
        ],
        ['type' => 'textarea',
            'title' => 'Textarea',
            'additional_class' => 'mb-3',
            'attr' => [
                'class' => 'form-control',
            ],],
    ],
    'submit' => [
            'additional_class' => 'col text-center',
        'title' => 'Submit',
        'attr' => [
                'class' => 'btn btn-primary',
        ]
    ]
]
?>
<div class="row">
    <div class="col-md-8 mx-auto">
    <?= $app->includeComponent('fw:interface.form', 'default', $params) ?>

    </div>
</div>
<?php $app->footer() ?>
