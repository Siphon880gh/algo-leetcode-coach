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
            'message' => "Read the problem statement above.\nHow do you find which blocks can go on top of (a, b)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A map from the pair to its allowed tops', 'next' => 's2'],
                ['label' => 'Scan the whole allowed list each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A map makes each lookup O(1).\nStep back to when you scanned the list.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you build the next row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the first allowed top for each pair', 'next' => 'wrong_b'],
                ['label' => 'DFS over positions, choosing one allowed top per adjacent pair', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A different choice may be needed higher up.\nStep back to when you took the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The same row is reached by two paths. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reuse the memoized result', 'next' => 'success'],
                ['label' => 'Rebuild from scratch', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rows repeat often; memoization avoids exponential rework.\nStep back to when you rebuilt.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Memoized backtracking. bottom \"BCD\", allowed [\"BCC\",\"CDE\",\"CEA\",\"FFF\"] → true. bottom \"AAAA\", allowed [\"AAB\",\"AAC\",\"BCD\",\"BBE\",\"DEF\"] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
