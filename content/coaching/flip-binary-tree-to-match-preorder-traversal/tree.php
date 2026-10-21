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
            'message' => "Read the problem statement above.\nThe current node does not equal voyage[i]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It is impossible: return [−1]', 'next' => 's2'],
                ['label' => 'Flip its parent', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A flip only reorders children; it cannot change this node.\nStep back to when you flipped the parent.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The left child does not equal the next voyage value. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return [−1]', 'next' => 'wrong_b'],
                ['label' => 'Flip: record this node and visit right first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The right child may be the one that comes next.\nStep back to when you gave up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The left child is missing. Flip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: flipping changes nothing', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Recording a useless flip gives a wrong answer list.\nStep back to when you flipped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). root = [1,2], voyage = [2,1] → [−1]. root = [1,2,3], voyage = [1,3,2] → [1]. root = [1,2,3], voyage = [1,2,3] → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
