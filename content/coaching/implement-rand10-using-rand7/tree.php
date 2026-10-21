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
                ['label' => 'Make a uniform grid: x = (rand7() − 1) × 7 + rand7() is uniform on 1..49', 'next' => 's2'],
                ['label' => 'rand7() + rand7(), then map the sum onto 1..10', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A sum of two rolls is not uniform: 8 has seven ways, 2 has one. Mapping sums to 1..10 skews the output.\nStep back to when you added two calls.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "49 equally likely values. 49 is not a multiple of 10.\nWhat do you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return x % 10 + 1 for every x', 'next' => 'wrong_b'],
                ['label' => 'Keep x in 1..40 and return (x − 1) % 10 + 1; otherwise draw again', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Taking x % 10 + 1 on all 49 values makes 1..9 a bit more likely than 10.\nStep back to when you used all 49 values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Accept rate 40/49, 2 calls per round: about 2.45 calls expected. Reusing the rejected 41..49 as a fresh 1..9 lowers it further.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '7 × 7 grid, keep 40, retry the rest', 'next' => 'success'],
                ['label' => 'Return ceil(rand7() × 10 / 7)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Scaling by 10 / 7 or using rand7() % 10 cannot spread 7 outcomes evenly over 10.\nStep back to when you scaled a single call.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two calls make 1..49, keep 1..40, fold to 1..10, retry otherwise. Uniform, about 2.45 calls.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
