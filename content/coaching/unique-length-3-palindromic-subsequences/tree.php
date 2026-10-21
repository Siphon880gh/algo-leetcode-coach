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
            'message' => "Read the problem statement above.\nOuter pair to use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First and last occurrence', 'next' => 's2'],
                ['label' => 'Every pair of occurrences', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The widest pair already covers all middles.\nStep back to when you tried every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Middle count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Number of characters between them', 'next' => 'wrong_b'],
                ['label' => 'Distinct letters between them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeated middles give the same palindrome.\nStep back to when you counted characters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Letter appears once?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Contributes 0', 'next' => 'success'],
                ['label' => 'Contributes 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A palindrome needs it twice.\nStep back to when you counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · n). Examples → 3, 0, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
