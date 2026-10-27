## Two leftovers

1. `top = sum(grid[0])`, `bot = 0`, `ans = ∞`.
2. For `i` from 0 to `n − 1`: `top −= grid[0][i]`; `ans = min(ans, max(top, bot))`; `bot += grid[1][i]`.

Examples → 4, 4, 7. Checked against simulating every turn column for both robots on random grids.

The second robot cannot collect both leftovers, because it also turns down once. The first robot's own score does not matter; maximising it is a different, wrong objective.

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
