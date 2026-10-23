You start on the ground at height 0 and must land on every block exactly once, in any order. A jump from height a to height b costs (a − b)² calories, and the first jump goes from 0 to the first block. Return the most calories you can burn. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two pointers

1. Sort heights; i = 0, j = n − 1; prev = 0; take the big end first.
2. Alternate: take heights[j] (then j −= 1), then heights[i] (then i += 1), adding (prev − h)² and setting prev = h each time.
3. Return the total.

Constructed checks (made-up values, run in code): [2, 6, 4] → 56; [5, 5] → 25; [10, 1, 3, 8] → 255. Checked against trying every order on 2,000 random arrays.

Jumping in ascending order: [2, 6, 4] → 12 instead of 56.

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
