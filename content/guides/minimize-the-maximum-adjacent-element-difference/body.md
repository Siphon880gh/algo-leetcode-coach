## Check one d

1. base = largest difference between known neighbours; lo, hi over known neighbours of −1 cells.
2. ok(d): x = lo + d, y = hi − d; every run of −1 needs a value in {x, y} within d of both ends, or length ≥ 2, two ends, |x − y| ≤ d, and x near one end and y near the other.
3. Answer max(base, smallest ok d).

Examples → 4, 0, 1. Checked against trying every pair and filling on 400 small arrays.

Using one value for every gap: [1, −1, 10, −1, 12] → 6 instead of 5.

Time: O(n log V)  
Space: O(n)

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
