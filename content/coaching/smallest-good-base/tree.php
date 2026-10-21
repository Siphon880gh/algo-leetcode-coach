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
                ['label' => 'Try k = 2, 3, 4, … until n is all 1s', 'next' => 'wrong_a'],
                ['label' => 'Fix the number of 1s, then solve for the base', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Bases go up to about 1e18. Testing each from 2 up is hopeless.\nStep back to when you tried bases one by one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n = 1 + k + … + k^m. For fixed m, the sum grows with k, so one k at most works.\nWhich m do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest m (about 60, since 2^60 > 1e18), going down', 'next' => 's3'],
                ['label' => 'm = 1 first, going up', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Fewer digits means a bigger base. Starting from small m finds a large k first, not the smallest.\nStep back to when you started with small m.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "For each m, binary search k in [2, n − 1] and stop the sum as soon as it passes n, or test k = floor(n^(1/m)) with integer math. If nothing works, n − 1 (\"11\") always does.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest m first, exact integer check, fallback n − 1', 'next' => 'success'],
                ['label' => 'Compare the geometric sum using doubles', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Floating point sums lose precision near 1e18 and give false matches.\nStep back to when you summed in floating point.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Try digit counts from longest down, solve for the base exactly, fall back to n − 1. \"4681\" → \"8\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
