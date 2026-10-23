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
            'message' => "Read the problem statement above.\nSame prime from two substrings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count it once', 'next' => 's2'],
                ['label' => 'Count both', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 22 instead of 11.\nStep back to when you kept duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Prime test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Divisible by none of 2, 3, 5, 7', 'next' => 'wrong_b'],
                ['label' => 'Trial division up to √v', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 121 → 123 instead of 2, since 121 = 11².\nStep back to when you used only small primes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · √V). Examples → 1469, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
