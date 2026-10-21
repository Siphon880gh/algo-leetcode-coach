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
            'message' => "Read the problem statement above.\nApply swaps greedily while they help?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only connectivity matters', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Swaps can be repeated any number of times.\nStep back to when you swapped greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Indices 0–3 and 3–2 are pairs. Can 0 and 2 exchange?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'wrong_b'],
                ['label' => 'Yes: swaps are transitive', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A chain of swaps moves letters anywhere in the component.\nStep back to when you said no.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Inside a component?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest letter to the smallest index', 'next' => 'success'],
                ['label' => 'Sort the whole string', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Letters cannot leave their component.\nStep back to when you sorted everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). \"dcab\", [[0,3],[1,2]] → \"bacd\". With [0,2] added → \"abcd\". \"cba\", [[0,1],[1,2]] → \"abc\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
