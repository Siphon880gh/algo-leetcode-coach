<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "State:\nn = 10\nsplit it into positive parts with the largest product\n\nWhich split is strong?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3 + 3 + 2 + 2, giving 36', 'next' => 'mid'],
                ['label' => '5 + 5, giving 25', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nHere, 3s together with 2s beat 5 + 5.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ntaking another 3 would leave a remainder of 1\n\nHow do you fix it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use 2 + 2 instead of 3 + 1', 'next' => 'final'],
                ['label' => 'Keep the 1, since it does not change the product', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nMultiplying by 1 wastes a part. 2 + 2 gives a bigger product than 3 + 1.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou are choosing part sizes\n\nWhich size should most parts be close to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3', 'next' => 'success'],
                ['label' => '7', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe math favors 3s, with 2s to handle the remainder.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Prefer 3s, and fix a remainder of 1 with 2 + 2.\n- The best product for n = 10 is 36.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
