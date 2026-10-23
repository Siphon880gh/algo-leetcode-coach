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
            'message' => "State:\nkeys = [2, 0, 2, 1, 0]\nrange = 0..2\n\ncount array after one pass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[2, 1, 2] — frequencies of 0,1,2', 'next' => 'place'],
                ['label' => '[0, 1, 2] — the sorted unique keys only', 'next' => 'w_unique'],
            ],
        ],
        'w_unique' => [
            'message' => "Wrong.\n\nCounting stores frequencies, including duplicates.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'place' => [
            'message' => "State:\nneed stable placement into output\n\nTypical scan direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left while consuming prefix positions', 'next' => 'range'],
                ['label' => 'Random order — stability never matters here', 'next' => 'w_rand'],
            ],
        ],
        'w_rand' => [
            'message' => "Wrong.\n\nStability is why we walk carefully with prefix sums.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'place',
            'choices' => [],
        ],
        'range' => [
            'message' => "State:\nkeys are arbitrary 64-bit ids, k enormous\n\nUse counting sort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — need small k; else memory/time O(k) explodes', 'next' => 'success'],
                ['label' => 'Yes — counting always beats comparison sorts', 'next' => 'w_always'],
            ],
        ],
        'w_always' => [
            'message' => "Wrong.\n\nCounting needs a small universe. Comparison sorts handle general keys.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'range',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Count → prefix → place\n- O(n+k) when k is small\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
