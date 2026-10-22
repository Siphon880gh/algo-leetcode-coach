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
            'message' => "Read the problem statement above.\nA fully covered node is flipped. Its count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'length − count', 'next' => 's2'],
                ['label' => 'Unchanged until later', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The root count is read right away; Example 1 → [2] instead of [3].\nStep back to when you left the count alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Descending into a node with a pending flip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just descend', 'next' => 'wrong_b'],
                ['label' => 'Push the flip to both children first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The children are stale; nums1 = [0,1], flip [0,1], flip [0,0], then p = 1 → [2] instead of [0].\nStep back to when you skipped the push.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q log n). Examples → [3], [5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
