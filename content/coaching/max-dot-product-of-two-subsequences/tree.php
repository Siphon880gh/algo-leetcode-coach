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
            'message' => "Read the problem statement above.\nBorder values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−∞', 'next' => 's2'],
                ['label' => '0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 0 allows empty subsequences.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Take p alone?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always extend', 'next' => 'wrong_b'],
                ['label' => 'Yes: start a new pairing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A negative prefix should be dropped.\nStep back to when you always extended.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "All products negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the max single product', 'next' => 'success'],
                ['label' => 'Return 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [-1,-1] · [1,1] → −1.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(nm). Example 1 → 18. Example 2 → 21. Example 3 → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
