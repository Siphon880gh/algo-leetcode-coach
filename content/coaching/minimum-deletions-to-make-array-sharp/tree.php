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
            'message' => "Read the problem statement above.\na XOR b = 0 means what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a and b share a bit', 'next' => 'wrong_a'],
                ['label' => 'a = b', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. XOR is 0 only when every bit matches. 1 XOR 3 = 2 even though they share bit 0.\nStep back to when you used a shared bit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "[4, 4, 9, 4]: delete every duplicate 4?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, only one 4 of the adjacent pair', 'next' => 'success'],
                ['label' => 'Yes, keep a single 4', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last 4 sits next to 9. Deleting all duplicates gives 2 instead of 1.\nStep back to when you deleted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count equal neighbours. O(n). Examples give 3 and 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
