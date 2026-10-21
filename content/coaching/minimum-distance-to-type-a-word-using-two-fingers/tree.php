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
            'message' => "Read the problem statement above.\nState?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Index and the other finger', 'next' => 's2'],
                ['label' => 'Both fingers explicitly', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One finger is implied by the previous letter.\nStep back to when you tracked both.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First placement cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distance from A', 'next' => 'wrong_b'],
                ['label' => '0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Fingers start anywhere for free.\nStep back to when you charged it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Manhattan on 6 columns', 'next' => 'success'],
                ['label' => 'Alphabet gap', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The keyboard is a grid.\nStep back to when you used the alphabet gap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 27). \"CAKE\" → 3. \"HAPPY\" → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
