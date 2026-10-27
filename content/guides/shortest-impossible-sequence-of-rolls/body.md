## Rounds of all k values

1. `seen = {}`, `rounds = 0`.
2. For each roll: add it to `seen`; if `|seen| = k`, `rounds++` and clear `seen`.
3. Return `rounds + 1`.

Examples → 3, 2, 1. Checked against testing every short sequence on 300 random cases.

Any sequence of length r picks its i-th value from round i. To build one of length r + 1 that fails, choose from each round the value that closes it, and then a value missing from the unfinished tail.

Time: O(n)  
Space: O(k)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
