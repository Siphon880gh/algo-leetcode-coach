A road is a string of potholes and smooth cells. Repairing consecutive potholes costs the amount the statement gives, and you have a budget. Return the most potholes you can repair. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Fewest repairs

This assumes repairing k consecutive potholes costs k + 1; check the official statement.

1. L = lengths of pothole runs, sorted descending.
2. For each L: if budget ≥ L + 1, fix all of it, budget −= L + 1. Else fix budget − 1 (if positive) and stop.

Constructed checks (run in code): ..xxxxx with budget 4 → 3; x.x.xxx...x with 14 → 6; xx.xxx with 3 → 2; 500 random roads match trying every split of every run.

Short runs first waste charges: x.xxx with budget 4 gives 2 instead of 3.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
