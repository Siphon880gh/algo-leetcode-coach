## Search T

1. L = lcm(r1, r2).
2. ok(T): T − ⌊T / r1⌋ ≥ d1, T − ⌊T / r2⌋ ≥ d2, and T − ⌊T / L⌋ ≥ d1 + d2.
3. Binary search the smallest T with ok(T).

Examples → 5, 7, 3. Checked against an hour-by-hour search on 400 random small cases.

Dropping the shared-hours test: example 2 → 5 instead of 7.

Time: O(log(d1 + d2))  
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
