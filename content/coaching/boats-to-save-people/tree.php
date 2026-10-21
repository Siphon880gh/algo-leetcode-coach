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
            'message' => "Read the problem statement above.\nWho must always board the next boat?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The heaviest remaining person', 'next' => 's2'],
                ['label' => 'The lightest remaining person', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The heaviest has the fewest possible partners, so place them first.\nStep back to when you started with the lightest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The heaviest and the lightest fit together. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Look for a heavier partner', 'next' => 'wrong_b'],
                ['label' => 'Send them together', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pairing with the lightest leaves heavier partners for others, which is never worse.\nStep back to when you searched for another partner.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can a boat take three people?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: at most two', 'next' => 'success'],
                ['label' => 'Yes, if the weights fit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem limits each boat to two people.\nStep back to when you added a third.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [1,2], 3 → 1. [3,2,2,1], 3 → 3. [3,5,3,4], 5 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
