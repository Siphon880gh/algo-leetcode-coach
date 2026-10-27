## Greedy reach

1. Sort coins; reach = 0, added = 0.
2. While reach < target: if the next coin ≤ reach + 1, `reach += coin`; else add reach + 1: `reach = 2·reach + 1`, added += 1.
3. Return added.

Examples → 2, 1, 3. Checked against trying every set of added coins on 150 random small inputs.

The coins must be sorted: in input order, example 2 → 2 instead of 1.

Time: O(n log n + log target)  
Space: O(1)

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
