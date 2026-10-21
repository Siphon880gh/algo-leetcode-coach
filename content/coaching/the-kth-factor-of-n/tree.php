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
            'message' => "Read the problem statement above.\nPerfect square n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count √n once', 'next' => 's2'],
                ['label' => 'Count it twice', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. √n is its own partner.\nStep back to when you counted it twice.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of the large divisors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same order', 'next' => 'wrong_b'],
                ['label' => 'Partners of small divisors in reverse', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n / i decreases as i grows.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Fewer than k factors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. n = 4, k = 4 → −1.\nStep back to when you returned n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√n). (12, 3) → 3. (7, 2) → 7. (4, 4) → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
