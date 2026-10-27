Students arrive in order with given ranks, where a smaller rank is better. The first student starts as the selection, and each later student who is strictly better than the current selection replaces it. Return how many replacements happen. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One pass

1. cur = ranks[0]; count = 0.
2. For each later rank r: if r < cur, cur = r and count += 1.
3. Return count.

Constructed checks (run in code): [5, 3, 3, 1] → 2; [1, 2, 3] → 0; [3, 2, 1] → 2.

Replacing on ties too: [5, 3, 3, 1] → 3 instead of 2.

Time: O(n)  
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
