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
            'message' => "Problem: An array of equal integers except one larger value is accessible via a reader that returns its length and compares the sums of two subarrays, with a limited number of compares. Return the larger value's index. For instance, in [7,7,7,7,10,7,7,7] the answer is 4. (Restated from memory; limits and examples may differ slightly.)\nHalves of unequal length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never: leave the middle out', 'next' => 's2'],
                ['label' => 'Allowed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sums would mislead.\nStep back to when you compared unequal halves.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Halves equal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search both halves', 'next' => 'wrong_b'],
                ['label' => 'The middle element is the answer', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The large value is the excluded middle.\nStep back to when you searched both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Calls needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'About log₂ n', 'next' => 'success'],
                ['label' => 'About n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each compare halves the range.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) calls. [7,7,7,7,10,7,7,7] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
