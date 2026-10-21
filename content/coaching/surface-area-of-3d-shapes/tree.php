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
            'message' => "Read the problem statement above.\nHow many faces does a lone tower of height v have?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4v + 2', 'next' => 's2'],
                ['label' => '6v', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Stacked cubes hide the faces between them.\nStep back to when you counted 6 per cube.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two neighboring towers of heights v and w hide how many faces?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(v, w)', 'next' => 'wrong_b'],
                ['label' => '2 · min(v, w)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both towers lose that much side area.\nStep back to when you counted one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which neighbors do you check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right and down only', 'next' => 'success'],
                ['label' => 'All four', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each pair would be subtracted twice.\nStep back to when you checked all four.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[1,2],[3,4]] → 34. [[1,1,1],[1,0,1],[1,1,1]] → 32. [[2,2,2],[2,1,2],[2,2,2]] → 46.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
