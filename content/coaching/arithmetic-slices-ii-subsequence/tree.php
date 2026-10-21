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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'For each end i and difference d, count chains of length at least 2', 'next' => 's2'],
                ['label' => 'Reuse 413: count contiguous arithmetic runs', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Arithmetic Slices (413) counts contiguous runs. Here elements can be skipped, so [2,6,10] counts.\nStep back to when you used the contiguous version.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "f[i] is a map d → count of chains (length >= 2) ending at i. For each j < i, d = nums[i] − nums[j].\nHow do you update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'answer += f[j][d] + 1; f[i][d] += f[j][d] + 1', 'next' => 'wrong_b'],
                ['label' => 'answer += f[j][d]; f[i][d] += f[j][d] + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pairs are length 2, which is not arithmetic by the definition. Adding the + 1 to the answer counts them.\nStep back to when you counted pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Extending any chain of length >= 2 by nums[i] gives a length >= 3 slice, which is exactly f[j][d]. O(n²) time and map entries. Compute d in 64 bits: two 32-bit values can differ by more than 2^31.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Per-index map d → count, add f[j][d], 64-bit d. Not 413', 'next' => 'success'],
                ['label' => 'Use an array indexed by d instead of a map', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. d can be about 2^32 wide, so a dense array of differences is far too big.\nStep back to when you used an array indexed by d.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count chains of length >= 2 per (end, d), add f[j][d] when extending. [7,7,7,7,7] → 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
