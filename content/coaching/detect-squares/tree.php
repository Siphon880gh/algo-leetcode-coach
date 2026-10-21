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
            'message' => "Read the problem statement above.\nA stored point (a, b) is a valid diagonal when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|a − x| = |b − y| > 0', 'next' => 's2'],
                ['label' => '|a − x| = |b − y|', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Without > 0 the query point itself counts as a square of area 0.\nStep back to when you allowed side 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Duplicate points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each position once', 'next' => 'wrong_b'],
                ['label' => 'Count each copy: multiply counts', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The example's last query returns 2 because (11, 2) was added twice.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Squares through diagonal (a, b)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt[(a, b)] · cnt[(a, y)] · cnt[(x, b)]', 'next' => 'success'],
                ['label' => 'cnt[(a, b)]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The other two corners must exist too, with their own multiplicities.\nStep back to when you counted the diagonal alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count O(P). Example → 1, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
