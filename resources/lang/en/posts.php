<?php

return [
    'index' => [
        'title' => 'Posts',
        'empty' => 'There are not posts',
        'buttonAdd' => 'Create post'
    ],
    'create' => [
        'title' => 'Create a post',
        'subtitle' => 'Your post will be shown to everyone',
        'fields' => [
            'title' => [
                'label' => 'Title',
                'placeholder' => 'Type here your post title'
            ],
            'description' => [
                'label' => 'Description',
                'placeholder' => 'Type here the content post'
            ],
            'publicationDate' => [
                'label' => 'Publication date',
                'placeholder' => 'Select the date of publication of the post'
            ]
        ],
        'cancel' => 'Cancel',
        'save' => 'Create',
        'success' => 'Your post has been created'
    ]
];
