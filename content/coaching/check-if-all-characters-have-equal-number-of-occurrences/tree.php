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
            'message' => "Read the problem statement above.\nWhich counts to compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only letters that appear', 'next' => 's2'],
                ['label' => 'All 26 letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Missing letters would add zeros.\nStep back to when you included absent letters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Good when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts sum to an even number', 'next' => 'wrong_b'],
                ['label' => 'Exactly one distinct count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Parity says nothing about equality.\nStep back to when you checked parity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Single repeated letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Good', 'next' => 'success'],
                ['label' => 'Not good', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One letter trivially has equal counts.\nStep back to when you rejected it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
