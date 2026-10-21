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
            'message' => "Read the problem statement above.\nCondition for a word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly once in each array', 'next' => 's2'],
                ['label' => 'Present in both arrays', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In Example 1, is appears twice in words1 and must not count.\nStep back to when you checked presence.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Once in each, or once overall?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Once across both arrays', 'next' => 'wrong_b'],
                ['label' => 'Once in each array', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A word seen once overall is missing from one array; as in Example 1 does not count.\nStep back to when you combined the arrays.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Data structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two counters', 'next' => 'success'],
                ['label' => 'Two sets intersected', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sets lose counts; Example 3 would give 2 instead of 1 because a appears three times in words2.\nStep back to when you used sets.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → 2, 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
