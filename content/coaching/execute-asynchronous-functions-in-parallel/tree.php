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
            'message' => "Read the problem statement above.\nStore a result where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'out[i], its own index', 'next' => 's2'],
                ['label' => 'out.push(value) as it arrives', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Results arrive in completion order; in Node values at 60 ms and 20 ms → [2, 1] instead of [1, 2].\nStep back to when you pushed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A function rejects?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Wait for every function, then reject', 'next' => 'wrong_b'],
                ['label' => 'Reject the outer promise right away', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 must reject at 100 ms; waiting rejects at 200 ms in Node.\nStep back to when you waited for all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) besides the functions. Examples → {t: 200, resolved: [5]}, {t: 100, rejected: Error}, {t: 150, resolved: [4, 10, 16]}.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
