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
            'message' => "Read the problem statement above.\nAfter source[i] = source[i] + source[j] − delta and source[j] = delta, what stays the same?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The multiset of values', 'next' => 'wrong_a'],
                ['label' => 'The sum of the whole array', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 turns [1, 2, 3] into [0, 2, 4]. Requiring the same values gives false instead of true.\nStep back to when you compared values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The sums match. Is that enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: set entries 0 … n − 2 one at a time with the last entry as partner', 'next' => 'success'],
                ['label' => 'No, the values must also stay in a range', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. delta can be any integer, so each entry can be set to anything while the partner absorbs the difference.\nStep back to when you added a range limit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Compare the two sums. O(n). Examples give true, true and false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
