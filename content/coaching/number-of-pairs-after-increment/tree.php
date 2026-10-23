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
            'message' => "Read the problem statement above.\nRepeated values in nums1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each copy', 'next' => 's2'],
                ['label' => 'Deduplicate', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [1, 3] instead of [2, 6].\nStep back to when you deduplicated nums1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Lookup key in block b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'tot − a', 'next' => 'wrong_b'],
                ['label' => 'tot − a − lazy[b]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 with blocks of size 1 → [2, 2] instead of [2, 1].\nStep back to when you forgot the lazy add.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q √n). Examples → [2, 1], [2, 6], [1, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
