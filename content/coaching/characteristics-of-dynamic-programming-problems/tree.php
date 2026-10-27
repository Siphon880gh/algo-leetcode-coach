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
            'message' => "State:\nthe best knapsack value for capacity c\nit is built from the best values for smaller capacities\n\nWhich property is this?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Optimal substructure', 'next' => 'mid'],
                ['label' => 'No overlapping subproblems', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBuilding a best answer from best answers to smaller states is optimal substructure.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe future needs to know the exact order of earlier items\nbut the state only records the capacity\n\nWhat is the problem?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The state is missing information the future depends on', 'next' => 'final'],
                ['label' => 'DP can never work for this problem', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThis is usually fixed by adding the missing information to the state.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou are designing a DP solution\n\nWhat do you do first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Define the state in plain words', 'next' => 'success'],
                ['label' => 'Write nested loops and work out their meaning later', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nDefine the state first. The loops come from it.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- DP needs optimal substructure and a state that captures everything the future needs.\n- If later choices depend on hidden history, add that history to the state.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
