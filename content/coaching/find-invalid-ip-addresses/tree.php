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
            'message' => "Read the problem statement above.\nValid octet?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0–255 without leading zeros', 'next' => 's2'],
                ['label' => 'Any 1 to 3 digits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The example → only (192.168.1, 1).\nStep back to when you accepted any digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ties on count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ip ascending', 'next' => 'wrong_b'],
                ['label' => 'ip descending', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 192.168.001.1 comes before 256.1.2.3.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Example → (256.1.2.3, 2), (192.168.001.1, 2), (192.168.1, 1).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
