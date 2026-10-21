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
            'message' => "Read the problem statement above.\nSum each block directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: prefix sums', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(k²) per cell.\nStep back to when you summed directly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Block bounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unclipped', 'next' => 'wrong_b'],
                ['label' => 'Clipped to [0, m) × [0, n)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Blocks near borders go out of range.\nStep back to when you skipped clipping.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Block sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'P[r2][c2] − P[r1][c2] − P[r2][c1] + P[r1][c1]', 'next' => 'success'],
                ['label' => 'P[r2][c2] − P[r1][c1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Both strips must be removed and the corner added back.\nStep back to when you subtracted one corner.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). k = 1 → [[12,21,16],[27,45,33],[24,39,28]]. k = 2 → all 45.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
